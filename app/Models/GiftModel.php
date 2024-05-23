<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftModel extends Model
{
    use HasFactory;
    protected $table = 'gifts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_gift',
        'gambar_gift',
        'poin_cost',
        'stock',
        'deskripsi',
    ];
    
    public function klaimPoins()
    {
        return $this->hasMany(KlaimPoinModel::class, 'gift_id', 'id');
    }
}
