<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModels extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama_produk',
        'harga_produk',
        'kategori',
        'deskripsi',
        'merk',
        'ketinggian',
        'kesulitan',
        'lama_pendakian',
        'suhu',
    ];
    public function getIdAttribute($value)
    {
        // Jika format ID adalah 'PR' . rand(100, 999)
        return 'PR' . substr($value, 2); // Mengambil angka dari ID yang dihasilkan
    }
}
