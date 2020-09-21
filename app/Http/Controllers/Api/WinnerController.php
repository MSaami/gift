<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use App\Http\Resources\WinnerCollection;
use App\Models\Code;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends BaseController
{
    public function index(Request $request, $code)
    {
        $perPage = $request->per_page ?? $this->perPage;

        $winners = Winner::where('code_id', $code)->with('code')->orderByDate()->paginate($perPage);

        return $this->respond(new WinnerCollection($winners));
    }

    public function hasWon(CompetitionRequest $request)
    {
        $code = Code::firstWhere('code', $request->code);

        return $this->respond(['data' => $code->alreadyWinBy($request->mobile)]);
    }
}
