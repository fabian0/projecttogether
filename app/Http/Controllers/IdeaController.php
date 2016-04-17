<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Idea;
use App\Skill;
use App\User;
use DB;

class IdeaController extends Controller
{
    public function getAll(){
        $ideas  = Idea::all();
        return response()->json($ideas);
    }

    public function getLatest($location){
        $ideas = Idea::where('location', $location)->orderBy('id', 'desc')->take(20)->get();
        return response()->json($ideas);
    }

    public function getIdeaById($id){
        $idea  = Idea::findOrFail($id);
        return response()->json($idea);
    }

    public function getIdeasByCategory($id, $location){
        $ideas = Idea::where('location', $location)->where('category', $id)->orderBy('id', 'desc')->take(20)->get();
        return response()->json($ideas);
    }

    public function getIdeasByUserSkills($id, $location){
        $ideas = collect([]);
        $user  = User::findOrFail($id);
        $usrskills = $user->skills();

        $ideas_all = Idea::where('location', $location);
        foreach($ideas_all as $idea) {
            $reqskills = $idea->requiredskills();
            foreach($reqskills as $skill) {
                foreach($usrskills as $usrskill){
                    if($usrskill == $skill){
                        $ideas->push($idea);
                    }
                }
            }
        }

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
