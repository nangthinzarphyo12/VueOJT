<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPost implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Post([
            'title' => $row[0],
            'description' => $row[1],
            'public_flag' => $row[2],
            'created_by' => $row[3],
        ]);
    }
}
