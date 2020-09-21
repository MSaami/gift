<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = [
        'code' , 'remaining', 'is_active'
    ];

    public function winners()
    {
        return $this->hasMany(Winner::class);
    }

    public function scopeOrderByDate($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function isValid()
    {
        return (bool) $this->is_active && $this->hasRemaining();
    }

    public function hasRemaining()
    {
        return (bool) $this->remaining;
    }

    public function alreadyWinBy($mobile)
    {
        $winner = $this->winners->where('mobile', $mobile);

        return $winner->isNotEmpty();
    }

}
