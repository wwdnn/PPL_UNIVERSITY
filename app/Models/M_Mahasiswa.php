<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Mahasiswa extends Model
{
  protected $table = 'mahasiswa';
  protected $primaryKey = 'NIM';
  protected $allowedFields = ['NIM', 'Nama', 'Nilai_UTS', 'Nilai_UAS'];
}