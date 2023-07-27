<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioEdil\StoreRequest;
use App\Models\UserEdiles;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UsuariosEdilController
{
    protected $type;

    /**
     * The function sets the type of user based on the request and redirects to the appropriate route
     * if the type is not valid.
     * 
     * @param Request request The  parameter is an instance of the Request class, which is used
     * to retrieve information about the current HTTP request. It contains data such as the request
     * method, URL, headers, and input data. In this case, it is used to retrieve the 'type' parameter
     * from the request.
     * 
     * @return If the type is not 'Edil' or 'Asambleista', a redirect response is being returned.
     * Otherwise, nothing is being returned.
     */
    public function __construct(Request $request)
    {
        if (in_array($this->type, ['Edil', 'Asambleista'])) {
            $this->type = 'Edil';
            return redirect()->route('users-edils.index', ['type' => 'Edil']);
        }
        $this->type = $request->type;
    }

    /**
     * The index function returns a view with the type variable passed to the usuarios-ediles.index
     * view.
     * 
     * @return View A view is being returned. The view being returned is 'usuarios-ediles.index' and it
     * is being passed an array with a key 'type' and a value of ->type.
     */
    public function index(): View
    {
        return view('usuarios-ediles.index', ['type' => $this->type]);
    }

    public function getAll()
    {
        $edils = DB::table('usuarios_ediles')
            ->select('usuarios_ediles.*')
            ->addSelect(DB::raw("CONCAT(usuarios_ediles.nombres, ' ', usuarios_ediles.apellidos) AS nombre_completo"))
            ->where('usuarios_ediles.rol', '=', $this->type)
            ->get();

        $edils = DataTables::of($edils)
            ->editColumn('created_at', function ($col) {
                return Carbon::parse($col->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('acciones', function ($edil) {
                $btn = '<a href="' . route('users-edils.show', $edil->id) . '" class="btn btn-outline-secondary btn-sm" title="Ver problema"><i class="fa fa-eye"></i></a>';
                if (Auth::user()->hasRole('administrador')) {
                    $btn .= '<a href="' . route('users-edils.destroy', $edil->id) . '" class="btn btn-outline-danger btn-sm" title="Eliminar edil"><i class="fa fa-times"></i></a>';
                }
                $btn .= '<a href="' . route('users-edils.edit', [
                    'id' => $edil->id,
                    'type' => $this->type
                ]) . '" class="btn btn-outline-primary m-2 btn-sm" title="Editar problema"><i class="fa fa-edit"></i></a>';

                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);

        return $edils;
    }

    public function create()
    {
        $puestos = DB::table('puestos_votacion AS pv')
            ->select(DB::raw("CONCAT('Puesto: ', COALESCE(pv.name, 'Sin información'), ', ', 
                CASE
                    WHEN pv.zone_type = 'Comuna' THEN CONCAT('Barrio: ', COALESCE(barrios.name, 'Sin información'))
                    WHEN pv.zone_type = 'Corregimiento' THEN CONCAT('Vereda: ', COALESCE(veredas.name, 'Sin información'))
                END) AS puesto_nombre, pv.id"))
                /* after case */
                /* , ', Mesa: ', COALESCE(mv.numero_mesa, 'Sin información')) AS puesto_nombre */
            ->leftJoin('mesas_votacion AS mv', 'pv.id', '=', 'mv.puesto_votacion')
            ->leftJoin('barrios', function ($join) {
                $join->on('pv.zone', '=', 'barrios.id')
                    ->where('pv.zone_type', '=', 'Comuna');
            })
            ->leftJoin('veredas', function ($join) {
                $join->on('pv.zone', '=', 'veredas.id')
                    ->where('pv.zone_type', '=', 'Corregimiento');
            })
            ->get();
            $type = $this->type;

        return view('usuarios-ediles.create', compact('puestos', 'type'));
    }

    /**
     * The function stores user information in the database and redirects the user to the index page
     * with a success message if successful, or an error message if not.
     * 
     * @param StoreRequest request The  parameter is an instance of the StoreRequest class. It
     * is used to retrieve the data submitted in the HTTP request. In this case, it is used to retrieve
     * the values of the following fields: nombres, apellidos, identificacion, direccion, email,
     * genero, zona, and
     * 
     * @return RedirectResponse a RedirectResponse.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $usuario = UserEdiles::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'identificacion' => $request->identificacion,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'genero' => $request->genero,
            'zona' => $request->zona,
            'tipo_zona' => $request->tipo_zona,
            'descripcion' => $request->descripcion,
            'puesto_votacion' => $request->puesto_votacion,
            'mesa' => $request->mesa,
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('ediles', 'public');
            $usuario->foto = $path;
            $usuario->save();
        }

        if ($this->type == 'Asambleista') {
            $usuario->rol = 'Asambleista';
            $usuario->save();
        }

        if (!$usuario) {
            return redirect()->back()->with('error', 'No se pudo crear el usuario');
        }

        return redirect()->route('users-edils.index', ['type' => $this->type])->with('success', 'Usuario creado correctamente');
    }

    /**
     * The function retrieves a user with a specific ID and returns a view for editing the user's
     * information.
     * 
     * @param int id The "id" parameter is an integer that represents the unique identifier of the user
     * that needs to be edited.
     * 
     * @return RedirectResponse a RedirectResponse object.
     */
    public function edit(int $id): View
    {
        $edil = UserEdiles::find($id);
        $puestos = DB::table('puestos_votacion AS pv')
            ->select(DB::raw("CONCAT('Puesto: ', COALESCE(pv.name, 'Sin información'), ', ', 
                CASE
                    WHEN pv.zone_type = 'Comuna' THEN CONCAT('Barrio: ', COALESCE(barrios.name, 'Sin información'))
                    WHEN pv.zone_type = 'Corregimiento' THEN CONCAT('Vereda: ', COALESCE(veredas.name, 'Sin información'))
                END) AS puesto_nombre, pv.id"))
                /* after case */
                /* , ', Mesa: ', COALESCE(mv.numero_mesa, 'Sin información')) AS puesto_nombre */
            ->leftJoin('mesas_votacion AS mv', 'pv.id', '=', 'mv.puesto_votacion')
            ->leftJoin('barrios', function ($join) {
                $join->on('pv.zone', '=', 'barrios.id')
                    ->where('pv.zone_type', '=', 'Comuna');
            })
            ->leftJoin('veredas', function ($join) {
                $join->on('pv.zone', '=', 'veredas.id')
                    ->where('pv.zone_type', '=', 'Corregimiento');
            })
            ->get();

        if (!$edil) {
            return redirect()->back()->with('error', 'No se pudo encontrar el usuario');
        }

        $type = $this->type;

        return view('usuarios-ediles.edit', compact('edil', 'puestos', 'type'));
    }

    /**
     * The function updates a user's information and redirects to the index page with a success
     * message.
     * 
     * @param int id The id parameter is the unique identifier of the user that needs to be updated. It
     * is used to find the user record in the database.
     * @param StoreRequest request The  parameter is an instance of the StoreRequest class. It
     * is used to retrieve the data submitted in the form for updating a user. The StoreRequest class
     * likely extends the FormRequest class and contains validation rules and logic for validating the
     * form data before updating the user.
     * 
     * @return RedirectResponse a RedirectResponse.
     */
    public function update(int $id, StoreRequest $request): RedirectResponse
    {
        $usuario = UserEdiles::find($id);

        if (!$usuario) {
            return redirect()->back()->with('error', 'No se pudo encontrar el usuario');
        }

        $usuario->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'identificacion' => $request->identificacion,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'genero' => $request->genero,
            'zona' => $request->zona,
            'tipo_zona' => $request->tipo_zona,
            'descripcion' => $request->descripcion,
            'puesto_votacion' => $request->puesto_votacion,
            'mesa' => $request->mesa,
        ]);

        if ($request->hasFile('foto')) {
            if ($usuario->foto) {
                Storage::disk('public')->delete($usuario->foto);
            }

            $path = $request->file('foto')->store('ediles', 'public');
            $usuario->foto = $path;
            $usuario->save();
        }

        return redirect()->route('users-edils.index', ['type' => $this->type])->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * The function retrieves a UserEdiles object with the given ID and returns a view with the object
     * if found, otherwise it redirects back with an error message.
     * 
     * @param int id The "id" parameter is an integer that represents the unique identifier of a user.
     * It is used to find a specific user in the database.
     * 
     * @return View a View.
     */
    public function show(int $id): View
    {
        $edil = UserEdiles::find($id);

        if (!$edil) {
            return redirect()->back()->with('error', 'No se pudo encontrar el usuario');
        }

        return view('usuarios-ediles.show', compact('edil'));
    }

    /**
     * The function destroys a user with the given ID and redirects to the index page with a success
     * message if successful, or an error message if the user does not exist.
     * 
     * @param int id The "id" parameter is an integer that represents the unique identifier of the user
     * that needs to be deleted.
     * 
     * @return RedirectResponse a RedirectResponse.
     */
    public function destroy(int $id): RedirectResponse
    {
        $usuario = UserEdiles::find($id);

        if (!$usuario) {
            return redirect()->back()->with('error', 'No se pudo eliminar el usuario');
        }

        if ($usuario->foto) {
            Storage::disk('public')->delete($usuario->foto);
        }

        $usuario->delete();

        return redirect()->route('users-edils.index')->with('success', 'Usuario eliminado correctamente');
    }
}
