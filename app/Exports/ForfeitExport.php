<?php

namespace App\Exports;

use App\Models\Forfeit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ForfeitExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings() : array
    {
        // Define your headers here
        return [
            'id',
            'user_id',
            'book_id',
            'booking_id	',
            'cost',
            'status',
            'pay_image',
            'pay_date',
            'created_at',
            'updated_at'
            // Add more headers as needed
        ];
    }
    public function collection()
    {
        return Forfeit::all();
    }
}
