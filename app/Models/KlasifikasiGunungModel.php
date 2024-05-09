<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiGunungModel extends Model
{
    use HasFactory;
    protected $table = 'klasifikasigunung';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama_gunung',
        'gambar_gunung',
        'ketinggian',
        'kesulitan',
        'lama_pendakian',
        'suhu',
    ];
    public function getIdAttribute($value)
    {
        // Jika format ID adalah 'PR' . rand(100, 999)
        return 'GN' . substr($value, 2); // Mengambil angka dari ID yang dihasilkan
    }
}
