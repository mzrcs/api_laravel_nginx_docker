<?php 
namespace App\Contracts;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\JsonResponse;

interface IAuthRepository {

    public function createUser(CreateUserRequest $request) : JsonResponse;

    public function loginUser(LoginUserRequest $request) : JsonResponse;

}