<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
class Fileupload extends Model
{
    use HasFactory;


    protected $fillable = [
    'title',
    'firstname',
    'lastname',
    'mobilenumber',
    'companyname',
  ];
}
