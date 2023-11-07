<?php

namespace App\Models;

use App\Casts\PriceCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'price' => PriceCast::class,
    ];

    public function estraha()
    {
        return $this->belongsTo(Estraha::class);
    }

}
