<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            if (method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                $user = Auth::user();
                $user->setApiToken($user->generateUnToken());
                return response()->json(['token' => $user->getApiToken()], 200, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
            } else {
                return response()->json(['message' => 'not valid login or password'], 200, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
            }
        } else {
            return response()->json($validator->errors(), 200, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
        }
    }

    public function logout(Request $request)
    {
        $rules = [
            'token' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $user = User::getUserFromToken($request->get('token'));
            if ($user) {
                $user->setApiToken();
                return response()->json(['ok' => 1],200, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
            } else {
                return response()->json(['ok' => 0],200, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
            }


        } else {
            return response()->json($validator->errors()->all());
        }
    }

    public function role()
    {
        return response()->json('User|' . User::ROLES[User::ROLE_1] . '|' . User::ROLES[User::ROLE_1],200, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
    }

    public function method1()
    {
        return response()->json(['data' => 'protected'],200, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
    }

    public function method2()
    {
        return response()->json(['data' => 'protected'],200, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
    }

}
