<?php

namespace App\Services\Competition\Validator;

use App\Models\Code;
use App\Services\Competition\Validator\Steps\AlreadyWin;
use App\Services\Competition\Validator\Steps\IsValid;

class CodeValidator
{
    public function validate(Code $code, $params)
    {
        $isValid = resolve(IsValid::class);

        $alreadyWin = resolve(AlreadyWin::class);

        $isValid->setNextValidator($alreadyWin);

        return $isValid->validate($code, $params);
    }


}
