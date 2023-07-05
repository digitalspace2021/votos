<?php

namespace App\Http\Controllers;

use App\Http\Requests\Problem\StoreRequest;
use App\Models\Problem;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProblemController extends Controller
{
    public function index()
    {
        return view('problems.index');
    }

    public function getAll()
    {
        /* $problems = Problem::with('form')->get(); */

        /* colums nombre completo from formularios nombre+apellido, telefono, direccion, responsable, pruesto_votacion from table formularios and columns acciones view, edit and status */

        $problems = DataTables::of(DB::table('problems')
            ->join('formularios', 'problems.form_id', '=', 'formularios.id')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->select('problems.id', 'formularios.identificacion' ,'formularios.nombre', 'formularios.apellido', 'formularios.telefono', 'formularios.direccion', 'users.name', 'formularios.puesto_votacion', 'problems.estado')
            ->get())
            ->addColumn('acciones', function ($problem) {
                $btn = '' /* '<a href="' . route('problems.show', $problem->id) . '" class="btn btn-outline-secondary" title="Ver problema"><i class="fa fa-eye"></i></a>' */;
                $btn .= '<a href="' . route('problems.edit', $problem->id) . '" class="btn btn-outline-primary m-2" title="Editar problema"><i class="fa fa-edit"></i></a>';
                /* $btn .= '<a href="' . route('problems.destroy', $problem->id) . '" class="btn btn-outline-danger" title="Eliminar problema"><i class="fa fa-times"></i></a>'; */
                /* $btn .= '<a href="' . route('problems.status', $problem->id) . '" class="btn btn-outline-success m-2" title="Cambiar estado"><i class="fa fa-check"></i></a>'; */

                return $btn;
            })
            ->addColumn('status', function ($problem) {
                if ($problem->estado == 0) {
                    return '<span class="badge badge-danger">Pendiente</span>';
                } else {
                    return '<span class="badge badge-success">Resuelto</span>';
                }
            })
            ->rawColumns(['acciones', 'status'])
            ->make(true);

        return $problems;

        /* return response()->json([
            'problems' => $problems
        ]); */
    }

    public function create()
    {
        $users = DB::table('users')->get();
        return view('problems.create', compact('users'));
    }

    public function edit($id)
    {
        return view('problems.edit', compact('id'));
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $form = DB::table('formularios')->insertGetId([
                'propietario_id' => $request->creador,
                'identificacion' => $request->identificacion,
                'nombre' => $request->nombres,
                'apellido' => $request->apellidos,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'puesto_votacion' => $request->puesto,
                'created_at' => now(),
            ]);

            DB::table('problems')->insert([
                'vinculo' => $request->vinculo,
                'descripcion' => $request->descripcion,
                'form_id' => $form,
                'created_at' => now(),
            ]);

            DB::commit();

            return redirect()->route('problems.index')->with('success', 'Problema creado correctamente');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Error al crear el problema');
        }
    }
}
