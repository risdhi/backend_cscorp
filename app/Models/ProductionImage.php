<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_id',
        'image',
    ];

    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
