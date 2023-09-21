<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
// , WithHeadingRow

class ImportUser implements ToModel  
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'User Id'     => $row['0'],  
            'Load Date'    => $row['1'],   
            'Alarm Status' => $row['3'],, 
            
            
        ]);
    }
}
