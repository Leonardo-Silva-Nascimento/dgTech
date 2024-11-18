<?php

namespace App\Http\Controllers;

use App\Mail\SendTemporaryPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Spatie\Permission\Models\Permission;
use stdClass;
use \Spatie\Permission\Models\Role;

class Userlist extends Controller
{
    public function index(Request $request)
    {
        $permUser = Auth::user()->hasPermissionTo("list.users");

        if (!$permUser) {
            return redirect()->route("list.Dashboard", ['id' => '1']);
        }

        $data = Session::all();
        if (!isset($data["users"]) || empty($data["users"])) {
            session(["users" => array("status" => "0", "orderBy" => array("column" => "created_at", "sorting" => "1"), "limit" => "10")]);
            $data = Session::all();
        }

        $Filtros = new Security;
        if ($request->input()) {
            $Limpar = false;
            if ($request->input("limparFiltros") == true) {
                $Limpar = true;
            }

            $arrayFilter = $Filtros->TratamentoDeFiltros($request->input(), $Limpar, ["users"]);
            if ($arrayFilter) {
                if ($request->input("limparFiltros") == true) {
                    $arrayFilter["status"] = 1;
                }
                session(["users" => $arrayFilter]);
                $data = Session::all();
            }
        }

        $query = DB::table("users")
            ->leftjoin('model_has_roles as m', 'users.id', '=', 'm.model_id')
            ->leftjoin('roles as r', 'm.role_id', '=', 'r.id')
            ->select(DB::raw("users.*, DATE_FORMAT(users.created_at, '%d/%m/%Y') as data_final, r.name as customizada"));

        if (isset($data["users"]["orderBy"])) {
            $Coluna = $data["users"]["orderBy"]["column"];
            $query = $query->orderBy("users.$Coluna", $data["users"]["orderBy"]["sorting"] ? "asc" : "desc");
        } else {
            $query = $query->orderBy("users.created_at", "desc");
        }

        if (isset($data["users"]["nome"])) {
            $AplicaFiltro = $data["users"]["nome"];
            $query = $query->Where("users.name", "like", "%" . $AplicaFiltro . "%");
        }
        if (isset($data["users"]["hierarquia"])) {
            $AplicaFiltro = $data["users"]["hierarquia"];
            $query = $query->Where("roles.name", "like", "%" . $AplicaFiltro . "%");
        }
        if (isset($data["users"]["status"])) {
            $AplicaFiltro = $data["users"]["status"];
            $get = $request->get('status');

            if (($AplicaFiltro == 1 && !is_array($get)) || empty($get)) {
                $query = $query->Where("users.status", "like", "%" . $AplicaFiltro . "%");
            } else {
                $query = $query->Where("users.status", "like", "%" . $get['value'] . "%");
            }
        }
        if (isset($data["users"]["created_at"])) {
            $AplicaFiltro = $data["users"]["created_at"];
            $query = $query->Where("users.created_at", "like", "%" . $AplicaFiltro . "%");
        }

        $registros = $this->Registros();

        return Inertia::render('User/List', [
            "Registros" => $registros,
            'users' => $query->get(),
        ]);
    }

    public function Registros()
    {

        $mes = date("m");
        $Total = DB::table("users")
            ->count();

        $Ativos = DB::table("users")
            ->where("users.status", "1")
            ->count();

        $Inativos = DB::table("users")
            ->where("users.status", "0")
            ->count();

        $EsseMes = DB::table("users")
            ->whereMonth("users.created_at", $mes)
            ->count();

        $data = new stdClass;
        $data->total = number_format($Total, 0, ",", ".");
        $data->ativo = number_format($Ativos, 0, ",", ".");
        $data->inativo = number_format($Inativos, 0, ",", ".");
        $data->mes = number_format($EsseMes, 0, ",", ".");
        return $data;

    }

    public function create()
    {

        $permUser = Auth::user()->hasPermissionTo("edit.users");

        if (!$permUser) {
            return redirect()->route("list.Dashboard", ['id' => '1']);
        }

        $roles = Role::all();

        return Inertia::render('User/Create', [
            'roles' => $roles,
        ]);
    }

    private function syncPermissions($user_id, $link_group, $group_permission, $permission)
    {
        $user = User::find($user_id);

        $link_group = filter_var(data_get($link_group, 'link_group'), FILTER_VALIDATE_BOOLEAN);

        if (!$link_group) {
            $user->syncPermissions(array_keys($permission));
            $user->syncRoles([]);
        } elseif ($link_group) {
            $user->syncRoles(data_get($group_permission, 'group_permissions'));
            $user->syncPermissions([]);
        }
    }

