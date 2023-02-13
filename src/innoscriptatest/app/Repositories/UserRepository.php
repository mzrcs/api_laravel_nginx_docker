<?php 
namespace App\Repositories;

use App\Helpers\ApiResponseHandler;
use App\Helpers\Language;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Contracts\IUserRepository;
use App\Models\RequestResponseLogs;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository {

    public function getLoggedUser(): JsonResponse
    {
        $response = ApiResponseHandler::success(
            new UserResource(auth()->user()), 
            ''
        );
        RequestResponseLogs::logCustomRequest(200, 'get api success response', $response);
        return $response;
    }

    public function updateLoggedUser(UpdateUserRequest $request): JsonResponse
    {
       $user = User::whereId(auth()->user()->id)->first();
       
       $user->update([
            'preferred_news_feeds' => serialize($request->preferred_news_feeds),
            'password' => Hash::make($request->password),
        ]);

        $response = ApiResponseHandler::success(
            [
                'user' => new UserResource($user)
            ], 
            ''
        );
        RequestResponseLogs::logCustomRequest(200, 'get api success response', $response);
        return $response;
    }
}