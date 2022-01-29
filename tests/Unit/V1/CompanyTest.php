<?php

namespace Unit\V1;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use TestCase;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CompanyTest extends TestCase
{
	use DatabaseTransactions;

	public function testCreateCompany()
	{
		$user = User::factory()->createOne([
			'token' => base64_encode(Str::random(40))
		]);

		$company = [
			"title" => "Test Company",
			"phone" => "000000000000",
			"description" => "Ipsam et deleniti vitae velit maiores. Soluta eos vero nulla nobis quisquam molestiae maxime iste. Et culpa modi numquam dolor et eius ullam. Est atque voluptas qui dicta nihil aut.",
		];

		$response = $this->post('api/v1/user/companies', $company, ['Authorization' => 'Bearer ' . $user->token]);

		$response
			->assertResponseStatus(Response::HTTP_CREATED);

		$this->seeInDatabase('companies', $company);
	}
}