    public function store(Request $request)
    {

        $Usuarios = DB::table("users")->where("email", $request->email)->first();
        if ($Usuarios) {
            return redirect()->route("form.store.user")->withErrors(['msg' => "E-mail já cadastrado em nossa base de dados."]);
        }

        $Array = array();

        if ($request->group_permissions == 'false' && $request->permission == $Array) {
            return redirect()->route("form.store.user")->withErrors(['msg' => "Permissão não selecionada."]);
        }

        if ($request->permission) {
            $request->permission = implode(',', $request->permission);
        }

        $save = new stdClass;
        $save->name = $request->name;
        $save->email = $request->email;
        $save->password = bcrypt($request->password);
        $save->phone = $request->phone;
        $save->status = $request->status;

        $save = collect($save)->toArray();
        DB::table("users")
            ->insert($save);
        $lastId = DB::getPdo()->lastInsertId();

        $user = User::find($lastId);

        if ($request->group_permissions == false || $request->permission) {
            $permissions = explode(',', $request->permission);
            $allPermissions = Permission::get('id')->pluck('id')->toArray();
            $validPermissions = array_intersect($permissions, $allPermissions);
            $user->syncPermissions($validPermissions);
        } else {
            $user->syncRoles($request->group_permissions);
        }

        return redirect()->route('list.users');
    }

    public function edit($id)
    {
        // if (!Auth::user()->can('editar-usuarios')) {
        //     return redirect()->back();
        // }

        $permUser = Auth::user()->hasPermissionTo("edit.users");
        $permUser2 = Auth::user()->hasPermissionTo("duplicate.users");
        if ((!$permUser) && (!$permUser2)) {
            return redirect()->route("list.Dashboard", ['id' => '1']);
        }

        $data = Session::all();

        $roles = Role::all();
        $user1 = User::findOrFail($id);

        $user1['link_group'] = "true";

        if ($user1->permissions->count()) {
            $user1['link_group'] = "false";
        }

        $Usuarios = DB::table("users")->where("id", $id)->first();
        $MinhasEmpresas = explode(',', $Usuarios->empresa);

        $user1->load(['permissions', 'roles']);

        return Inertia::render('User/Edit', [
            'roles' => $roles,
            'user1' => $user1,
            'ExplodeEmpresa' => $EmpresaFinal,
        ]);
    }

    public function editProfile()
    {
        $user_id = auth()->user()->id;

        $roles = Role::all();
        $user = User::findOrFail($user_id);

        $user['link_group'] = "true";

        if ($user->permissions->count()) {
            $user['link_group'] = "false";
        }

        $user->load(['permissions', 'roles']);
        $UsuarioAtual = DB::table("users")->where('id', $user_id)->first();
        $EmpresaExplodeUsuarioAtual = explode(',', $UsuarioAtual->empresa);


        $data = Session::all();

        $arr = '';

        return Inertia::render('User/Profile', [
            'roles' => $roles,
            'user' => $user,
            'SelectEmpresa' => $arr,
        ]);
    }

    public function updateProfile(Request $request)
    {

        $user_id = auth()->user()->id;

        if ($request->empresaSelect) {
            $EmpresaImplode = implode(',', $request->empresaSelect);
        }

        $UsuarioAtual = DB::table("users")->where('id', $user_id)->first();

        $url = null;
        $rules = 'jpg,png';
        $FormatosLiberados = explode(",", $rules);
        if ($request->hasFile('profile_picture')) {
            if ($request->file('profile_picture')->isValid()) {
                if (in_array($request->file('profile_picture')->extension(), $FormatosLiberados)) {
                    $ext = $request->file('profile_picture')->extension();
                    $profile_picture = $request->file('profile_picture')->store('avatars/1');
                    $url = $profile_picture;
                    $url = explode('/', $url);
                    $url = $profile_picture;
                } else {
                    $ext = $request->file('profile_picture')->extension();
                    return redirect()->route("form.update.profile")->withErrors(['msg' => "Atenção o formato enviado na Foto de Perfil foi: $ext, só são permitidos os seguintes formatos: $rules ."]);
                }
            }
        }

        $save = new stdClass;
        $save->name = $request->name;
        $save->email = $request->email;
        if ($request->password) {
            $save->password = bcrypt($request->password);
        }
        if ($request->profile_picture) {
            $save->profile_picture = $url;
        }
        $save->phone = $request->phone;

        $save = collect($save)->toArray();
        DB::table("users")
            ->where("id", $user_id)
            ->update($save);

        if ($request->empresaSelect) {
            session(['empresa' => $EmpresaImplode]);
        }

        return redirect()->route('home');
    }

