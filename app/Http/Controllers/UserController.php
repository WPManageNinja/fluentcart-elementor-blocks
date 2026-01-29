<?php

namespace FluentCartElementorBlocks\App\Http\Controllers;

use FluentCartElementorBlocks\App\Models\User;

class UserController extends Controller
{
	public function users()
	{
		return User::all();
	}
}