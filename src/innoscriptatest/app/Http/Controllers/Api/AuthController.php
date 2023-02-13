<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Contracts\IAuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $authRepository;

    public function __construct(IAuthRepository $authRepository)
    {
        $this->authRepository = $authRepository; 
    }

    public function createUser(CreateUserRequest $request)
    {
        try {
            return  $this->authRepository->createUser($request);
        } catch (\Throwable $th) {
            return ApiResponseHandler::exception($th->getMessage(), true);
        }
    }

    public function loginUser(LoginUserRequest $request)
    {
        try {
           return  $this->authRepository->loginUser($request);

        } catch (\Throwable $th) {
            return ApiResponseHandler::exception($th->getMessage(), true);
        }
    }
}