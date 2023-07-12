<?php

namespace App\Http\Controllers;

use App\Http\Requests\Problem\StoreRequest;
use App\Models\Formulario;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ProblemController extends Controller
{
    /**
     * The function retrieves all users from the database and passes them to the view.
     * 
     * @return View a view called 'problems.index' and passing the variable 'creadores' to the view.
     */
    public function index(): View
    {
        $creadores = DB::table('users')->get();
        return view('problems.index', compact('creadores'));
    }

    /**
     * The function retrieves a list of problems from a database based on various filters and returns
     * the results in a formatted DataTables response.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request. It contains information about the current request, such as the
     * request method, URL, headers, and any request parameters or data.
     * 
     * @return the `$problems` variable, which is the result of querying the database and formatting
     * the data using the DataTables library.
     */
    public function getAll(Request $request)
    {
        $problems = DB::table('formularios')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->select('formularios.id', 'formularios.identificacion', 'formularios.nombre', 'formularios.apellido', 'formularios.telefono', 'formularios.direccion', 'users.name', 'users.id as creator_id', 'formularios.puesto_votacion', 'formularios.estado', 'formularios.created_at')
            ->addSelect(DB::raw("CONCAT(formularios.nombre, ' ', formularios.apellido) AS nombre_completo"))
            ->where('formularios.estado', false)
            /* filter for cedula, nombre+apellido, created_at or creator_id */
            ->when($request->get('cedula'), function ($query, $cedula) {
                return $query->where('formularios.identificacion', 'like', '%' . $cedula . '%');
            })
            ->when($request->get('nombre'), function ($query, $nombre_completo) {
                return $query->where(DB::raw("CONCAT(formularios.nombre, ' ', formularios.apellido)"), 'like', '%' . $nombre_completo . '%');
            })
            ->when($request->get('created_at'), function ($query, $created_at) {
                return $query->whereDate('formularios.created_at', $created_at);
            })
            ->when($request->get('creador'), function ($query, $creator_id) {
                return $query->where('users.id', $creator_id);
            })
            ->orderBy('formularios.created_at', 'desc')
            ->get();

        if (auth()->user()->hasRole('simple')) {
            $problems = $problems->where('propietario_id', auth()->user()->id);
        }

        /* colums nombre completo from formularios nombre+apellido, telefono, direccion, responsable, pruesto_votacion from table formularios and columns acciones view, edit and status */
        $problems = DataTables::of($problems)
            ->editColumn('created_at', function ($col) {
                return Carbon::parse($col->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('acciones', function ($problem) {
                $btn = '<a href="' . route('problems.show', $problem->id) . '" class="btn btn-outline-secondary btn-sm" title="Ver problema"><i class="fa fa-eye"></i></a>';
                if (auth()->user()->hasRole('admin')) {
                    $btn .= '<a href="' . route('problems.destroy', $problem->id) . '" class="btn btn-outline-danger btn-sm" title="Eliminar problema"><i class="fa fa-times"></i></a>';
                }
                $btn .= '<a href="' . route('problems.edit', $problem->id) . '" class="btn btn-outline-primary m-2 btn-sm" title="Editar problema"><i class="fa fa-edit"></i></a>';
                $btn .= '<button prid="' . $problem->id . '" class="btn btn-outline-success m-2 status btn-sm" title="Cambiar estado"><i class="fa fa-check"></i></button>';

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
            return back()->with('error', 'No se puede visualizar un formulario comfirmado');
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
            'mensaje' => $request->check_problem ? $request->mensaje : null,
        ]);

        if ($problem) {
            if (auth()->check()) {
                return redirect()->route('problems.index')->with('success', 'Oportunidad de votante creado correctamente');
            }

            if (!auth()->check()) {
                return redirect()->route('login')->with('success', 'Oportunidad de votante correctamente');
            }
        }
        return back()->with('error', 'Error al crear el Oportunidad de votante');
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
            return back()->with('error', 'No se puede editar una Oportunidad de votante');
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
            return redirect()->route('problems.index')->with('success', 'Oportunidad de votante actualizado correctamente');
        }
        return back()->with('error', 'Error al actualizar la Oportunidad de votante');
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

            return redirect()->route('problems.index')->with('success', 'Oportunidad de votante eliminada correctamente');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Error al eliminar la Oportunidad de votante');
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
            return back()->with('error', 'Error al cambiar el estado de la Oportunidad de votante');
        }

        $problem->update([
            'estado' => !$problem->estado,
            'zona' => $request->zona,
            'tipo_zona' => $request->tipo_zona,
            'candidato_id' => $request->candidato_id,
        ]);

        if ($problem->estado == true) {
            return back()->with('success', 'Oportunidad de votante confirmada correctamente');
        }
        return back()->with('success', 'Oportunidad de votante pendiente a confirmar');
    }

    public function show($id)
    {
        $problem = Formulario::findOrFail($id);
        $users = DB::table('users')->get();

        if (!$problem) {
            return back()->with('error', 'Error al mostrar la Oportunidad de votante');
        }

        return view('problems.show', compact('problem', 'users'));
    }
}
