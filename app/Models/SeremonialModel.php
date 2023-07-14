<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeremonialModel extends Model
{
    use HasFactory;
    protected $table = "t_seremonial";

    protected $primaryKey = 'id';

    protected $guarded = [];

}
