<?php

namespace App\Http\Resources;


class WinnerCollection extends BaseCollection
{
    public $collects = WinnerResource::class;

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => $this->withPaginate()
        ];
    }

}
