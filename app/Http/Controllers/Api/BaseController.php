<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    protected $statusCode = 200;
    protected $perPage = 10;


    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondInternalError($message = null)
    {
        return $this->setStatusCode('500')->respondWithError($message ?? __('messages.internal error'));
    }

    public function respond($data)
    {
        return response()->json($data, $this->getStatusCode());
    }

    public function respondCreated($message = null)
    {
        return $this->setStatusCode(201)->respond([
            'message' => $message ?? __('messages.created successfully')
        ]);
    }

    public function respondSuccess($message = null)
    {
        return $this->setStatusCode(200)->respond([
            'message' => $message ?? __('messages.operation was successfull')
        ]);
    }

    public function respondClientError($message = null)
    {
        return $this->setStatusCode('400')->respondWithError($message ?? __('messages.bad request'));
    }

    private function respondWithError($message)
    {
        return $this->respond([
            'errors' => [
                'message'     => $message,
                'status_code' => $this->getStatusCode(),
            ],
        ]);
    }
}
