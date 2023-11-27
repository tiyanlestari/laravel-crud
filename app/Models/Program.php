<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;
    protected $table = 'program-studi';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function Mahasiswa():HasMany{
        return $this->hasMany(Mahasiswa::class);
    }
}
