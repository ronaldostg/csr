<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAlokasi extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = "t_hist_alokasi";

    protected $primaryKey = 'id';
    public $timestamps = false;
    //pengecualian kolom
    protected $guarded = [];

}
