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
        return DataTables::of($this->model::query())
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
            'zona' => 'required'
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
                'created_at' => Carbon::now(),
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
        } else {
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

        $usuario->rol = implode(",", $usuario->getRoleNames()->toArray());
        return view(trans($this->plural) . ".actualizar", compact('usuario', 'info', 'users'));
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
            'zona' => 'required'
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
                'referido_id' => $request->referido,
                'updated_at' => Carbon::now(),
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
        } else {
            $usuario->assignRole('simple');
            $usuario->removeRole('administrador');
        }

        Alert::success(trans($this->className), 'Se ha actualizado el usuario con exito!');
        return redirect()->route(trans($this->plural));
    }
}
