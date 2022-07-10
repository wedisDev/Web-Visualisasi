<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveSesi extends Model
{
    use HasFactory;

    protected $table = "save_sesi";
    protected $guarded = [];

    public $incrementing = false;
    public $timestamps = false;
}
