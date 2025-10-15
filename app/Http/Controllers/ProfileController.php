<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile/index');
    }

    public function update(Request $request)
    {
        $auth = auth()->user();

        $request->validate([
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email',
                'min:3',
            Rule::unique('users')->ignore($auth->id),
            ],
            // senha opcional; se informada, deve ter pelo menos 6 chars e ser confirmada
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::findOrFail($auth->id);
        $user->name = $request->name;
        $user->email = $request->email;
        
        if (isset($request->password)) $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('success', 'Dados atualizados com sucesso!');
    }
}
