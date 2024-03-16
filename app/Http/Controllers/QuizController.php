<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Quiz;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Facades\Redirect;

class QuizController extends Controller
{


    public function getSuitableQuiz1(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'chapter_name' => 'required',
                'type' => ['required','string', 'in:QCM,Cas Cliniques,all'],
                'source' => ['required','string', "in:Toutes ces questions là sont des questions tombables et prennent comme source les sujets d'externat,Reponse unique,Residanat de la faculté Médecine en Algerie,all"],
                'subject_name' => 'required',
                'year' => 'required'
            ]);

            $year = Year::where('id', $validatedData['year'])->first();
            $subject = Subject::findOrFail($validatedData['subject_name']);
            $chapter = null;

            $questionType = null;
            $questionSource = null;

            $questionsQuery = Question::query();

            if ($validatedData['chapter_name'] != 'all') {
                $chapter = Chapter::findOrFail($validatedData['chapter_name']);
                $questionsQuery->where('chapter_id', $chapter->id);
                $chapters="";
            } else {
                $chapters = Chapter::where('subject_id', $subject->id)->get();

                $chapterIds = $chapters->pluck('id');

                $questionsQuery->whereIn('chapter_id', $chapterIds);
            }

            if ($validatedData['type'] != 'all') {
                $questionsQuery->where('type', $validatedData['type']);
            } else {
                $questionType = "mcq and cas clinques";
            }

            if ($validatedData['source'] != 'all') {
                $questionsQuery->where('source', $validatedData['source']);
            } else {
                $questionSource = "all";
            }

            $questions = $questionsQuery->with('answers')->get();

            if ($questions->isEmpty()) {
                return redirect()->back()->with('error', 'No questions exist for the selected criteria.');
            }

            return view('quizzes.quiz1', compact('subject', 'year', 'chapter','chapters', 'questions','questionType','questionSource'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Not accepted enter validate data');
        }
    }



}
