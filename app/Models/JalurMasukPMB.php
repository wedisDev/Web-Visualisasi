<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurMasukPMB extends Model
{
    use HasFactory;

    protected $table = "jalur_masuk_pmb";
    protected $primaryKey = "id_jalur";
    protected $guarded = [];

    public $incrementing = false;
    public $timestamps = false;
}
