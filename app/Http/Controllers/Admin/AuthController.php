<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.index', [
            'title' => 'Login',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->except(['_token']);

        $attempt = Auth::attempt($credentials);
        
        if($attempt){
            return redirect()->route('admin.dashboard.index');
        }else{
            return back();
        }

      /*   $message = $attempt ? 'Ugurlu' : 'Ugursuz';
        $status = $attempt ? 200 : 400;

        return response()->json([
            'message' => $message,
        ], $status); */
    }
}