    public function update(Request $request, $user_id)
    {

        // if (!Auth::user()->can('editar-usuarios')) {
        //     return redirect()->back();
        // }

        $Usuarios = DB::table("users")->where("email", $request->email)->where('id', '<>', $user_id)->first();
        if ($Usuarios) {
            return redirect()->route("form.update.user")->withErrors(['msg' => "E-mail já cadastrado em nossa base de dados."]);
        }

        $Array = array();

        if ($request->group_permissions == 'false' && $request->permission == $Array) {
            return redirect()->route("form.update.user")->withErrors(['msg' => "Permissão não selecionada."]);
        }

        if ($request->permission) {
            $request->permission = implode(',', $request->permission);
        }

        //    print_r($request->all()); die;
        $save = new stdClass;
        $save->name = $request->name;
        $save->email = $request->email;
        if ($request->password) {
            $save->password = bcrypt($request->password);
        }
        $save->phone = $request->phone;
        $save->status = $request->status['value'];

        // echo '<pre>';
        // print_r($save);
        // echo '</pre>';
        // die;

        $save = collect($save)->toArray();
        DB::table("users")
            ->where("id", $user_id)
            ->update($save);

        $user = User::find($user_id);

        if ($request->group_permissions == false || $request->permission) {
            $permissions = explode(',', $request->permission);
            $allPermissions = Permission::get('id')->pluck('id')->toArray();
            $validPermissions = array_intersect($permissions, $allPermissions);
            $user->syncPermissions($validPermissions);
        } else {
            $user->syncRoles($request->group_permissions);
        }

        if ($user_id == auth()->user()->id) {
            $Sessoes = Session::all();
            session(['empresa' => $Empresa]);
        }

        return redirect()->route('list.users');
    }

    public function delete($user_id)
    {
        // if (!Auth::user()->can('excluir-usuarios')) {
        //     return redirect()->back();
        // }

        $permUser = Auth::user()->hasPermissionTo("delete.users");

        if (!$permUser) {
            return redirect()->route("list.Dashboard", ['id' => '1']);
        }

        User::findOrFail($user_id)
            ->delete();
        return redirect()->back();
    }

    public function resendPassword($user_id)
    {
        $user = User::findOrFail($user_id);

        $to = $user->email;
        $name = $user->name;
        $password = rand(11111111, 99999999);

        $user->temp_password = true;
        $user->password = bcrypt($password);
        $user->save();

        Mail::to($to)->send(new SendTemporaryPassword($name, $password));

        return redirect()->back();
    }

    public function DadosRelatorio()
    {
        $ConfigGrupoContato = DB::table("users")
            ->select(DB::raw("users.*, DATE_FORMAT(users.created_at, '%d/%m/%Y - %H:%i:%s') as data_final"))
            ->get();

        $Dadosconfig_grupo_contato = [];
        foreach ($ConfigGrupoContato as $config_grupo_contatos) {
            $config_grupo_contatos->status = ($config_grupo_contatos->status == "0") ? "Ativo" : "Inativo";

            $Dadosconfig_grupo_contato[] = [
                'nome' => $config_grupo_contatos->name,
                'email' => $config_grupo_contatos->email,
                'status' => $config_grupo_contatos->status,
                'data_final' => $config_grupo_contatos->data_final,
            ];
        }

        return $Dadosconfig_grupo_contato;
    }

    public function exportarRelatorioExcel()
    {

        $permUser = Auth::user()->hasPermissionTo("create.ConfigAvisos");

        if (!$permUser) {
            return redirect()->route("list.Dashboard", ["id" => "1"]);
        }

        $filePath = "relatorio.xlsx";

        if (Storage::disk("public")->exists($filePath)) {
            Storage::disk("public")->delete($filePath);
        }

        $cabecalhoAba1 = array('nome', 'email', 'status', 'Data de Cadastro');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $config_avisos = $this->DadosRelatorio();

        // Define o título da primeira aba
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle("ConfigAvisos");

        // Adiciona os cabeçalhos da tabela na primeira aba
        $spreadsheet->getActiveSheet()->fromArray($cabecalhoAba1, null, "A1");
        $spreadsheet->getActiveSheet()->fromArray($config_avisos, null, "A2");

        // Definindo a largura automática das colunas na primeira aba
        foreach ($spreadsheet->getActiveSheet()->getColumnDimensions() as $col) {
            $col->setAutoSize(true);
        }

        // Habilita a funcionalidade de filtro para as células da primeira aba
        $spreadsheet->getActiveSheet()->setAutoFilter($spreadsheet->getActiveSheet()->calculateWorksheetDimension());

        // Define o nome do arquivo
        $nomeArquivo = "relatorio.xlsx";
        // Cria o arquivo
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save($nomeArquivo);
        $barra = "'/'";
        $barra = str_replace("'", "", $barra);
        $writer->save(storage_path("app/relatorio.xlsx"));

        return redirect()->route("download2.files", ["path" => $nomeArquivo]);

    }
}
