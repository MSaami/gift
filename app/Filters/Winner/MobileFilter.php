<?php

namespace App\Filters\Winner;

class MobileFilter
{
    public function apply($builder, $value)
    {
        return $builder->where('mobile', $value);
    }
}
