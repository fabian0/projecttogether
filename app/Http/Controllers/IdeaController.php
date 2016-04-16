<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Idea;
use App\Skill;

class IdeaController extends Controller
{
    public function getAll(){
        $ideas  = Idea::all();
        return response()->json($ideas);
    }

    public function getLatest(){
        $ideas = Idea::orderBy('id', 'desc')->take(20)->get();
        return response()->json($ideas);
    }

    public function getIdeaById($id){
        $idea  = User::findOrFail($id);
        return response()->json($idea);
    }

    public function getIdeaByCategory($id){
        $ideas = Idea::where('category', $id)->orderBy('id', 'desc')->take(20)->get();
        return response()->json($ideas);
    }

    public function createIdea(Request $request){
        $idea = Idea::create($request->all());
        return response()->json($idea);
    }

    public function addSkillToIdea($id, Request $request){
        $idea  = Idea::findOrFail($id);

        $skills = $request->all();

        //$skills = $request->all();

        foreach($skills as $s) {
            $skill = Skill::where('text', $s['text'])->first();
            if($skill == null) {
                $skill = Skill::create($s);
            }
            $idea->requiredskills()->attach($skill->id);
        }

        return response()->json($skills);

    }
}
