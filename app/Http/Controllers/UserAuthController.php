<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

//        return $this->respondWithToken($token);
        return response()->json([
            'status' => 'success',
            'message' => 'user login successfully',
            'data' => [
                'user' => auth()->user(),
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ],
        ]);
    }


    public function register(UserRegisterRequest $request) {

        $validated = $request->validated();

        $newUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
        ]);

        if(! $newUser) {
            return response()->json([
                'status' => 'error',
                'message' => 'user not added',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'user added successfully',
//            'data' => $newUser,
        ], 201);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
//        return response()->json(auth()->user());
        return response()->json([
            'status' => 'success',
            'message' => 'current user information',
            'data' => [
                'user' => auth()->user(),
            ],
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

//        return response()->json(['message' => 'Successfully logged out']);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
//        return $this->respondWithToken(auth()->refresh());
        return response()->json([
            'status' => 'success',
            'message' => 'current user token refresh successfully',
            'data' => [
                'access_token' => auth()->refresh(),
            ],
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
