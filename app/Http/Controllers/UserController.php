<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eloquent query sin ejecutar get() en los closures
        $users = User::when(request()->has('username'), function (Builder $query) {
                $query->where('username', 'like', '%' . request()->input('username') . '%');
            })
            ->when(request()->has('email'), function (Builder $query) {
                $query->where('email', 'like', '%' . request()->input('email') . '%');
            })
            ->paginate(request()->per_page);  // Aquí se ejecuta la consulta y se obtienen los resultados

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Str::random(8);

        $user = User::create( $data);

        return response() -> json(UserResource::make($user));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return UserResource ::make(parameters: $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        return response() -> json(data: UserResource::make(parameters: $user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): void
    {
        //
    }
}
