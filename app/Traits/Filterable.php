<?php

namespace App\Traits;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $builder, array $filters)
    {
        return (new BaseFilter($builder, $filters))
            ->setFilter()
            ->setOrder()
            ->getWithPaginate();
    }
}
