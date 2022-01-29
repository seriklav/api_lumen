<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Http\ResponseFactory;
use OpenApi\Annotations\MediaType;
use OpenApi\Annotations\Post;
use OpenApi\Annotations\RequestBody;
use OpenApi\Annotations\Schema;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * @Post(
	 * path="/api/v1/user/companies",
	 * tags={"companies"},
	 * summary="created company method",
	 *     @RequestBody(
	 *         @MediaType(
	 *              mediaType="application/json",
	 *              @Schema (
	 *                  required={"title", "phone", "description"},
	 *                  @OA\Property (property="title", type="string", description="Company title"),
	 *                  @OA\Property (property="phone", type="string", description="Company phone"),
	 *                  @OA\Property (property="description", type="string", description="Company description")
	 *              )
	 *         )
	 *     ),
	 *      @\OpenApi\Annotations\Response(
	 *         response="201",
	 *         description="Normal Operational Response",
	 *          @OA\JsonContent(
	 *               @OA\Property(property="id", type="integer", example="1"),
	 *               @OA\Property(property="title", type="string", example="Name of company"),
	 *               @OA\Property(property="phone", type="string", example="Phone of company"),
	 *               @OA\Property(property="description", type="string", example="Description of company")
	 *          )
	 *     )
	 * )
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response|ResponseFactory
	 * @throws ValidationException
	 */
	public function store(Request $request): \Illuminate\Http\Response|ResponseFactory
	{
		$this->validate($request, [
			'title' => 'required',
			'phone' => 'required|unique:companies,phone',
			'description' => 'required',
		]);

		$company = Company::create($request->all());
		Auth::user()->companies()->attach($company->pluck('id')->toArray());

		return response($company->toArray(), Response::HTTP_CREATED);
	}
}