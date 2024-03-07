<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();
            $data = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if (Auth::attempt($data)) {
                $user = Auth::user();

                if (!$user->email_verified_at) {
                    $message = 'Please verify your email first';
                    return response()->json([
                        'message' => $message,
                        'email' => $user->email
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                }

                if (!$request->keepSignedIn) {
                    Passport::personalAccessTokensExpireIn(Carbon::now()->addDay(1));
                }

                $token = $user->createToken('Laravel Personal Grant Client')->accessToken;

                return response()->json([
                    'token' => $token,
                    'user' => $user,
                    'role' => $user->user_type
                ], JsonResponse::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Credentials did not match',
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function logout(Request $request)
    {


        $user = Auth::guard("api")->user()->token();
        $user->revoke();
        $responseMessage = "successfully logged out";

        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);

    }
}
