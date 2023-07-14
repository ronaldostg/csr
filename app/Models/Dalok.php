<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dalok extends Model
{
    use HasFactory;
    protected $table = "dana_alokasi";

    protected $primaryKey = 'id_alokasi';
    public $timestamps = false;
    protected $guarded = [];
}
