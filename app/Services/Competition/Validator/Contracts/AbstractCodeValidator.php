<?php

namespace App\Services\Competition\Validator\Contracts;

use App\Models\Code;

abstract class AbstractCodeValidator implements CodeValidatorInterface
{
    private $nextValidator ;

    public function setNextValidator(CodeValidatorInterface $validator)
    {
        $this->nextValidator = $validator ;
    }


    public function validate(Code $code, array $params)
    {
        if ($this->nextValidator === null ) {

            return true;
        }

        return $this->nextValidator->validate($code, $params);

    }
}
