<?php

namespace App\Http\Controllers;

use App\Http\Requests\Problem\StoreRequest;
use App\Models\Formulario;
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
        $problems = DataTables::of(DB::table('formularios')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->select('formularios.id', 'formularios.identificacion', 'formularios.nombre', 'formularios.apellido', 'formularios.telefono', 'formularios.direccion', 'users.name', 'formularios.puesto_votacion', 'formularios.estado')
            ->addSelect(DB::raw("CONCAT(formularios.nombre, ' ', formularios.apellido) AS nombre_completo"))
            ->where('formularios.estado', false)
            ->get())
            ->addColumn('acciones', function ($problem) {
                $btn = '' /* '<a href="' . route('problems.show', $problem->id) . '" class="btn btn-outline-secondary" title="Ver problema"><i class="fa fa-eye"></i></a>' */;
                $btn .= '<a href="' . route('problems.edit', $problem->id) . '" class="btn btn-outline-primary m-2" title="Editar problema"><i class="fa fa-edit"></i></a>';
                $btn .= '<a href="' . route('problems.destroy', $problem->id) . '" class="btn btn-outline-danger" title="Eliminar problema"><i class="fa fa-times"></i></a>';
                $btn .= '<button prid="'.$problem->id.'" class="btn btn-outline-success m-2 status" title="Cambiar estado"><i class="fa fa-check"></i></button>';

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
        $users = DB::table('users')->get();

        $problem = Formulario::findOrFail($id);

        if ($problem->estado == true || !$problem) {
            return back()->with('error', 'No se puede editar un problema resuelto');
        }

        return view('problems.edit', compact('users', 'problem'));
    }

    /**
     * The function stores a new record in the "Formulario" table and redirects the user to the index
     * page with a success message if successful, or returns back with an error message if not.
     * 
     * @param StoreRequest request The  parameter is an instance of the StoreRequest class,
     * which is a custom request class that handles the validation and data retrieval for the store
     * method. It contains the data submitted by the user through a form.
     * 
     * @return RedirectResponse a RedirectResponse.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $problem = Formulario::create([
            'propietario_id' => $request->creador,
            'identificacion' => $request->identificacion,
            'nombre' => $request->nombres,
            'apellido' => $request->apellidos,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'puesto_votacion' => $request->puesto,
            'estado' => false,
            'genero' => $request->genero,
            'email' => $request->email,
            'vinculo' => $request->vinculo,
            'mensaje' => $request->descripcion,
        ]);

        if ($problem) {
            return redirect()->route('problems.index')->with('success', 'Problema creado correctamente');
        }
        return back()->with('error', 'Error al crear el problema');
    }

    /**
     * The function updates a problem in a database and returns a success message if the update is
     * successful, or an error message if it fails.
     * 
     * @param StoreRequest request The  parameter is an instance of the StoreRequest class,
     * which is a custom request class that handles the validation and authorization logic for storing
     * a new resource.
     * @param id The "id" parameter is the unique identifier of the problem that needs to be updated.
     * It is used to find the specific problem in the database and update its details.
     * 
     * @return RedirectResponse a RedirectResponse.
     */
    public function update(StoreRequest $request, $id): RedirectResponse
    {
        $problem = Formulario::findOrFail($id);

        if ($problem->estado == true || !$problem) {
            return back()->with('error', 'No se puede editar un problema resuelto');
        }

        $problem->update([
            'propietario_id' => $request->creador,
            'identificacion' => $request->identificacion,
            'nombre' => $request->nombres,
            'apellido' => $request->apellidos,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'puesto_votacion' => $request->puesto,
            'estado' => false,
            'genero' => $request->genero,
            'email' => $request->email,
            'vinculo' => $request->vinculo,
            'mensaje' => $request->descripcion,
        ]);

        if ($problem) {
            return redirect()->route('problems.index')->with('success', 'Problema actualizado correctamente');
        }
        return back()->with('error', 'Error al actualizar el problema');
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
            DB::table('formularios')->where('id', $id)->delete();

            DB::commit();

            return redirect()->route('problems.index')->with('success', 'Problema eliminado correctamente');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Error al eliminar el problema');
        }
    }


    /**
     * The function changes the status of a problem and updates its zone and type of zone, and returns
     * a success message based on the new status.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request. It contains information about the request such as the request
     * method, headers, and input data.
     * @param id The "id" parameter is the unique identifier of the problem that needs to be updated.
     * It is used to find the specific problem in the database.
     * 
     * @return RedirectResponse a RedirectResponse.
     */
    public function changeStatus(Request $request, $id): RedirectResponse
    {
        $problem = Formulario::findOrFail($id);

        if (!$problem) {
            return back()->with('error', 'Error al cambiar el estado del problema');
        }

        $problem->update([
            'estado' => !$problem->estado,
            'zona' => $request->zona,
            'tipo_zona' => $request->tipo_zona,
        ]);

        if ($problem->estado == true) {
            return back()->with('success', 'Problematica confirmada correctamente');
        }
        return back()->with('success', 'Problematica pendiente correctamente');
    }
}
