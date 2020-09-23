<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class BaseFilter
{
    /**
     * @var Builder
     */
    protected $builder;
    /**
     * @var array
     */
    protected $filters;

    protected $perPage = 10;

    protected $filtersMap = [];


    public function __construct(Builder $builder, array $filters)
    {
        $this->builder = $builder;
        $this->filters = $filters;
    }


    public function setfilter()
    {
        $filtersClass = Arr::only($this->filters, array_keys($this->filtersMap));

        foreach($filtersClass as $key => $value){
            $this->builder = resolve($this->filtersMap[$key])->apply($this->builder, $value);
        }

        return $this;
    }

    public function setOrder()
    {
        $order = $this->filters['order'] ?? 'desc';

        $this->builder->orderBy('created_at', $order);

        return $this;
    }

    public function getWithPaginate()
    {
        $perPage = $this->filters['per_page'] ?? $this->perPage;

        return $this->builder->paginate($perPage);
    }

    public function get()
    {
        return $this->builder->get();
    }

}
