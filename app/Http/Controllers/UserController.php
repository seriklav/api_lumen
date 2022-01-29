<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function companies()
	{
		$companies = Auth::user()->companies->toArray();
		return response($companies, Response::HTTP_OK);
	}
}