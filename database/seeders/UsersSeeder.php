<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::factory(100)->create();

		// Get all the roles attaching up to 3 random roles to each user
		$companies = Company::all();

		// Populate the pivot table
		User::all()->each(function ($user) use ($companies) {
			$user->companies()->attach(
				$companies->random(rand(1, 3))->pluck('id')->toArray()
			);
		});
	}
}
