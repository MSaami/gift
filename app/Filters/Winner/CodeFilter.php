<?php

namespace App\Filters\Winner;

use App\Models\Code;

class CodeFilter
{
    public function apply($builder, $value)
    {
        $code = Code::firstWhere('code', $value);

        return $builder->where('code_id', optional($code)->id);
    }
}
