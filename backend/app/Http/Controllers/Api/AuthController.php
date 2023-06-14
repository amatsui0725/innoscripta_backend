<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // --------------------------------------------------------------------------
    /**
     * Fetch Users
     * @access private
     * @method GET
     */
    public function index()
    {
        return response()->json(User::latest()->get());
    }
    
    // --------------------------------------------------------------------------
    /**
     * User Registeration
     * @access public
     * @method POST
     * @param [name, email, password, password_conformation]
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status' => 200,
            'user' => $user,
            'token' => $user->createToken('userToken')->plainTextToken
        ]);
    }

    // --------------------------------------------------------------------------
    /**
     * User Login
     * @access public
     * @method POST
     * @param [email, password]
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => 'The provided credentials are incorrect!'
            ]);
        }

        $user = User::where('email', $request->email)->first();
        return response()->json([
            'status' => 200,
            'user' => $user,
            'token' => $user->createToken('userToken')->plainTextToken
        ]);
    }

    // --------------------------------------------------------------------------
    /**
     * User Logout
     * @access private
     * @method POST
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Logout successful'
        ]);
    }
    // --------------------------------------------------------------------------
}
