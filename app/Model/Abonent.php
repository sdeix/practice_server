<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonent extends Model
{
   use HasFactory;
   public $timestamps = false;
   protected $fillable = ['name','surname','patronymic','subdivision','dateofbirth'];
}
