<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlaimPoinModel extends Model
{
    use HasFactory;
    protected $table = 'klaim_poin';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'gift_id',
        'tanggal_klaim',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gift()
    {
        return $this->belongsTo(GiftModel::class, 'gift_id', 'id');
    }
}
