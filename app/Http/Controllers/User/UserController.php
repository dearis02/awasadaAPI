<?php

namespace App\Http\Controllers\User;

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

    public function detail($id)
    {
        if (!$id) {
            return response()->json([
                'status' => 422,
                'success' => false,
                'message' => 'Id required'
            ], 422);
        }

        $user = User::whereHas('addresses')->find($id);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(200);
    }

    public function update(UserPostRequest $req)
    {
        DB::beginTransaction();

        try {
            $validated = $req->validated();

            $id = $validated['id'];

            User::where('id', $id)->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => "Update user success",
                'data' => []
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'success' => false,
                'message' => "Update user failed"
            ], 500);
        }
    }

    public function delete(Request $req)
    {
        DB::beginTransaction();

        try {
            $validated = $req->validate([
                'id' => 'required'
            ]);

            $id = $validated['id'];

            User::where('id', $id)->delete();

            DB::commit();

            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => "Delete user success",
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'success' => false,
                'message' => "Delete user failed"
            ], 500);
        }
    }
}
