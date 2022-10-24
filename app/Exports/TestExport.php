<?php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class TestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contact::where('user_id',Auth::id())->get();
    }
}
