<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Http\ResponseFactory;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Items;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * @OA\SecurityScheme(
	 *     type="http",
	 *     description="Use a token for auth request",
	 *     name="Authorization",
	 *     in="header",
	 *     scheme="bearer",
	 *     securityScheme="token",
	 * )
	 */
	/**
	 * @Get(
	 * path="/api/v1/user/companies",
	 * tags={"companies"},
	 * summary="get companies method",
	 * security={{"token":{}}},
	 *      @\OpenApi\Annotations\Response(
	 *         response="200",
	 *         description="Normal Operational Response",
	 *          @OA\JsonContent(
	 *               @OA\Property(
	 *                  property="data",
	 *                  type="array",
	 *                  @Items(
	 *                      @OA\Property(property="id", type="integer", example="1"),
	 *                      @OA\Property(property="title", type="string", example="Name of company"),
	 *                      @OA\Property(property="phone", type="string", example="Phone of company"),
	 *                      @OA\Property(property="description", type="string", example="Description of company")
	 *                  )
	 *              )
	 *          )
	 *     )
	 * )
	 *
	 * @return \Illuminate\Http\Response|ResponseFactory
	 */
	public function companies(): \Illuminate\Http\Response|ResponseFactory
	{
		$companies = Auth::user()->companies->toArray();
		return response(["data" => $companies], Response::HTTP_OK);
	}
}