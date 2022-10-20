<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;

class TestImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            'id'=> $row[0],
            'firstName'=>$row[1],
            'lastName'=>$row[2],
            'email'=> $row[3],
            'jobTitle'=> $row[4],
            'phone'=> $row[5]

        ]);
    }
}
