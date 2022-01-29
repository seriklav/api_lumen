<?php

namespace App\Http\Controllers\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
	/**
	 * @throws ValidationException
	 */
	public function signIn(Request $request)
	{
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required'
		]);

		$user = User::where('email', $request->input('email'))->first();

		if(Hash::check($request->input('password'), $user->password)){
			return response()->json(['status' => 'success','token' => $user->token], Response::HTTP_ACCEPTED);
		}

		return response(['error' => "Auth Failed"], Response::HTTP_UNAUTHORIZED);
	}

	public function register(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required',
			'last_name' => 'required',
			'phone' => 'required|unique:users,phone',
			'email' => 'required|email|unique:users,phone',
			'password' => 'required'
		]);

		$token = base64_encode(Str::random(40));

		User::create(
			$request->except('password') +
			[
				'password' => Hash::make($request->input('password')),
				'token' => $token,
			]
		);

		return response()->json(['status' => 'success','token' => $token], Response::HTTP_CREATED);
	}

	public function recoveryPassword(Request $request)
	{
		$this->validate($request, [
			'email' => 'required',
		]);

		$user = User::where('email', $request->input('email'))->first();

		if ($user) {
			$user->update(['password' => Hash::make(Str::random(6))]);
			// Todo: send to email $user->email new password
			return response()->json(['status' => 'success'], Response::HTTP_ACCEPTED);
		}

		return response(['error' => "Failed"], Response::HTTP_UNAUTHORIZED);
	}
}