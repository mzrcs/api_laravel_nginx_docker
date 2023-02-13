<?php 
namespace App\Contracts;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;

interface IUserRepository {

    public function getLoggedUser() : JsonResponse;

    public function updateLoggedUser(UpdateUserRequest $request) : JsonResponse;

}