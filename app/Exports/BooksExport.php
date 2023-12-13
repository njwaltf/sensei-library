<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings() : array
    {
        // Define your headers here
        return [
            'id',
            'title',
            'publisher',
            'type_id',
            'Stock',
            'publish_date',
            'image',
            'desc',
            'writer',
            'created_at',
            'updated_at'
            // Add more headers as needed
        ];
    }
    public function collection()
    {
        return Book::all();
    }
}
