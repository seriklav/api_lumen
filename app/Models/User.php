<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use OpenApi\Annotations\Schema;

/**
 * @Schema(title="User", type="object")
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
	use Authenticatable, Authorizable, HasFactory;

	protected $guarded = ['id'];
	protected $hidden = ['password'];

	public function companies()
	{
		return $this->belongsToMany(Company::class);
	}
}
