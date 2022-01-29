<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Http\ResponseFactory;
use OpenApi\Annotations\MediaType;
use OpenApi\Annotations\Patch;
use OpenApi\Annotations\Post;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\RequestBody;
use OpenApi\Annotations\Schema;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
	/**
	 * @Post(
	 * path="/api/v1/user/sign-in",
	 * tags={"authentication"},
	 * summary="signIn method",
	 *     @RequestBody(
	 *         @MediaType(
	 *             mediaType="application/json",
	 *             @Schema(
	 *                 required={"email", "password"},
	 *                 @Property(property="email",type="string",description="User Email"),
	 *                 @Property(property="password",type="string",description="User Password")
	 *             )
	 *         )
	 *     ),
	 *      @\OpenApi\Annotations\Response(
	 *         response="202",
	 *         description="Normal Operational Response",
	 *          @OA\JsonContent(
	 *               @OA\Property(property="id", type="integer", example="1"),
	 *               @OA\Property(property="first_name", type="string", example="First Name of user"),
	 *               @OA\Property(property="last_name", type="string", example="Last Name of user"),
	 *               @OA\Property(property="email", type="string", example="First Email of user"),
	 *               @OA\Property(property="phone", type="string", example="Phone of user"),
	 *               @OA\Property(property="token", type="string", example="Token of user")
	 *          )
	 *     )
	 * )
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response|ResponseFactory|JsonResponse
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

	/**
	 * @Post(
	 * path="/api/v1/user/register",
	 * tags={"authentication"},
	 * summary="register method",
	 *     @RequestBody(
	 *         @MediaType(
	 *             mediaType="application/json",
	 *             @Schema(
	 *                 required={"first_name", "last_name", "email", "phone", "password"},
	 *                 @Property(property="first_name",type="string",description="User First Name"),
	 *                 @Property(property="last_name",type="string",description="User Last Name"),
	 *                 @Property(property="phone",type="string",description="User Phone"),
	 *                 @Property(property="email",type="string",description="User Email"),
	 *                 @Property(property="password",type="string",description="User Password")
	 *             )
	 *         )
	 *     ),
	 *      @\OpenApi\Annotations\Response(
	 *         response="202",
	 *         description="Normal Operational Response",
	 *          @OA\JsonContent(
	 *               @OA\Property(property="id", type="integer", example="1"),
	 *               @OA\Property(property="first_name", type="string", example="First Name of user"),
	 *               @OA\Property(property="last_name", type="string", example="Last Name of user"),
	 *               @OA\Property(property="email", type="string", example="First Email of user"),
	 *               @OA\Property(property="phone", type="string", example="Phone of user"),
	 *               @OA\Property(property="token", type="string", example="Token of user")
	 *          )
	 *     )
	 * )
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse
	 * @throws ValidationException
	 */
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

	/**
	 * @Patch(
	 * path="/api/v1/user/recover-password",
	 * tags={"authentication"},
	 * summary="register method",
	 *     @RequestBody(
	 *         @MediaType(
	 *             mediaType="application/json",
	 *             @Schema(
	 *                 required={"first_name", "last_name", "email", "phone", "password"},
	 *                 @Property(property="first_name",type="string",description="User First Name"),
	 *                 @Property(property="last_name",type="string",description="User Last Name"),
	 *                 @Property(property="phone",type="string",description="User Phone"),
	 *                 @Property(property="email",type="string",description="User Email"),
	 *                 @Property(property="password",type="string",description="User Password")
	 *             )
	 *         )
	 *     ),
	 *      @\OpenApi\Annotations\Response(
	 *         response="202",
	 *         description="Normal Operational Response",
	 *          @OA\JsonContent(
	 *               @OA\Property(property="id", type="integer", example="1"),
	 *               @OA\Property(property="first_name", type="string", example="First Name of user"),
	 *               @OA\Property(property="last_name", type="string", example="Last Name of user"),
	 *               @OA\Property(property="email", type="string", example="First Email of user"),
	 *               @OA\Property(property="phone", type="string", example="Phone of user"),
	 *               @OA\Property(property="token", type="string", example="Token of user")
	 *          )
	 *     )
	 * )
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response|ResponseFactory|JsonResponse
	 * @throws ValidationException
	 */
	public function recoveryPassword(Request $request): \Illuminate\Http\Response|JsonResponse|ResponseFactory
	{
		$this->validate($request, [
			'email' => 'required',
		]);

		$user = User::where('email', $request->input('email'))->first();

		if ($user) {
			$user->update(['password' => Hash::make(Str::random(6))]);
			return response()->json(['status' => 'success'], Response::HTTP_ACCEPTED);
		}

		return response(['error' => "Failed"], Response::HTTP_UNAUTHORIZED);
	}
}