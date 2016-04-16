<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Skill;

class UserController extends Controller
{
    public function loginUser(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user != null) {
            if($user->password == $request->password) {
                return response()->json($user);
            }
        }
        return response()->json(['status' => 'fail', 'message' => 'Login failed']);
    }

    public function getAll(){
        $users  = User::all();
        return response()->json($users);

    }

    public function getUserById($id){
        $user  = User::findOrFail($id);
        return response()->json($user);
    }

    public function getLatest(){
        $users = User::orderBy('id', 'desc')->take(2)->get();
        return response()->json($users);
    }

    public function createUser(Request $request){
        $user = User::create($request->all());
        return response()->json($user);
    }

    public function addSkillToUser($id, Request $request){
        $user  = User::findOrFail($id);

        $skills = $request->all();

        //$skills = $request->all();

        foreach($skills as $s) {
            $skill = Skill::where('text', $s['text'])->first();
            if($skill == null) {
                $skill = Skill::create($s);
            }
            $user->skills()->attach($skill->id);
        }

        return response()->json($skills);

    }

}
