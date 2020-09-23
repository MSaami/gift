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
            'created_at' => $this->created_at,
            'code' => $this->code->code,
            'jalali_created_at' => $this->jalali_created_at
        ];
    }
}
