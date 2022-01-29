<?php

namespace Unit\V1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use TestCase;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
	use DatabaseTransactions;

	public function testRegister()
	{
		$user = [
			'first_name' => 'Joe',
			'last_name' => 'Smith',
			'phone' => '080980183056',
			'email' => '3testemail@test.com',
			'password' => '123321',
		];

		$response = $this->post('api/v1/user/register', $user);

		$response
			->assertResponseStatus(Response::HTTP_CREATED);

		//Remove password from array
		array_splice($user,4, 1);

		$this->seeInDatabase('users', $user);
	}

	public function testSignIn()
	{
		$user = User::factory()->createOne([
			'password' => Hash::make($password = 123321),
		]);

		$response = $this->post('api/v1/user/sign-in', [
			'email' => $user->email,
			'password' => $password,
		]);

		$response
			->assertResponseStatus(Response::HTTP_ACCEPTED);
	}

	public function testRecoveryPassword()
	{
		$user = User::factory()->createOne();

		$response = $this->patch('api/v1/user/recover-password', [
			'email' => $user->email,
		]);

		$response
			->assertResponseStatus(Response::HTTP_ACCEPTED);
	}
}