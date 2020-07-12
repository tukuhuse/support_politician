<?php

namespace App\Imports;

use App\Speaker_group;
use Maatwebsite\Excel\Concerns\ToModel;

class Speaker_groupImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Speaker_group([
            //
            'name' => $row[0]
        ]);
    }
}
