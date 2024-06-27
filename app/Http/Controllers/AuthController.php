<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Mail\SendWelcomeMail;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource; // استيراد المورد للمستخدم
use App\Http\Requests\UpdateUserRequest;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /*
     * AuthController constructor.
     *
     * This constructor is responsible for applying middleware to the AuthController methods.
     * It applies the 'auth:api' middleware to all methods except 'login' and 'register'.
     * It also applies specific middleware to specific methods based on permissions.
     */
    public function __construct()
    {
        // Apply 'auth:api' middleware to all methods except 'login' and 'register'
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

        // Apply 'permission:view-users' middleware to the 'index' and 'show' methods
        $this->middleware(['permission:view-users'], ['only' => ['index', 'show']]);

        // Apply 'permission:create-user' middleware to the 'register' method
        $this->middleware(['permission:create-user'], ['only' => ['register']]);

        // Apply 'permission:update-user' middleware to the 'update' method
        $this->middleware(['permission:update-user'], ['only' => ['update']]);

        // Apply 'permission:delete-user' middleware to the 'destroy' method
        $this->middleware(['permission:delete-user'], ['only' => ['destroy']]);

        // Apply 'permission:restore-user' middleware to the 'restore' method
        $this->middleware(['permission:restore-user'], ['only' => ['restore']]);

        // Apply 'permission:force-delete-user' middleware to the 'forceDelete' method
        $this->middleware(['permission:force-delete-user'], ['only' => ['forceDelete']]);
    }


    /**
     * Retrieves all users and returns a custom response with a collection of UserResource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::all(); // جلب كافة المستخدمين
            return $this->customeResponse(UserResource::collection($users), "Done", 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "There is something wrong on the server", 500);
        }
    }

    /**
     * Authenticates a user and returns a JSON response with the user's information and an authorization token.
     *
     * @param LoginRequest $request The HTTP request containing the user's email and password.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the user's information and the authorization token.
     */
    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * Registers a new user and returns a JSON response with the user's information and an authorization token.
     *
     * @param UserRequest $request The HTTP request containing the user's information.
     * @throws \Throwable If an error occurs during the registration process.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the user's information and the authorization token.
     */
    public function register(UserRequest $request)
    {

        try {
            $user = User::create([
                'pharma_name' => $request->pharma_name,
                'pharmacist_name' => $request->pharmacist_name,
                'password' => bcrypt($request->password), // تشفير كلمة المرور
                'email' => $request->email,
                'license_date' => $request->license_date,
                'license_number' => $request->license_number,
                'phone' => $request->phone,
                'address' => $request->address,
                'pharmacist_gender' => $request->pharmacist_gender,
                'is_band' => $request->is_band,
                'role_name' => 'client'
            ]);
            $user->assignRole('client');

            $token = Auth::login($user);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

            // $email = $request->email;
            // $password = $request->password;

            // Mail::to($email)->send(new SendWelcomeMail($email, $password,));
        } catch (\Throwable $th) {
            Log::error($th);
            return $this-> $th;
            return $this->customeResponse(null, "There is something wrong on the server", 500);
        }
    }

    /**
     * Logs out the authenticated user.
     *
     * This function logs out the currently authenticated user by calling the `logout` method
     * on the `Auth` facade. It then returns a JSON response with a success status and a
     * message indicating that the user has been successfully logged out.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response indicating the logout status.
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * Refreshes the authentication token and returns a JSON response with the user's information and a new token.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the user's information and a new token.
     */
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            return $this->customeResponse(new UserResource($user), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "There is something wrong on the server", 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update([
                'pharma_name' => $request->input('pharma_name') ?? $user->pharma_name,
                'pharmacist_name' => $request->input('pharmacist_name') ?? $user->pharmacist_name,
                'password' => bcrypt($request->input('password')) ?? $user->password, //  'password' => $request->filled('password') ? bcrypt($request->password) : $user->password, // تشفير كلمة المرور
                'email' => $request->input('email') ?? $user->email,
                'license_date' => $request->input('license_date') ?? $user->license_date,
                'license_number' => $request->input('license_number') ?? $user->license_number,
                'phone' => $request->input('phone') ?? $user->phone,
                'address' => $request->input('address') ?? $user->address,
                'pharmacist_gender' => $request->input('pharmacist_gender') ?? $user->pharmacist_gender,
                'is_band' => $request->input('is_band') ?? $user->is_band,
            ]);
            return $this->customeResponse(new UserResource($user), 'User updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "There is something wrong on the server", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            // Update the is_band value to true
            $user->update(['is_band' => true]);
            return $this->customeResponse("", 'User deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "There is something wrong on the server", 500);
        }
    }
    /**
     * Restore the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreUser(string $id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);
            if (!$user->trashed()) {
                return $this->customeResponse(null, 'User is not deleted. No need to restore.', 404);
            }

            $user->restore();
            // Update the is_band value to false
            $user->update(['is_band' => false]);
            return $this->customeResponse(new UserResource($user), 'User restored successfully', 200);
        } catch (\Throwable $th) {
            Log::error("Error restoring user: " . $th->getMessage());
            return $this->$th;
            return $this->customeResponse(null, "There is something wrong on the server", 500);
        }
    }

    /**
     * Force delete the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function forceDeleteUser(Request $request, $id)
    {
        try {
            $user = User::withTrashed()->find($id);

            if (!$user) {
                return $this->customeResponse(null, 'User not found', 404);
            }

            if (!$user->trashed()) {
                return $this->customeResponse(null, 'User is not soft deleted. Use delete first.', 400);
            }

            $user->forceDelete();

            return $this->customeResponse("", 'User force deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "There is something wrong on the server", 500);
        }
    }
}
