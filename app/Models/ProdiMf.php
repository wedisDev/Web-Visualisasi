<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiMf extends Model
{
    use HasFactory;

    protected $table = "prodi_mf";
    protected $guarded = [];

    public $incrementing = false;
    public $timestamps = false;
}
