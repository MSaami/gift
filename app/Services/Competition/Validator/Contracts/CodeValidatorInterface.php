<?php

namespace App\Services\Competition\Validator\Contracts;

use App\Models\Code;

interface CodeValidatorInterface
{
    public function setNextValidator(CodeValidatorInterface $validator);
    public function validate(Code $code, array $params);
}
