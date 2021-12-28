<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';
    protected $primaryKey = 'id';

    protected $fillable = ['barang_id', 'user_id', 'jumlah'];

    public function barang()
    {
        return $this->belongsTo('barang');
    }

    public function user()
    {
        return $this->belongsTo('pengguna');
    }
}
