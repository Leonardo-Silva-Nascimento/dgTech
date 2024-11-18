<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class Dashboard extends Controller
{

    public function index(Request $request, $id = 1)
    {
        $Modulo = "Dashboard";

        try {

            $filter = $request->input('filter', 0);

            $user = DB::table("users")->where('id', auth()->id())->first();
            $userName = $user->name;
            $eid = $user->empresa;


            $labels = [];
            $enviosPorDia = [];

            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();

            while ($start->lte($end)) {
                $labels[] = $start->format('d/m');
                $start->addDay();
            }

            $dashAtivosData = DB::table('users')
                ->select(DB::raw("DATE_FORMAT(created_at, '%d/%m') as data"), DB::raw('count(*) as total'))
                ->where('status', 1)
                ->whereBetween('created_at', [Carbon::now()->startOfMonth(), $end])
                ->groupBy('data')
                ->pluck('total', 'data')
                ->toArray();

            foreach ($labels as $date) {
                $dashAtivos[] = $dashAtivosData[$date] ?? 0;
            }
            $dashAtivos = array_values($dashAtivos);

            $dashInativosData = DB::table('users')
            ->select(DB::raw("DATE_FORMAT(created_at, '%d/%m') as data"), DB::raw('count(*) as total'))
            ->where('status', 0)
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), $end])
            ->groupBy('data')
            ->pluck('total', 'data')
            ->toArray();

        foreach ($labels as $date) {
            $dashInativos[] = $dashInativosData[$date] ?? 0;
        }
        $dashInativos = array_values($dashInativos);

            $totalUser = DB::table("users")->count();

            $totalUserAtivo = DB::table("users")
                ->where('status', 1)->count();

            $totalUserInativos = DB::table("users")
                ->where('status', 0)->count();

            //Calculando conssumo total da ferramenta
            $totalSemanal = DB::table('users')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();

            return Inertia::render("Dashboard/Dashboard",
                [
                    'userName' => $userName,

                    'totalUser' => $totalUser,
                    'totalSemanal' => $totalSemanal,
                    'totalUserInativos' => $totalUserInativos,
                    'totalUserAtivo' => $totalUserAtivo,

                    'labels' => $labels,
                    'dashAtivos' => $dashAtivos,
                    'dashInativos' => $dashInativos,
                ]);

        } catch (Exception $e) {

            $Error = $e->getMessage();
            $Error = explode("MESSAGE:", $Error);

            $Pagina = $_SERVER["REQUEST_URI"];

            $Erro = $Error[0];
            $Erro_Completo = $e->getMessage();
        }

    }

}
