<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MembersImport implements ToModel, WithHeadingRow,WithValidation
{
    use Importable;

    /**
    * @param array $row
    *
    * @return Member
     */
    public function model(array $row)
    {
        Member::store($row['name'],$row['email'],$row['phone']);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];
    }
}
