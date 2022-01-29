<?php

namespace Unit\V1;

use App\Models\User;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use TestCase;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
	use DatabaseTransactions;

	public function testGetCompanies()
	{
		$user = User::factory()->createOne([
			'token' => base64_encode(Str::random(40))
		]);

		$response = $this->get('api/v1/user/companies', ['Authorization' => 'Bearer ' . $user->token]);

		$response->assertResponseStatus(Response::HTTP_OK);
	}
}