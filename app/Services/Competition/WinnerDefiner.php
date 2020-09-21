<?php

namespace App\Services\Competition;

use App\Exceptions\AlreadyWinException;
use App\Exceptions\CodeHasFinishedException;
use App\Models\Code;
use App\Models\Winner;
use App\Services\Competition\Validator\CodeValidator;
use Illuminate\Support\Facades\DB;

class WinnerDefiner
{
    private $codeValidator;

    public function __construct(CodeValidator $codeValidator)
    {
        $this->codeValidator = $codeValidator;
    }

    public function handle($code, string $mobile)
    {
        DB::beginTransaction();

        try{

            $code = $this->findAndLockCode($code);

            $this->validateCode($code, $mobile);

            $this->createWinnerFor($code, $mobile);

            $code->decrement('remaining');

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }

    private function findAndLockCode($code)
    {
        return Code::Where('code', $code)->lockForUpdate()->first();
    }

    private function createWinnerFor($code, $winnerMobile)
    {
        return $code->winners()
            ->create(['mobile'=> $winnerMobile]);
    }

    private function validateCode($code, $mobile)
    {
        return $this->codeValidator->validate($code, [
            'mobile' => $mobile
        ]);
    }

}
