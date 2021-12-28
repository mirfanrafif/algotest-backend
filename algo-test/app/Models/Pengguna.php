<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'id';

    protected $fillable = ['nama', 'role'];

    public function status()
    {
        return $this->hasMany(Status::class);
    }
}
