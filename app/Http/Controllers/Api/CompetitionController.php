<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AlreadyWinException;
use App\Exceptions\CodeException;
use App\Exceptions\CodeHasFinishedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use App\Models\Code;
use App\Services\Competition\Validator\CodeValidator;
use App\Services\Competition\WinnerDefiner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetitionController extends BaseController
{
    public function store(CompetitionRequest $request)
    {
        try {

            resolve(WinnerDefiner::class)->handle($request->code, $request->mobile);

            return $this->respondSuccess(__('messages.you won a gift'));

        }catch(CodeException $e){

            return $this->respondClientError($e->getMessage());
        }
    }

    public function harchi(CompetitionRequest $request)
    {
        $mobile = $request->mobile;

        $code = $request->code;

        DB::beginTransaction();

        try{

            $code = $this->findAndLockCode($code);

            sleep(10);

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
        return resolve(CodeValidator::class)->validate($code, [
            'mobile' => $mobile
        ]);
    }

}
