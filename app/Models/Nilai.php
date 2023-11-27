<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class   nilai extends Model
{
    use HasFactory;

    protected $guarded= [];
    protected $table = 'nilais';

    public function Mahasiswa():BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function Matkul():BelongsTo
    {
        return $this->belongsTo(Matkul::class);
    }
}
