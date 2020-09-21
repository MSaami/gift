<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    protected function withPaginate()
    {
        return [
            'last_page' => $this->lastPage(),
            'current_page' => $this->currentPage(),
            'per_page' => $this->perPage()
        ];
    }
}
