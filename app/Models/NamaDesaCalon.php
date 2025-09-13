<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaDesaCalon extends Model
{
    use HasFactory;
    protected $fillable = ['nama_desa_calon'];
    protected $table = "nama_desa_calon";
}
