<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsTemp extends Model
{
    use HasFactory;

    protected $table = "mhs_temp";
    protected $guarded = [];

    public $incrementing = false;
    public $timestamps = false;
}
