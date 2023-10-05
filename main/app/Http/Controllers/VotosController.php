<?php

namespace App\Http\Controllers;

use App\Http\Requests\Votos\StoreRequest;
use App\Http\Resources\Votos\FormResource;
use App\Models\Formulario;
use App\Models\Voto;
use App\Services\ResponseService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class VotosController extends Controller
{
    protected $resp;

    public function __construct()
    {
        $this->resp = new ResponseService();
    }

    public function index()
    {
        return view('Votos.index');
    }

    public function getAll()
    {
        $votos = Voto::query()
            ->get();

        /* dd($votos); */
        /* foreach ($votos as $voto) {
            dd($voto->form->ubicacion());
        } */

        return DataTables::of($votos)
            ->addColumn('identificacion', function ($col) {
                return $col->form->identificacion;
            })
            ->addColumn('creador', function ($col) {
                return $col->form->creador->name;
            })
            ->addColumn('voto', function ($col) {
                return $col->voto ? 'Si' : 'No';
            })
            ->addColumn('fecha', function ($col) {
                return $col->form->created_at;
            })
            ->addColumn('ubicacion', function ($col) {
                return $col->form->ubicacion();
            })
            ->addColumn('acciones', function ($col) {
                /* view, del, and update */
                $btns = '<a href="' . route('votos.show', ['id' => $col->id]) . '" class="btn btn-sm btn-primary mx-2" title="Ver"><i class="fa fa-eye"></i></a>';
                $btns .= '<a href="" class="btn btn-sm btn-warning mx-2" title="Editar"><i class="fa fa-edit"></i></a>';
                $btns .= '<a href="" class="btn btn-sm btn-danger mx-2" title="Eliminar"><i class="fa fa-trash"></i></a>';
                return $btns;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(string $id)
    {
        $voto = Voto::find($id);

        if (!$voto) {
            return redirect()->route('votos.index')->with('error', 'No se encontro el voto');
        }

        return view('votos.show', compact('voto'));
    }

    public function create(string $form_id = null): View
    {
        return view('votos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $option = strtolower($request->voto) == 'si' ? true : false;

        $voto = Voto::create([
            'voto' => $option,
            'form_id' => $request->form_id,
        ]);

        if ($voto) {
            return redirect()->route('votos.index')->with('success', 'Voto registrado correctamente');
        }

        return redirect()->route('votos.index')->with('error', 'No se pudo registrar el voto');
    }

    /**
     * Retrieve a form by identification and return it as a FormResource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\FormResource|\Illuminate\Http\JsonResponse
     */
    public function getFormIdentification(Request $request)
    {
        $form = Formulario::select('formularios.id', 'formularios.identificacion', 'formularios.created_at', 'direccion', 'tipo_zona', 'nombre', 'apellido', 'zona', 'users.name as registrador')
            ->join('users', 'formularios.propietario_id', '=', 'users.id')
            ->where('formularios.identificacion', $request->identificacion)
            ->where('estado', true)
            ->first();

        if (!$form) {
            return $this->resp->response('error', 'No se encontro el formulario', 404);
        }

        if ($this->verificationHasVoto($form->id)) {
            return $this->resp->response('error', 'El formulario ya tiene un voto registrado', 400);
        }

        $form->ubicacion = $form->ubicacion();

        return new FormResource($form);
    }

    public function verificationHasVoto(string $id)
    {
        $voto = Voto::where('form_id', $id)->first();

        if ($voto) {
            return true;
        }

        return false;
    }
}
