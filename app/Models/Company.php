<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OpenApi\Annotations\Schema;

/**
 * @Schema(title="Company", type="object")
 */
class Company extends Model
{
	use HasFactory;

	protected $guarded = ['id'];

	public function users()
	{
		return $this->belongsToMany(User::class);
	}
}