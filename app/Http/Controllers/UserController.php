<?php

namespace App\Http\Controllers;

use App\Events\NewTrade;
use App\Events\NewUserRegistered;
use App\Models\User;
use App\Services\DiscountService;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PercentageDiscountCalculator;

class UserController extends Controller
{
    public $userService;
    public function __construct(UserServices   $ervice)
    {
        $this->userService = $ervice;
    }


    public function index()
    {
        $this->userService->getUserData();
    }

    public function show(DiscountService $discountService)
    {
        $user = User::find(1);
        // $percentageDiscountService = new DiscountService(new \App\Contracts\FixedAmountDiscountCalculator());
        $percentageDiscount = $discountService->applyDiscount($user);


        return response()->json( [ "discount"=>$percentageDiscount,]
    
    );
    }

    public function count()
    {
        $count = User::count();
        return response()->json(['count' => $count]);
    }
        public function register(Request $request)
    {
        // return "test";
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // broadcast()
        // Broadcast the event
        broadcast(new NewUserRegistered($user->id)); 
        event(new NewUserRegistered($user->id));
        // event(new NewTrade('man lets go '));
        // You can return a response, generate a token or redirect, depending on your setup
        return response()->json(['message' => 'User registered successfully!', 'user' => $user], 201);
    }
}