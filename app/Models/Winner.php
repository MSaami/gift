<?php

namespace App\Models;

use App\Filters\Winner\WinnerFilter;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Morilog\Jalali\Jalalian;

class Winner extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'mobile'
    ];

    public function scopeFilter(Builder $builder, array $filters)
    {
        return (new WinnerFilter($builder, $filters))
            ->setFilter()
            ->setOrder()
            ->getWithPaginate();
    }

    public function code()
    {
        return $this->belongsTo(Code::class);
    }

    public function getJalaliCreatedAtAttribute()
    {
        return Jalalian::forge($this->created_at)->format('%d %B، %Y - %H:%m');
    }

}
