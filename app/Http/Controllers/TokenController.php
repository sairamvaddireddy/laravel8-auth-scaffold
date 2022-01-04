<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function index()
    {
        $tokens = auth()->user()->tokens;
        return view('tokens.index', compact(['tokens']));
    }

    public function create()
    {
        return view('tokens.create');
    }

    public function generate(Request $request)
    {
        $token = auth()->user()->createToken($request->token_name);

        return redirect()->route('tokens.index')->with('token', $token->plainTextToken);
    }

    public function revokeAll()
    {
        auth()->user()->tokens()->delete();
        return redirect()->route('tokens.index')->with('success', "All tokens deleted successfully");
    }

    public function destroy($id)
    {
        auth()->user()->tokens()->where('id', $id)->delete();
        return redirect()->route('tokens.index')->with('success', "Token deleted successfully");
    }
}
