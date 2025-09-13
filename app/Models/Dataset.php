<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];

    public function details()
    {
        return $this->hasMany(Dataset_Detail::class, 'id_dataset');
    }
}
