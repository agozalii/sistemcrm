<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiModel extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(ProdukModels::class, 'produk_id', 'id');
    }
    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'transaksi_id', 'id');
    }
    public function gift()
    {
        return $this->belongsTo(GiftModel::class, 'gift_id', 'id');
    }
}
