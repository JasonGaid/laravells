<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Violation;


class ViolationController extends Controller
{
    public function index()
    {
        $violation = Violation::get();
 
        return view('violation/index', ['violation' => $violation]);
    }
 
    public function add()
    {
        return view('violation.form');
    }
 
    public function save(Request $request)
    {
        $violation = new Violation();
        $violation->negative_comments = $request->negative_comments;
        $violation->intimidating_language = $request->intimidating_language;
        $violation->insults_based_on_personal_characteristics = $request->insults_based_on_personal_characteristics;
        $violation->offensive_language = $request->offensive_language;
        $violation->threats_of_physical_violence = $request->threats_of_physical_violence;
        $violation->public_ridicule = $request->public_ridicule;
        $violation->shaming = $request->shaming;
        $violation->unsolicited_sexual_advances = $request->unsolicited_sexual_advances;
        $violation->inappropriate_comments = $request->inappropriate_comments;
        $violation->direct_threats = $request->direct_threats;
        
        $violation->save();
    
        return redirect()->route('violation');
    }
 
    public function edit($id)
    {
        $violation = violation::find($id);
        return view('violation.form', ['violation' => $violation]);
    }
 
    public function update($id, Request $request)
    {
        $violation = Violation::find($id);
        $violation->update([
            'negative_comments' => $request->negative_comments,
            'intimidating_language' => $request->intimidating_language,
            'insults_based_on_personal_characteristics' => $request->insults_based_on_personal_characteristics,
            'offensive_language' => $request->offensive_language,
            'threats_of_physical_violence' => $request->threats_of_physical_violence,
            'public_ridicule' => $request->public_ridicule,
            'shaming' => $request->shaming,
            'unsolicited_sexual_advances' => $request->unsolicited_sexual_advances,
            'inappropriate_comments' => $request->inappropriate_comments,
            'direct_threats' => $request->direct_threats
        ]);
    
        return redirect()->route('violation');
    }
 
    public function delete($id)
    {
        Violation::destroy($id);
        return redirect()->route('violation.index'); 
    }}
