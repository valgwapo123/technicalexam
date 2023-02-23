<?php

namespace App\Imports;

use App\Models\Fileupload;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithStartRow;


class Checkheader implements ToModel 
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {


    
    }
}
