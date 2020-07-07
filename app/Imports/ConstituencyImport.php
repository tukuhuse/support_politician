<?php

namespace App\Imports;

use App\Constituency;
use Maatwebsite\Excel\Concerns\ToModel;

class ConstituencyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Constituency([
            //
        ]);
    }
}
