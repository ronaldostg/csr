<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bapi extends Model
{
    use HasFactory;
            protected $table = "t_ba_pi";

    protected $primaryKey = 'id_bapi';

    protected $guarded = [];


    
}
