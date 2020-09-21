<?php

namespace App\Services\Competition\Validator\Steps;

use App\Exceptions\CodeNotValidException;
use App\Models\Code;
use App\Services\Competition\Validator\Contracts\AbstractCodeValidator;

class IsValid extends AbstractCodeValidator
{
    public function validate(Code $code, array $params)
    {
        if ($code->isValid()){
            return parent::validate($code, $params);
        }

        throw new CodeNotValidException('Code Not Valid');

    }
}
