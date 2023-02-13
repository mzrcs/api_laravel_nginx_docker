<?php 
namespace App\Repositories;

use App\Helpers\ApiResponseHandler;
use App\Helpers\Language;
use App\Models\User;
use App\Contracts\IAuthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements IAuthRepository {

    public function createUser($request) : JsonResponse {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return ApiResponseHandler::success(
            [
                'token' => $user->createToken("API TOKEN of " . $user->name)->plainTextToken
            ], 
            Language::getMessage('messages.login_success')
        );
    }

    public function loginUser($request) : JsonResponse {

        if(!Auth::attempt($request->only(['email', 'password']))){
            return ApiResponseHandler::validationFailureError([Language::getMessage('messages.auth_attempt')]);
        }

        $user = User::where('email', $request->email)->first();

        return ApiResponseHandler::success(
            [
                'token' => $user->createToken("API TOKEN of " . $user->name)->plainTextToken
            ], 
            Language::getMessage('messages.login_success')
        );
    }
}