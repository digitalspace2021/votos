<?php

namespace App\Http\Controllers;

use App\Http\Requests\Problem\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ProblemController extends Controller
{
    public function index()
    {
        return view('problems.index');
    }

    public function getAll()
    {
        /* colums nombre completo from formularios nombre+apellido, telefono, direccion, responsable, pruesto_votacion from table formularios and columns acciones view, edit and status */
        $problems = DataTables::of(DB::table('problems')
            ->join('formularios', 'problems.form_id', '=', 'formularios.id')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->select('problems.id', 'formularios.identificacion', 'formularios.nombre', 'formularios.apellido', 'formularios.telefono', 'formularios.direccion', 'users.name', 'formularios.puesto_votacion', 'problems.estado')
            ->addSelect(DB::raw("CONCAT(formularios.nombre, ' ', formularios.apellido) AS nombre_completo"))
            ->get())
            ->addColumn('acciones', function ($problem) {
                $btn = '' /* '<a href="' . route('problems.show', $problem->id) . '" class="btn btn-outline-secondary" title="Ver problema"><i class="fa fa-eye"></i></a>' */;
                $btn .= '<a href="' . route('problems.edit', $problem->id) . '" class="btn btn-outline-primary m-2" title="Editar problema"><i class="fa fa-edit"></i></a>';
                $btn .= '<a href="' . route('problems.destroy', $problem->id) . '" class="btn btn-outline-danger" title="Eliminar problema"><i class="fa fa-times"></i></a>';
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
    }

    /**
     * The function retrieves all users from the database and passes them to the create view.
     * 
     * @return View a view called 'problems.create' and passing the 'users' variable to the view.
     */
    public function create(): View
    {
        $users = DB::table('users')->get();
        return view('problems.create', compact('users'));
    }

    public function edit($id)
    {
        return view('problems.edit', compact('id'));
    }

    /**
     * The store function is used to store form data and related problems in a database
     * transaction, and then redirect the user with a success or error message.
     * 
     * @param StoreRequest request The `` parameter is an instance of the `StoreRequest` class,
     * which is a custom request class that handles the validation and authorization logic for the
     * store method. It contains the data submitted by the user through a form.
     * 
     * @return RedirectResponse a RedirectResponse.
     */
    public function store(StoreRequest $request): RedirectResponse
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

    /**
     * The function destroys a problem and its associated formularios from the database, and returns a
     * redirect response with a success message if successful, or an error message if there was an
     * error.
     * 
     * @param int id The "id" parameter is an integer that represents the unique identifier of the
     * problem or formularios that you want to delete from the database.
     * 
     * @return RedirectResponse a RedirectResponse.
     */
    public function destroy(int $id): RedirectResponse
    {
        DB::beginTransaction();

        try {
            DB::table('problems')->where('id', $id)->delete();
            DB::table('formularios')->where('id', $id)->delete();

            DB::commit();

            return redirect()->route('problems.index')->with('success', 'Problema eliminado correctamente');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Error al eliminar el problema');
        }
    }
}
