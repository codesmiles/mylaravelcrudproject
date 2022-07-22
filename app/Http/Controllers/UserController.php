<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserModel;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use illuminate\Support\Facades\Hash;


// php artisan make:controller UserController --api => creates a controller with basic crud purposes which can be used for api routes
// php artisan make:controller UserController --resource => creates a controller with basic crud purposes which can be used for web routes
// php artisan make:controller UserController --resource --model=UserModel => creates a controller with basic crud purposes which can be used for web routes and also creates a model with the same name as the controller
// php artisan make:controller UserController --resource --model=UserModel -- --table=user_models => creates a controller with basic crud purposes which can be used for web routes and also creates a model with the same name as the controller and also creates a table with the same name as the model
// php artisan make:controller UserController --resource --model=UserModel -- --table=user_models -- --foreign => creates a controller with basic crud purposes which can be used for web routes and also creates a model with the same name as the controller and also creates a table with the same name as the model and also creates a foreign key
// php artisan make:controller UserController --resource --model=UserModel -- --table=user_models -- --foreign -- --pivot => creates a controller with basic crud purposes which can be used for web routes and also creates a model with the same name as the controller and also creates a table with the same name as the model and also creates a foreign key and also creates a pivot table


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return response()->json(['message' => 'Welcome to our API']);
    }

    public function index()
    {
        return UserModel::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function userAdminRegister(Request $request)
    {
        // REGISTRATION CONTROLLER
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        // generate a token for the user
        $token = $user->createToken('authToken')->plainTextToken;

        $response =[
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

        // ALTERNATIVELY
        // return response()->json([
        //     'message' => 'User created successfully',
        //     'user' => $user,
        //     'token' => $token
        // ], 201);
    }

    public function store(Request $request)
    {
         $user = new UserModel();
         $user->name = $request->name;
         $user->username = $request->username;
         $user->email = $request->email;
         $user->phone = $request->phone;
         $user->age = $request->age;
         $user->description = $request->description;
         $user->password = $request->password;
         $user->save();

        //  ALSO CAN BE WRITTEN AS FOLLOWING:
            // $user = UserModel::create($request->all() || the fillable vaues in the model as an associative array);

         return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // search for one user by id
        return UserModel::find($id);
    }
    // SIMILAR TO SHOW
    public function search($name)
    { //search a user by name
        return UserModel::where('name', 'like', '%' . $name)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = UserModel::find($id);
        $user->update($request->all());

        // OR
        // $user = UserModel::find($id);
        // $user->name = $request->name;
        // $user->username = $request->username;
        // $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->age = $request->age;
        // $user->description = $request->description;
        // $user->password = $request->password;
        // $user->save();
        // return $user;
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        // OR
        // return UserModel::destroy($id);
    }


    public function userAdminlogin(Request $request)
    {
        // REGISTRATION CONTROLLER
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        // check email
        $user = User::where('email', $fields['email'])->first();
        // check password
        if(!$user ||  !Hash::check($fields['password'],$user->password) ){
            return response([
                'message'=>"Bad email or password",
            ],401);
        }
        // generate a token for the user
        $token = $user->createToken('authToken')->plainTextToken;
        $response =[
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
