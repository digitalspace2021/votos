<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use App\Models\User;
use App\Traits\Listusers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use RealRashid\SweetAlert\Facades\Alert;

class UsuarioController extends Controller
{

    use Listusers;
    protected $model;
    public function __construct()
    {
        $this->model = new User;
        parent::__construct($this->model);
    }

    //diferents?
    public function tabla()
    {
        $users = $this->model::query();

        $users = $users->select('users.*', 'formularios.id as formulario_id')
            ->leftJoin('formularios', 'users.identificacion', '=', 'formularios.identificacion');

        return DataTables::of($users)
            ->addColumn('rol', function ($col) {
                return implode(",", $col->getRoleNames()->toArray());
            })
            ->editColumn('updated_at', function ($col) {
                return Carbon::parse($col->updated_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('acciones', function ($col) {
                $btn =  '<a href="' . route(trans($this->plural) . ".ver", $col->id) . '" class="btn btn-outline-secondary" title="Ver ' . trans($this->singular) .  ' "><i class="fa fa-eye"></i></a>';
                if (Auth::user()->hasRole('administrador')) {
                    $btn .= '<a href="' . route(trans($this->plural) . ".actualizar", $col->id) . '" class="btn btn-outline-primary m-2" title="Editar ' . trans($this->singular) .  ' "><i class="fa fa-edit"></i></a>';
                    if ($col->id != 1) {
                        $btn .= '<a href="' . route(trans($this->plural) . ".eliminar", $col->id) . '" class="btn btn-outline-danger" title="Eliminar ' . trans($this->singular) .  ' "><i class="fa fa-times"></i></a>';
                    }
                }

                if(!$col->formulario_id && Auth::user()->hasRole('administrador')){
                    $btn .=  '<button user_id='.$col->id.' class="btn btn-outline-success ml-2 generate" title="Generar Formulario ' . trans($this->singular) .  '"><i class="fa fa-check"></i></button>';
                }
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    //diferents?
    public function crear_guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'rol' => 'required',
            'password' => 'required|confirmed|min:6',
            'identificacion' => 'required|unique:users,identificacion|min:7|max:15',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            'tipo_zona' => 'required',
            'zona' => 'required',
            'telefono' => 'required|min:7|max:15',
            'fecha_nacimiento' => ['nullable','date', 'before:today'],
        ]);

        $usuario = new $this->model();
        $usuario->identificacion = $request->identificacion;
        $usuario->name = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);

        if ($usuario) {
            $info = DB::table('info_users')->insertGetId([
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'genero' => $request->genero,
                'tipo_zona' => $request->tipo_zona,
                'zona' => $request->zona,
                'observaciones' => $request->descripcion,
                'referido_id' => $request->referido,
                'puesto' => $request->puesto_votacion,
                'mesa' => $request->mesa,
                'created_at' => Carbon::now(),
                'fecha_nacimiento' => $request->fecha_nacimiento,
            ]);

            if ($info) {
                $usuario->info_id = $info;
            }
        }
        $usuario->save();

        if ($request->hasFile('foto')) {
            $usuario->foto = $request->file('foto')->store('usuarios', 'public');
            $usuario->save();
        }

        if ($request->rol == 'admin') {
            $usuario->assignRole('administrador');
        }elseif($request->rol == 'callcenter') {
            $usuario->assignRole('callcenter');
        }
        else {
            $usuario->assignRole('simple');
        }

        Alert::success('Formulario', 'Se ha creado el ' . trans($this->singular) . ' con exito!');
        return redirect()->route(trans($this->plural));
    }

    //diferents?
    public function ver(Request $request, $id)
    {
        $usuario = $this->model::find($id);
        if (!$usuario) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . trans($this->singular) . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }

        $info = DB::table('info_users')->where('id', $usuario->info_id)->first();
        $users = DB::table('users')->get();

        $usuario->rol = implode(",", $usuario->getRoleNames()->toArray());
        return view(trans($this->plural) . '.ver', compact('usuario', 'info', 'users'));
    }


    //diferents?
    public function eliminar(Request $request, $id)
    {
        $usuario = $this->model::find($id);
        if (!$usuario) {
            Alert::error(trans($this->className), 'No se ha encontrado el ' . trans($this->singular) . ' solicitado.');
            return redirect()->route(trans($this->plural));
        }

        $info = DB::table('info_users')->where('id', $usuario->info_id)->first();
        $users = DB::table('users')->get();

        $usuario->rol = implode(",", $usuario->getRoleNames()->toArray());
        return view(trans($this->plural) . '.eliminar', compact('usuario', 'info', 'users'));
    }

    public function actualizar(Request $request, $id)
    {
        $usuario = $this->model::find($id);
        if (!$usuario) {
            Alert::error("$this->className", 'No se ha encontrado el usuario solicitado.');
            return redirect()->route('usuarios');
        }

        $info = DB::table('info_users')->where('id', $usuario->info_id)->first();
        $users = DB::table('users')->get();

        $puestos = DB::table('puestos_votacion AS pv')
            ->select(DB::raw("CONCAT('Puesto: ', COALESCE(pv.name, 'Sin información'), ', ', 
                CASE
                    WHEN pv.zone_type = 'Comuna' THEN CONCAT('Barrio: ', COALESCE(barrios.name, 'Sin información'))
                    WHEN pv.zone_type = 'Corregimiento' THEN CONCAT('Vereda: ', COALESCE(veredas.name, 'Sin información'))
                END) AS puesto_nombre, pv.id"))
            /* after case */
            /* , ', Mesa: ', COALESCE(mv.numero_mesa, 'Sin información')) AS puesto_nombre */
            ->leftJoin('barrios', function ($join) {
                $join->on('pv.zone', '=', 'barrios.id')
                    ->where('pv.zone_type', '=', 'Comuna');
            })
            ->leftJoin('veredas', function ($join) {
                $join->on('pv.zone', '=', 'veredas.id')
                    ->where('pv.zone_type', '=', 'Corregimiento');
            })
            ->get();

        $usuario->rol = implode(",", $usuario->getRoleNames()->toArray());
        return view(trans($this->plural) . ".actualizar", compact('usuario', 'info', 'users', 'puestos'));
    }

    //diferents?
    public function actualizar_guardar(Request $request, $id)
    {

        $usuario = $this->model::find($id);
        if (!$usuario) {
            Alert::error(trans($this->className), 'No se ha encontrado el usuario solicitado.');
            return redirect()->route(trans($this->plural));
        }

        $request->validate([
            'identificacion' => 'required|min:7|max:15|unique:users,identificacion,' . $usuario->id,
            'nombre' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $usuario->id,
            'rol' => 'required',
            'password' => 'nullable|confirmed',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            'tipo_zona' => 'required',
            'zona' => 'required',
            'fecha_nacimiento' => ['nullable','date', 'before:today'],
        ]);

        $usuario->name = $request->nombre;
        $usuario->email = $request->email;

        if ($request->password) {
            $usuario->password = Hash::make($request->password);
        }

        if ($usuario->info_id) {
            $info = DB::table('info_users')->where('id', $usuario->info_id)->update([
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'genero' => $request->genero,
                'tipo_zona' => $request->tipo_zona,
                'zona' => $request->zona,
                'observaciones' => $request->descripcion,
                'puesto' => $request->puesto_votacion,
                'mesa' => $request->mesa,
                'referido_id' => $request->referido,
                'updated_at' => Carbon::now(),
                'fecha_nacimiento' => $request->fecha_nacimiento
            ]);
        } else {
            $info = DB::table('info_users')->insertGetId([
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'genero' => $request->genero,
                'tipo_zona' => $request->tipo_zona,
                'zona' => $request->zona,
                'observaciones' => $request->descripcion,
                'referido_id' => $request->referido,
                'created_at' => Carbon::now(),
                'fecha_nacimiento' => $request->fecha_nacimiento
            ]);

            if ($info) {
                $usuario->info_id = $info;
            }
        }

        $usuario->save();

        if ($request->hasFile('foto')) {
            if ($usuario->foto) {
                Storage::disk('public')->delete($usuario->foto);
            }

            $path = $request->file('foto')->store('usuarios', 'public');
            $usuario->foto = $path;
            $usuario->save();
        }

        if ($request->rol == 'admin') {
            $usuario->assignRole('administrador');
            $usuario->removeRole('simple');
            $usuario->removeRole('callcenter');
        }elseif($request->rol == 'callcenter') {
            $usuario->assignRole('callcenter');
            $usuario->removeRole('simple');
            $usuario->removeRole('administrador');
        }
        else {
            $usuario->assignRole('simple');
            $usuario->removeRole('administrador');
            $usuario->removeRole('callcenter');
        }

        Alert::success(trans($this->className), 'Se ha actualizado el usuario con exito!');
        return redirect()->route(trans($this->plural));
    }

    /**
     * This function generates a form for a user with the given ID, based on their information and
     * validates certain conditions before creating the form.
     * 
     * @param int id The ID of the user for whom the form is being generated.
     * @param Request request The  parameter is an instance of the Request class, which is used
     * to retrieve data from the HTTP request. It contains information such as form input values,
     * headers, cookies, and more. In this function, it is used to retrieve the value of the
     * 'candidato_id' field from
     * 
     * @return a redirect response.
     */
    public function generateForm(int $id, Request $request)
    {
        $user = User::find($id);

        if ($this->validateUserToForm($user->identificacion)) {
            return redirect()->route('usuarios')->with('error', 'El usuario ya tiene un formulario generado, con la identificación: ' . $user->identificacion );
        }

        /* validate if have realtion with info */
        if (!$user->info) {
            return redirect()->route('usuarios')->with('error', 'El usuario le hace falta información, por favor asignar una para poder generar el formulario');
        }

        if($user->info->puesto == null || $user->info->mesa == null){
            return redirect()->route('usuarios')->with('error', 'El usuario no tiene puesto de votación asignado, por favor asignar uno para poder generar el formulario');
        }

        if ($user->info->genero == 'femenino') {
            $user->info->genero = 'Mujer';
        } else if ($user->info->genero == 'masculino') {
            $user->info->genero = 'Hombre';
        } else {
            $user->info->genero = 'Otro';
        }

        Formulario::create([
            'candidato_id' => $request->candidato_id,
            'propietario_id' => $user->info->referido_id ? $user->info->referido_id : $user->id,
            'nombre' => $user->name,
            'apellido' => $user->name,
            'identificacion' => $user->identificacion,
            'email' => $user->email,
            'telefono' => $user->info->telefono,
            'direccion' => $user->info->direccion,
            'genero' => $user->info->genero,
            'tipo_zona' => $user->info->tipo_zona,
            'zona' => $user->info->zona,
            'puesto_votacion' => $user->info->puesto,
            'mesa' => $user->info->mesa,
            'mensaje' => $user->info->observaciones ? $user->info->observaciones : 'Sin información',
            'foto' => $user->foto,
            'created_at' => Carbon::now(),
        ]);

        /* if user has a file image copy the file and copy to the route formulario */
        if ($user->foto) {
            Storage::copy('public/' . $user->foto, 'public/formulario/' . $user->foto);
        }

        return redirect()->route('usuarios')->with('success', 'Se ha generado el formulario con exito!');
    }

    /**
     * The function checks if a user with a given identification exists in the "formularios" table and
     * returns a boolean value indicating the result.
     * 
     * @param string identificacion The parameter "identificacion" is a string that represents the
     * identification of a user.
     * 
     * @return bool a boolean value. It returns true if there is a record in the "formularios" table
     * with the given "identificacion" value, and false otherwise.
     */
    private function validateUserToForm(string $identificacion): bool
    {
        $forms = DB::table('formularios')->where('identificacion', $identificacion)->first(['identificacion']);

        if (!$forms) {
            return false;
        }

        return true;
    }
}
