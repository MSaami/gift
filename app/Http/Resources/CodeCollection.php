<?php

namespace App\Http\Resources;


class CodeCollection extends BaseCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public $collects = CodeResource::class;

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta'=> $this->withPaginate()
        ];
    }
}
