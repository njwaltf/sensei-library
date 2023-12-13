<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
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
            'role',
            'username',
            'email',
            'prof_pic',
            'email_verified_at',
            'password',
            'remember_token',
            'created_at',
            'updated_at',
            // Add more headers as needed
        ];
    }
    public function collection()
    {
        return User::all();
    }
}
