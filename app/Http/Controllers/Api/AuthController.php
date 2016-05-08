<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Firebase\JWT\JWT;
use Hash;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $email    = $request->get('email');
        $password = $request->get('password');
        $user     = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'Email không tồn tại'], 401);
        }
        if (Hash::check($password, $user->password)) {
            unset($user->password);
            return $this->loginSuccess($user);
        } else {
            return response()->json(['message' => 'Sai email hoặc mật khẩu'], 401);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 400);
        }
        $user = User::create([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        return $this->loginSuccess($user);
    }

    public function facebook(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $params = [
            'code'          => $request->input('code'),
            'client_id'     => $request->input('clientId'),
            'redirect_uri'  => $request->input('redirectUri'),
            'client_secret' => config('app.facebook_secret'),
        ];
        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('GET', 'https://graph.facebook.com/v2.5/oauth/access_token', [
            'query' => $params,
        ]);
        $accessToken = json_decode($accessTokenResponse->getBody(), true);
        // Step 2. Retrieve profile information about the current user.
        $fields          = 'id,email,first_name,last_name,link,name';
        $profileResponse = $client->request('GET', 'https://graph.facebook.com/v2.5/me', [
            'query' => [
                'access_token' => $accessToken['access_token'],
                'fields'       => $fields,
            ],
        ]);
        $profile = json_decode($profileResponse->getBody(), true);

        if (empty($profile['email'])) {
            $profile['email'] = $profile['id'] . '@facebook.com';
        }
        // Step 3a. If user is already signed in then link accounts.
        if ($request->header('Authorization')) {
            $user = User::where('facebook', '=', $profile['id']);
            /*if ($user->first()) {
            return response()->json(['message' => 'There is already a Facebook account that belongs to you'], 409);
            }*/
            $token          = explode(' ', $request->header('Authorization'))[1];
            $payload        = (array) JWT::decode($token, config('app.token_secret'), array('HS256'));
            $user           = User::find($payload['sub']);
            $user->facebook = $profile['id'];
            $user->email    = $user->email ?: $profile['email'];
            $user->name     = $user->name ?: $profile['name'];
            $user->save();
            return $this->loginSuccess($user);
        }
        // Step 3b. Create a new user account or return an existing one.
        else {
            $user = User::where('facebook', '=', $profile['id']);
            if ($user->first()) {
                return $this->loginSuccess($user->first());
            }
            $user           = new User;
            $user->facebook = $profile['id'];
            $user->email    = $profile['email'];
            $user->name     = $profile['name'];
            $user->save();
            return $this->loginSuccess($user);
        }
    }

    protected function loginSuccess($user)
    {
        return response()->json([
            'token' => $this->createToken($user),
            'user'  => $user,
        ]);
    }

    protected function createToken($user)
    {
        $payload = [
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (2 * 7 * 24 * 60 * 60),
        ];
        return JWT::encode($payload, config('app.token_secret'));
    }

}
