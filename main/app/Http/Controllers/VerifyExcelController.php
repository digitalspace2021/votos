<?php

namespace App\Http\Controllers;

use App\Http\Services\Import\FormImportService;
use App\Models\Formulario;
use App\Models\PreFormulario;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use Maatwebsite\Excel\Facades\Excel;

class VerifyExcelController extends Controller
{
    protected $resp;

    public function __construct()
    {
        $this->resp = new ResponseService();
    }

    public function index()
    {
        return view('import.verify');
    }

    public function verify(Request $request)
    {
        $file = $request->file('file');

        $data = Excel::import(new FormImportService, $file);

        $data = $data->toArray(new FormImportService, $file);

        $headers = $this->validateExcel($data);

        $identifications = $this->verifyIdentification($data);

        if (empty($headers) && empty($identifications['oficiales']) && empty($identifications['posibles_votantes']) && empty($identifications['importados'])) {
            return $this->resp->response('success', 'El archivo es válido', 200);
        }

        $errors = [
            'headers' => $headers,
            'identifications' => $identifications,
        ];

        return response()->json($errors, 400);
    }
    
    /**
     * Validates the Excel data against the expected columns.
     *
     * @param array $data The Excel data to validate.
     *
     * @return array Returns an empty array if the data is valid, or an array of missing columns if invalid.
     */
    private function validateExcel($data)
    {
        $columns = ['nombres', 'apellidos', 'identificacion', 'email', 'telefono', 'genero', 'direccion', 'puesto_votacion', 'mensaje', 'mesa'];

        $data = $data[0];

        if (empty($data[0])) {
            return false;
        }

        $headers = array_keys($data[0]);

        $compare = array_diff($columns, $headers);
        if (empty($compare)) {
            return [];
        }

        return $compare;
    }

    /**
     * Verify the identification of the voters in the given data array.
     *
     * @param array $data The data array containing the voters' information.
     * @return array An array containing the errors found during the verification process.
     * The array has three keys: 'Oficiales', 'Posibles votantes', and 'Importados'.
     * The values of each key are arrays containing the identification numbers of the voters with errors.
     */
    private function verifyIdentification($data): array
    {
        $errors = [
            'oficiales' => [],
            'posibles_votantes' => [],
            'importados' => [],
        ];
        $data = $data[0];

        foreach ($data as $key => $value) {
            $identification = (int) $value['identificacion'];
            //$data[$key]['telefono'] = (int) $value['telefono'];

            $form = Formulario::where('identificacion', $identification)->first();

            if ($form && $form->estado == true) {
                array_push($errors['oficiales'], $form->identificacion);
            }else if($form && $form->estado == false){
                array_push($errors['posibles_votantes'], $form->identificacion);
            }
        }

        foreach ($data as $key => $value) {
            $identification = (int) $value['identificacion'];

            $form = PreFormulario::where('identificacion', $identification)->first();

            if ($form) {
                array_push($errors['importados'], $form->identificacion);
            }
        }

        return $errors;
    }
}
