<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HisMf extends Model
{
    use HasFactory;
    protected $table = "his_mf";
    protected $guarded = [];

    public $incrementing = false;
    public $timestamps = false;
}
