<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = [] ;

    public function Nilai():HasMany{
        return $this->hasMany(Nilai::class);
    }

    public function Matkul():BelongsToMany
    {
        return $this->belongsToMany(Matkul::class,"nilais");
    }

    public function Program():BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
