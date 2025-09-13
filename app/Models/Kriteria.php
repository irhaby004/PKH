<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kriteria', 'peringkat', 'min', 'max'];
    protected $table = "table_kriteria";
}
