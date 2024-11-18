<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use stdClass;
use Illuminate\Support\Facades\Session;

class Permissions extends Controller
{
    public function render(Request $request)
    {

        $data = Session::all();
        if (!isset($data["permission"]) || empty($data["permission"])) {
            session(["permission" => array("status" => "0", "orderBy" => array("column" => "created_at", "sorting" => "1"), "limit" => "10")]);
            $data = Session::all();
        }

        $Filtros = new Security;
        if ($request->input()) {
            $Limpar = false;
            if ($request->input("limparFiltros") == true) {
                $Limpar = true;
            }

            $arrayFilter = $Filtros->TratamentoDeFiltros($request->input(), $Limpar, ["permission"]);
            if ($arrayFilter) {
                if ($request->input("limparFiltros") == true) {
                    $arrayFilter["status"] = 'true';
                }
                session(["permission" => $arrayFilter]);
                $data = Session::all();
            }
        }

        $query = DB::table("roles");

        if (isset($data["permission"]["orderBy"])) {
            $Coluna = $data["permission"]["orderBy"]["column"];
            $query = $query->orderBy("roles.$Coluna", $data["permission"]["orderBy"]["sorting"] ? "asc" : "desc");
        } else {
            $query = $query->orderBy("roles.created_at", "desc");
        }
        if (isset($data["permission"]["nome"])) {
            $AplicaFiltro = $data["permission"]["nome"];
            $query = $query->Where("roles.name", "like", "%" . $AplicaFiltro . "%");
        }
        if (isset($data["permission"]["status"])) {
            $AplicaFiltro = $data["permission"]["status"];
            $query = $query->Where("roles.status", $AplicaFiltro);
        }

        $registros = $this->Registros();

        return Inertia::render('Permission/List')
            ->with([
                "Registros" => $registros,
                'roles' => $query->get(),
            ]);

    }

    public function Registros()
    {

        $mes = date("m");
        $Total = DB::table("roles")
            ->count();

        $Ativos = DB::table("roles")
            ->where("roles.status", "0")
            ->count();

        $Inativos = DB::table("roles")
            ->where("roles.status", "1")
            ->count();

        $EsseMes = DB::table("roles")
            ->whereMonth("roles.created_at", $mes)
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
        $permUser = Auth::user()->hasPermissionTo("create.users");

        if (!$permUser) {
            return redirect()->route("list.Dashboard", ['id' => '1']);
        }

        $roles = Role::all();
        return Inertia::render('Permission/Create')
            ->with([
                'roles' => $roles,
            ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'max:255|unique:roles',
            'status' => 'sometimes',
            'permission' => 'sometimes|array',
        ], [
            'name.unique' => 'O nome do grupo já existe!',
        ]);

        $role = Role::create($validated);

        $role->syncPermissions($validated['permission'] ?? []);

        return redirect()->route('list.permission');
    }

    public function edit($roleId)
    {
        $permUser = Auth::user()->hasPermissionTo("edit.users");
        $permUser2 = Auth::user()->hasPermissionTo("duplicate.users");
        if ((!$permUser) && (!$permUser2)) {
            return redirect()->route("list.Dashboard", ['id' => '1']);
        }

        $role = Role::findOrFail($roleId);

        $role->load(['permissions']);
        return Inertia::render('Permission/Edit')
            ->with([
                'role' => $role,
            ]);
    }

    public function update(Request $request, $roleId)
    {

        $role = Role::findOrFail($roleId);

        $role->syncPermissions($request->permission ?? []);

        $role->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('list.permission');
    }

    public function delete($role_id)
    {
        $permUser = Auth::user()->hasPermissionTo("delete.users");

        if (!$permUser) {
            return redirect()->route("list.Dashboard", ['id' => '1']);
        }

        Role::findOrFail($role_id)
            ->delete();
        return redirect()->back();
    }

    public function exportarRelatorioExcel()
    {

        $permUser = Auth::user()->hasPermissionTo("create.ConfigAvisos");

        if (!$permUser) {
            return redirect()->route("list.Dashboard", ["id" => "1"]);
        }

        $filePath = "Relatorio_config_tags.xlsx";

        if (Storage::disk("public")->exists($filePath)) {
            Storage::disk("public")->delete($filePath);
            // Arquivo foi deletado com sucesso
        }

        $cabecalhoAba1 = array('nome', 'observacao', 'status', 'Data de Cadastro');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $config_avisos = $this->DadosRelatorio();

        // Define o título da primeira aba
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle("ConfigAvisos");

        // Adiciona os cabeçalhos da tabela na primeira aba
        $spreadsheet->getActiveSheet()->fromArray($cabecalhoAba1, null, "A1");

        // Adiciona os dados da tabela na primeira aba
        $spreadsheet->getActiveSheet()->fromArray($config_avisos, null, "A2");

        // Definindo a largura automática das colunas na primeira aba
        foreach ($spreadsheet->getActiveSheet()->getColumnDimensions() as $col) {
            $col->setAutoSize(true);
        }

        // Habilita a funcionalidade de filtro para as células da primeira aba
        $spreadsheet->getActiveSheet()->setAutoFilter($spreadsheet->getActiveSheet()->calculateWorksheetDimension());

        // Define o nome do arquivo
        $nomeArquivo = "Relatorio_ConfigCarros.xlsx";
        // Cria o arquivo
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save($nomeArquivo);
        $barra = "'/'";
        $barra = str_replace("'", "", $barra);
        $writer->save(storage_path("app" . $barra . "relatorio" . $barra . $nomeArquivo));

        return redirect()->route("download2.files", ["path" => $nomeArquivo]);

    }
}
