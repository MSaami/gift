<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WinnerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mobile' => $this->mobile,
            'code' => $this->code,
            'created_at' => $this->created_at
        ];
    }
}
