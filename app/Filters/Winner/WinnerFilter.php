<?php

namespace App\Filters\Winner;

use App\Filters\BaseFilter;
use Illuminate\Support\Arr;

class WinnerFilter extends BaseFilter
{
    protected $filtersMap = [
        'code' => CodeFilter::class,
        'mobile' => MobileFilter::class
    ];
}
