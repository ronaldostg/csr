<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;
        protected $table = "t_master";

    protected $primaryKey = 'id_master';

    protected $guarded = [];
}
