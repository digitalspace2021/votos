<?php

namespace App\Http\Services\Import;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FormImportService implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        return $rows;
    }

    // headingRow function is use for specific row heading in your xls file
    /* public function headingRow(): int
    {
        return 3;
    } */
}
