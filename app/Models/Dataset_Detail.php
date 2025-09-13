<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset_Detail extends Model
{
  use HasFactory;
  protected $fillable = ['id_dataset', 'id_kriteria', 'status'];
  protected $table = "dataset_detail";

  public function kriteria()
  {
    return $this->belongsTo(Kriteria::class, 'id_kriteria');
  }
  public function getIsLansiaAttribute()
  {
    if ($this->kriteria->name === 'Umur' && $this->status >= 60) {
        return 'Lansia';
    }
    return 'Bukan Lansia';
  }

}
