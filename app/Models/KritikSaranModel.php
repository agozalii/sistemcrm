<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class KritikSaranModel extends Model
{
    use HasFactory;
    protected $table = 'kritiksaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'isi_kritiksaran',
        'tgl_kirim',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


