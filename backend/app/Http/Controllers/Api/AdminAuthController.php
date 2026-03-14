<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Admin access required.',
            ], 403);
        }

        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    public function user(Request $request): JsonResponse
    {
        return response()->json([
            'user' => new UserResource($request->user()),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }

    public function admins(): JsonResponse
    {
        $admins = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => UserResource::collection($admins),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return response()->json([
            'user' => new UserResource($admin),
            'message' => 'Admin created successfully.',
        ], 201);
    }

    public function update(Request $request, User $admin): JsonResponse
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $admin->id,
            'password' => 'sometimes|required|min:8|confirmed',
        ]);

        if ($request->has('name')) {
            $admin->name = $request->name;
        }

        if ($request->has('email')) {
            $admin->email = $request->email;
        }

        if ($request->has('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return response()->json([
            'user' => new UserResource($admin),
            'message' => 'Admin updated successfully.',
        ]);
    }

    public function destroy(User $admin): JsonResponse
    {
        if ($admin->id === auth()->id()) {
            return response()->json([
                'message' => 'Cannot delete your own account.',
            ], 403);
        }

        $admin->delete();

        return response()->json([
            'message' => 'Admin deleted successfully.',
        ]);
    }
}
