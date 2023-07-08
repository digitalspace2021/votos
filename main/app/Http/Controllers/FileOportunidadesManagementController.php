<?php

namespace App\Http\Controllers;

use App\Exports\Oportunidades\ExportService;
use Maatwebsite\Excel\Facades\Excel;

class FileOportunidadesManagementController extends Controller
{
    public function export()
    {
        return Excel::download(new ExportService, 'posibles_votantes_'.now().'.xlsx');
    }
}
