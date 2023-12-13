<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookingsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings() : array
    {
        // Define your headers here
        return [
            'id',
            'book_id',
            'user_id',
            'return_date',
            'expired_date',
            'status',
            'isDenda',
            'book_at',
            'created_at',
            'updated_at'
            // Add more headers as needed
        ];
    }
    public function collection()
    {
        return Booking::all();
    }
}
