<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AuthController extends Controller
{
    public function register(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $requestData['password'] = Hash::make($requestData['password']);
        $user = User::create($requestData);
        return response([ 'status' => true, 'message' => 'User successfully register.' ], 200);
    }
    public function login(Request $request)
    {
        // return 'soemthing';
        $requestData = $request->all();
        // return response(['user' => $requestData], 200);
        $validator = Validator::make($requestData,[
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        if(! auth()->attempt($requestData)){
            return response()->json(['error' => 'UnAuthorised Access', 'status' => 401], 401);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['success' => true, 'user' => auth()->user(), 'access_token' => $accessToken, 'status' => 200], 200);
    }
    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json(['status' => 'true'], 200);
    }

    public function token(Request $request){
        $token = $request->token;
    }

    public function logout (Request $request)
    {
        
        $token = $request->user()->token();
        // return response(['message' => $token], 200);
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}