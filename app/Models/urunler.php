<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class urunler extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "urunler";

    protected $guarded = [];


}
