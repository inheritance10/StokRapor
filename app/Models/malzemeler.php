<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class malzemeler extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = "malzemeler";

    protected $guarded = [];
}
