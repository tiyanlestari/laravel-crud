<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matkul extends Model
{
    use HasFactory;
    protected $table = 'matkuls'; // Check if your table name is correct
    // protected $primaryKey = 'id_matkul';
    protected $guarded = [];

    public function Nilai():BelongsTo
     {
        return $this->belongsTo(Nilai::class);
    }

    public function Mahasiswa():BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class,"nilais");
    }

}
