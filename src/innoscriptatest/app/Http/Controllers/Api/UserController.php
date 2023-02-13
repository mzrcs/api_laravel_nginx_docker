<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHandler;
use App\Http\Controllers\Controller;
use App\Contracts\IUserRepository;
use App\Http\Requests\UpdateUserRequest;
use App\Models\RequestResponseLogs;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository; 
    }

    public function getLoggedInUserData()
    {
        try {
            return  $this->userRepository->getLoggedUser();
        } catch (\Throwable $th) {
            RequestResponseLogs::logCustomRequest(500, $th->getMessage(), []);
            return ApiResponseHandler::exception($th->getMessage(), true);
        }
    }
    
    public function updateLoggedUserData(UpdateUserRequest $request)
    {
        try {
            return  $this->userRepository->updateLoggedUser($request);
        } catch (\Throwable $th) {
            RequestResponseLogs::logCustomRequest(500, $th->getMessage(), []);
            return ApiResponseHandler::exception($th->getMessage(), true);
        }
    }
}
