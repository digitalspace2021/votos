<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Edil;
use App\Models\User;
use App\Models\UserEdiles;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class CumpleaniosController extends Controller
{
    public function index()
    {
        return view('cumpleanios.index');
    }

    public function getAll()
    {
        $users = $this->getUsers();

        $table = DataTables::of($users)
            ->addColumn('acciones', function ($user) {
                $btn = '';

                if ($user->rol === 'Usuario') {
                    $btn = '<a href="' . route('usuarios.ver',  $user->id) . '" class="btn btn-sm btn-primary" target="_blank">Ver</a>';
                }

                if ($user->rol === 'Candidato') {
                    $btn = '<a href="' . route('candidatos.ver',  $user->id) . '" class="btn btn-sm btn-primary" target="_blank">Ver</a>';
                }

                if ($user->rol === 'Edil') {
                    $btn = '<a href="' . route('users-edils.show',  ['id' => $user->id, 'type' => $user->rol]) . '" class="btn btn-sm btn-primary" target="_blank">Ver</a>';
                }

                if ($user->rol === 'Asambleista') {
                    $btn = '<a href="' . route('users-edils.show',  ['id' => $user->id, 'type' => $user->rol]) . '" class="btn btn-sm btn-primary" target="_blank">Ver</a>';
                }

                if ($user->rol === 'Formulario') {
                    $btn = '<a href="' . route('formularios.ver',  $user->id) . '" class="btn btn-sm btn-primary" target="_blank">Ver</a>';
                }

                if ($user->rol === 'Posible Votante') {
                    $btn = '<a href="' . route('problems.show',  $user->id) . '" class="btn btn-sm btn-primary" target="_blank">Ver</a>';
                }

                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);


        return $table;
    }

    private function getUsers(): array
    {
        $users = DB::table('users')
            ->select('users.id', 'users.name', 'users.identificacion', 'info_users.fecha_nacimiento')
            ->join('info_users', 'users.info_id', '=', 'info_users.id')
            ->whereNotNull('info_users.fecha_nacimiento')
            ->get();

        $users->map(function ($user) {
            $user->rol = 'Usuario';
            return $user;
        });

        $candidatos = DB::table('candidatos')
            ->select('candidatos.id', 'candidatos.name', 'candidatos.identifcacion as identificacion', 'candidatos.fecha_nacimiento')
            ->whereNotNull('candidatos.fecha_nacimiento')
            ->get();

        $candidatos->map(function ($candidato) {
            $candidato->rol = 'Candidato';
            return $candidato;
        });

        $asam_and_edils = DB::table('usuarios_ediles')
            ->select('usuarios_ediles.id', 'usuarios_ediles.identificacion', 'usuarios_ediles.fecha_nacimiento', 'usuarios_ediles.rol')
            ->addSelect(DB::raw('CONCAT(usuarios_ediles.nombres, " ", usuarios_ediles.apellidos) as name'))
            ->whereNotNull('usuarios_ediles.fecha_nacimiento')
            ->get();

        $form_oficiales = DB::table('formularios')
            ->select('formularios.id', 'formularios.identificacion', 'formularios.fecha_nacimiento', 'formularios.estado')
            ->addSelect(DB::raw('CONCAT(formularios.nombre, " ", formularios.apellido) as name'))
            ->whereNotNull('formularios.fecha_nacimiento')
            ->get();
        $form_oficiales->map(function ($form_oficial) {

            if ($form_oficial->estado) {
                $form_oficial->rol = 'Formulario';
            } else {
                $form_oficial->rol = 'Posible Votante';
            }

            return $form_oficial;
        });

        $merged = $users->concat($candidatos)->concat($asam_and_edils)->concat($form_oficiales);
        $merged = $merged->all();

        $merged = $this->calculateTime($merged);

        usort($merged, function ($a, $b) {
            $aTimestamp = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($a->fecha_nacimiento))));
            $bTimestamp = strtotime(date('Y-m-d', strtotime('+1 year', strtotime($b->fecha_nacimiento))));

            return $aTimestamp - $bTimestamp;
        });

        /* dd($merged); */

        return $merged;
    }

    private function calculateTime(array $users): array
    {
        $users = array_map(function ($user) {
            $date = explode('-', $user->fecha_nacimiento);
            $date = array_map(function ($date) {
                return (int) $date;
            }, $date);

            $date = (object) [
                'year' => $date[0],
                'month' => $date[1],
                'day' => $date[2],
            ];

            $now = (object) [
                'year' => date('Y'),
                'month' => date('m'),
                'day' => date('d'),
            ];

            $user->days = $date->day - $now->day;
            $user->months = $date->month - $now->month;
            $user->years = $date->year - $now->year;

            if ($user->days < 0) {
                $user->days = 30 + $user->days;
                $user->months--;
            }

            if ($user->months < 0) {
                $user->months = 12 + $user->months;
                $user->years--;
            }

            /* concat days and months in how falta */
            $user->falta = $user->days . ' días y ' . $user->months . ' meses';

            return $user;
        }, $users);

        $now = new DateTime();
        foreach ($users as $user) {
            $birthdate = new DateTime($user->fecha_nacimiento);
            $diff = $now->diff($birthdate);
            $user->days = $diff->days;
            $user->months = $diff->m;
            $user->years = $diff->y;
            $user->falta2 = $user->days . ' días y ' . $user->months . ' meses';
        }

        return $users;
    }
}
