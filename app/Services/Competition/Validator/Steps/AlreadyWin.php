<?php

namespace App\Services\Competition\Validator\Steps;

use App\Exceptions\AlreadyWinException;
use App\Models\Code;
use App\Services\Competition\Validator\Contracts\AbstractCodeValidator;

class AlreadyWin extends AbstractCodeValidator
{
    public function validate(Code $code, array $params)
    {
        if ($code->alreadyWinBy($params['mobile'])){

            throw new AlreadyWinException('The code already win by you');

        };

        return parent::validate($code, $params);
    }
}
