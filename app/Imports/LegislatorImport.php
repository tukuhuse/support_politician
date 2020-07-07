<?php

namespace App\Imports;

use App\Legislator;
use Maatwebsite\Excel\Concerns\ToModel;

class LegislatorImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Legislator([
            //
            'name' => $row[0],
            'gikai_id' => $row[1],
            'speaker_group_id' => $row[2],
            'constituency_id' => $row[3]
        ]);
    }
}
