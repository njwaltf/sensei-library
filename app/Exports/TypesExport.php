<?php

namespace App\Exports;

use App\Models\Type;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TypesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings() : array
    {
        // Define your headers here
        return [
            'id',
            'name',
            'desc',
            'created_at',
            'updated_at',
            // Add more headers ,as needed
        ];
    }
    public function collection()
    {
        return Type::all();
    }
}
