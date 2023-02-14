<?php

namespace App\Http\Controllers\V1;

use App\Filters\V1\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\V1\User\UserCollection;
use App\Http\Resources\V1\User\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    use HttpResponses;

    public function index(Request $request)
    {
        $filter = new UserFilter();
        $filterItems = $filter->transform($request);

        $users = User::where($filterItems);

        // Uncomment below to eagerload relationships

        // $includeRelations = $request->query('includeRelations');

        // if(isset($includeRelations)) return $users = $users->with(['courses', 'subscriptions']);

        return new UserCollection($users->paginate()->appends($request->query()));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // Uncomment below to eagerload relationships

        // $includeRelations = $request->query('includeRelations');

        // if(isset($includeRelations)) return new UserResource($users->loadMissing(['courses', 'subscriptions']));

        return new UserResource($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

       new UserResource($request->validated($request->all()));

       $user = User::create($request->all());

       return $this->success([
        "user" => $user,
        "message" => "user created successfully",
        "token" => $user->createToken('create user token for:'. $user->username)->plainTextToken,
       ]);
    }

    public function login(LoginUserRequest $request)
    {
        if(!Auth::attempt($request->only(['email', 'password']))) {
            return $this->failed([], 'Invalid credentials', 401);
        }

        $user = User::where(`email`, $request->email)->first();
        return $this->success($user, 'user logged in Successfully!', 201);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $request['password'] = bcrypt($request['password']);
        return $user->update($request->all());
    }
}
