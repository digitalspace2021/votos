<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreFormulario\StoreRequest;
use App\Models\Candidato;
use App\Models\Formulario;
use App\Models\PreFormulario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PreFormularioController extends Controller
{
    public function index(): View
    {
        $comunas = DB::table('comunas')->select('id', 'name')->get();
        $barrios = DB::table('barrios')->select('id', 'name')->get();
        $candidatos = Candidato::select('id', 'name')->get();
        $creadores = User::select('id', 'name')->get();
        $corregimientos = DB::table('corregimientos')->select('id', 'name')->get();
        $veredas = DB::table('veredas')->select('id', 'name')->get();
        return view('pre_forms.index', compact('creadores', 'candidatos', 'comunas', 'barrios', 'corregimientos', 'veredas'));
    }

    public function getAll(Request $request)
    {
        $pre_forms = DB::table('pre_formularios')
            ->join('users', 'pre_formularios.propietario_id', '=', 'users.id')
            ->leftJoin('barrios', 'pre_formularios.zona', '=', 'barrios.id')->leftJoin('comunas', 'barrios.comuna_id', '=', 'comunas.id')
            ->leftJoin('veredas', 'pre_formularios.zona', '=', 'veredas.id')->leftJoin('corregimientos', 'veredas.corregimiento_id', '=', 'corregimientos.id')
            ->select('pre_formularios.id', 'pre_formularios.identificacion', 'pre_formularios.nombre', 'pre_formularios.apellido', 'pre_formularios.telefono', 'pre_formularios.direccion', 'users.name', 'users.id as creator_id', 'pre_formularios.puesto_votacion', 'pre_formularios.created_at', 'pre_formularios.email', 'pre_formularios.propietario_id')
            ->addSelect(DB::raw("CONCAT(pre_formularios.nombre, ' ', pre_formularios.apellido) AS nombre_completo"))
            /* filter for cedula, nombre+apellido, created_at or creator_id */
            ->when($request->get('cedula'), function ($query, $cedula) {
                return $query->where('pre_formularios.identificacion', 'like', '%' . $cedula . '%');
            })
            ->when($request->get('nombre'), function ($query, $nombre_completo) {
                return $query->where(DB::raw("CONCAT(pre_formularios.nombre, ' ', pre_formularios.apellido)"), 'like', '%' . $nombre_completo . '%');
            })
            ->when($request->get('created_at'), function ($query, $created_at) {
                return $query->whereDate('pre_formularios.created_at', $created_at);
            })
            ->when($request->get('creador'), function ($query, $creator_id) {
                return $query->where('users.id', $creator_id);
            })
            ->when($request->get('comuna'), function ($query, $comuna) {
                return $query->where('pre_formularios.tipo_zona', 'comuna')
                    ->where('barrios.comuna_id', $comuna);
            })
            ->when($request->get('barrio'), function ($query, $barrio) {
                return $query->where('pre_formularios.tipo_zona', 'comuna')
                    ->where('pre_formularios.zona', $barrio);
            })
            ->when($request->get('corregimiento'), function ($query, $corregimiento) {
                return $query->where('pre_formularios.tipo_zona', 'corregimiento')
                    ->where('veredas.corregimiento_id', $corregimiento);
            })
            ->when($request->get('vereda'), function ($query, $vereda) {
                return $query->where('formularios.tipo_zona', 'comuna')
                    ->where('pre_formularios.zona', $vereda);
            })
            ->orderBy('pre_formularios.created_at', 'desc');

        if (Auth::user()->hasRole('simple')) {
            $pre_forms = $pre_forms->where('propietario_id', Auth::user()->id);
        }

        /* colums nombre completo from pre_formularios nombre+apellido, telefono, direccion, responsable, pruesto_votacion from table pre_formularios and columns acciones view, edit and status */
        $pre_forms = DataTables::of($pre_forms->get())
            ->editColumn('created_at', function ($col) {
                return Carbon::parse($col->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('acciones', function ($pre_form) {
                /* $btn = ''; */
                $btn = '<a href="' . route('pre-formularios.show', $pre_form->id) . '" class="btn btn-outline-secondary btn-sm" title="Ver problema"><i class="fa fa-eye"></i></a>';
                $btn .= '<a href="' . route('pre-formularios.edit', $pre_form->id) . '" class="btn btn-outline-primary m-2 btn-sm" title="Editar problema"><i class="fa fa-edit"></i></a>';
                if(Auth::user()->hasRole('administrador')){
                    $btn .= '<a href="' . route('pre-formularios.destroy', $pre_form->id) . '" class="btn btn-outline-danger btn-sm" title="Eliminar problema"><i class="fa fa-times"></i></a>';
                }
                $btn .= '<button prid="' . $pre_form->id . '" class="btn btn-outline-success m-2 status btn-sm" title="Cambiar estado"><i class="fa fa-check"></i></button>';

                return $btn;
            })
            ->rawColumns(['acciones', 'status'])
            ->make(true);

        return $pre_forms;
    }

    public function show($id)
    {
        $formulario = PreFormulario::findOrFail($id);

        $formulario->candidato_nombre = Candidato::find($formulario->candidato_id)->name;
        $formulario->propietario_nombre = User::find($formulario->propietario_id)->name;
        if (!$formulario) {
            return back()->with('error', 'Error al mostrar la preview del formulario');
        }

        /* dd($formulario); */

        return view('pre_forms.show', compact('formulario'));
    }

    /**
     * The `edit` function retrieves a pre-form from the database and passes it to the view along with
     * a list of users and candidates.
     * 
     * @param id The parameter `` is the identifier of the `PreFormulario` record that needs to be
     * edited. It is used to retrieve the specific `PreFormulario` instance from the database using the
     * `findOrFail` method.
     * 
     * @return View a View.
     */
    public function edit($id): View
    {
        $pre_formulario = PreFormulario::findOrFail($id);
        if (!$pre_formulario) {
            return back()->with('error', 'Error al mostrar la preview del formulario');
        }

        $users = DB::table('users')->get();
        $candidatos = DB::table('candidatos')->get();

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

        return view('pre_forms.edit', compact('pre_formulario', 'users', 'candidatos', 'puestos'));
    }

    public function update(StoreRequest $request, $id)
    {
        $pre_formulario = PreFormulario::findOrFail($id);
        if (!$pre_formulario) {
            return back()->with('error', 'Error al actualizar la preview del formulario');
        }

        $pre_formulario->update([
            'propietario_id' => $request->creador,
            'candidate_id' => $request->candidato,
            'identificacion' => $request->identificacion,
            'nombre' => $request->nombres,
            'apellido' => $request->apellidos,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'puesto_votacion' => $request->puesto,
            'mesa' => $request->mesa,
            'genero' => $request->genero,
            'email' => $request->email,
            'mensaje' => $request->descripcion,
            'tipo_zona' => $request->tipo_zona,
            'zona' => $request->zona,
        ]);

        return redirect()->route('pre-formularios')->with('success', 'Formulario actualizado correctamente');
    }

    /**
     * The function `approvedInfo` approves a preview form by creating a new form with the same data
     * and deleting the preview form.
     * 
     * @param int id The parameter "id" is an integer that represents the ID of the pre_formulario
     * record that needs to be approved.
     * 
     * @return RedirectResponse a RedirectResponse.
     */
    public function approvedInfo(int $id): RedirectResponse
    {
        $pre_formulario = PreFormulario::findOrFail($id);
        if (!$pre_formulario) {
            return back()->with('error', 'Error al aprobar la preview del formulario');
        }

        if (!$pre_formulario->direccion || !$pre_formulario->puesto_votacion) {
            return back()->with('error', 'Para aprobar es necesario que el formulario tenga email, dirección y puesto de votación');
        }

        $formulario = Formulario::create([
            'propietario_id' => $pre_formulario->propietario_id,
            'candidato_id' => $pre_formulario->candidato_id,
            'identificacion' => $pre_formulario->identificacion,
            'nombre' => $pre_formulario->nombre,
            'apellido' => $pre_formulario->apellido,
            'telefono' => $pre_formulario->telefono,
            'direccion' => $pre_formulario->direccion,
            'puesto_votacion' => $pre_formulario->puesto_votacion,
            'mesa' => $pre_formulario->mesa,
            'genero' => $pre_formulario->genero,
            'email' => $pre_formulario->email ?? '',
            'mensaje' => $pre_formulario->mensaje,
            'tipo_zona' => $pre_formulario->tipo_zona,
            'zona' => $pre_formulario->zona,
        ]);

        if (!$formulario) {
            return back()->with('error', 'Error al aprobar la preview del formulario');
        }

        $pre_formulario->delete();

        return redirect()->route('pre-formularios')->with('success', 'Formulario aprobado correctamente');
    }

    public function destroy(int $id)
    {
        $pre_formulario = PreFormulario::findOrFail($id);
        if (!$pre_formulario) {
            return back()->with('error', 'Error al eliminar la preview del formulario');
        }

        $pre_formulario->delete();

        return redirect()->route('pre-formularios')->with('success', 'Formulario eliminado correctamente');
    }
}
