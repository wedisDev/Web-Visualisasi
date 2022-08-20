<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranOnline extends Model
{
    use HasFactory;

    protected $table = "pendaftaran_online";
    protected $guarded = [];

    public $incrementing = false;
    public $timestamps = false;
}
