<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store(Request $request)
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