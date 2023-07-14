<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    use HasFactory;
    use HasFactory;
        protected $table = "t_log";

    protected $primaryKey = 'id_log';

    protected $guarded = [];
}
