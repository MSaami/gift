<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'code' , 'remaining', 'is_active'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function winners()
    {
        return $this->hasMany(Winner::class);
    }

    public function isValid()
    {
        return (bool) $this->is_active && $this->hasRemaining();
    }

    public function hasRemaining()
    {
        return (bool) $this->remaining;
    }

    public function filterWinnerBy($mobile)
    {
        return  $this->winners->where('mobile', $mobile);
    }

    public function alreadyWinBy($mobile)
    {
       return $this->filterWinnerBy($mobile)->isNotEmpty();
    }

}
