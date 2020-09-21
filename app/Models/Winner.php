<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile'
    ];

    public function scopeOrderByDate($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function code()
    {
        return $this->belongsTo(Code::class);
    }
}
