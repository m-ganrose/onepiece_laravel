<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB; // Import DB facade

class UserController extends Controller
{
    public function signup(Request $request)
    {
        // Enable query logging
        DB::connection()->enableQueryLog();

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']); // Hash the password before saving
        $user->save();

        // Get the executed queries
        $queries = DB::getQueryLog();

        // Log the executed queries
        \Log::info('Executed Queries: ' . json_encode($queries));

        // Optionally, you can authenticate the user after signup
        // auth()->login($user);

        // Redirect the user to a specific page after signup
        return redirect()->route('/index')->with('success', 'Signup successful!'); // Assuming 'home' is your home page route
    }
}
