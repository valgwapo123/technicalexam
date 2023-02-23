<?php

namespace App\Imports;


use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Fileupload;
use Maatwebsite\Excel\Concerns\ToModel;
class ImportCsv implements ToModel , WithStartRow
{
    

   public function startRow(): int
    {
        return 2;
    }
 
  public function model(array $row)
    {

     
         return new Fileupload([
            // 'id' =>session('id')
            'title' => $row[1],
            'firstname' => $row[0],
            'lastname' => $row[4],
            'mobilenumber'=>  $row[3],
            'companyname'=>  $row[2],

        ]);
    
    }
      
}


