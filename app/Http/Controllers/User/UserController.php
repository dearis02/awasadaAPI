<?php

namespace App\Http\Controllers\User;

use App\Helpers\API;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserPostRequest;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return (new UserCollection(User::paginate(5)))
            ->response()
            ->setStatusCode(200);
    }

    public function detail(User $user)
    {
        if (!$user->exists) {
            return response()->json([
                'status' => 422,
                'success' => false,
                'message' => 'Id required'
            ], 422);
        }

        $user->whereHas('addresses');

        return (new UserResource($user))
            ->response()
            ->setStatusCode(200);
    }

    public function update(UserPostRequest $req, User $user)
    {
        DB::beginTransaction();

        try {
            $validated = $req->validated();

            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
            ]);

            DB::commit();

            return API::successResponse(200, "Update user success");
        } catch (\Throwable $th) {
            DB::rollBack();

            return API::failResponse(500, "Update user failed");
        }
    }

    public function delete(User $user)
    {
        DB::beginTransaction();

        try {
            $user->delete();

            DB::commit();

            return API::successResponse(200, "Delete user success");
        } catch (\Throwable $th) {
            DB::rollBack();

            return API::failResponse(500, "Delete user failed");
        }
    }
}
