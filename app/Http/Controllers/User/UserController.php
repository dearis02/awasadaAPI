<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return (new UserCollection(User::paginate(5)))
            ->response()
            ->setStatusCode(200);
    }
}
