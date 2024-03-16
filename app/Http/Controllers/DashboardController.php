<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\User;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
        return view('dashboard.index');
    }
    public function addYear()
    {
        $years = Year::all();
        return view('dashboard.year', compact('years'));
    }

    public function storeYear(Request $request)
    {
        $request->validate([
            'year' => 'required|string|unique:years',
        ]);

        Year::create($request->only('year'));

        return redirect()->back()->with('success', 'Year saved successfully.');
    }

    public function updateYear(Request $request, $id)
    {
        $request->validate([
            'year' => ['required', 'string', Rule::unique('years')->ignore($id)],
        ]);

        $year = Year::findOrFail($id);
        $year->update($request->only('year'));

        return redirect()->back()->with('success', 'Year updated successfully.');
    }

    public function deleteYear($id)
    {
        $year = Year::findOrFail($id);
        $year->delete();

        return redirect()->back()->with('success', 'Year deleted successfully.');
    }
    public function yearsDeleteAll()
    {
        try {
            Year::truncate();

            return redirect()->back()->with('success', 'All years have been deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting all years.');
        }
    }

    public function addSubject()
    {
        $subjects = Subject::all();
        $years=Year::all();
        return view('dashboard.subject', compact('subjects','years'));
    }

    public function storeSubject(Request $request)
    {
        $request->validate([
            'year' => 'required|string|exists:years,year',
            'subject_name' => 'required|string|unique:subjects',
        ]);

        $subject = Subject::create([
            'subject_name' => $request->subject_name,
            'year_id' => Year::where('year', $request->year)->value('id'),
        ]);

        return redirect()->back()->with('success', 'Subject saved successfully.');
    }

    public function updateSubject(Request $request, $id)
    {
        $request->validate([
            'subject_name' => ['required', 'string', Rule::unique('subjects')->ignore($id)],
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->back()->with('success', 'Subject updated successfully.');
    }

    public function deleteSubject($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->back()->with('success', 'Subject deleted successfully.');
    }
    public function subjectsDeleteAll()
    {
        try {
            // Add your logic here to delete all questions
            Subject::truncate();

            return redirect()->back()->with('success', 'All subjects have been deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting all subjects.');
        }
    }

    public function addChapter()
    {
        $chapters = Chapter::all();
        return view('dashboard.chapter', compact('chapters'));
    }

    public function storeChapter(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|exists:subjects,subject_name',
            'chapter_name' => 'required|string|unique:chapters',
        ]);

        $subject = Subject::where('subject_name', $request->subject_name)->firstOrFail();
        $subject->chapters()->create([
            'chapter_name' => $request->chapter_name,
        ]);

        return redirect()->back()->with('success', 'Chapter saved successfully.');
    }

    public function updateChapter(Request $request, $id)
    {
        $request->validate([
            'chapter_name' => ['required', 'string', Rule::unique('chapters')->ignore($id)],
        ]);

        $chapter = Chapter::findOrFail($id);
        $chapter->update([
            'chapter_name' => $request->chapter_name,
        ]);

        return redirect()->back()->with('success', 'Chapter updated successfully.');
    }

    public function deleteChapter($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return redirect()->back()->with('success', 'Chapter deleted successfully.');
    }
    public function chaptersDeleteAll()
    {
        try {
            Chapter::truncate();

            return redirect()->back()->with('success', 'All chapters have been deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting all chapters.');
        }
    }



    public function addUser()
    {
        $users = User::all();
        return view('dashboard.userData', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:users',
            'status' => 'required|in:admin,user',
        ]);

        User::create($request->only('code','status'));

        return redirect()->back()->with('success', 'User saved successfully.');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|unique:users,code,' . $id,
        ]);
        $user=User::findOrFail($id);
        $user->update($request->only('code','status'));
        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user=User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }


    public function filteration(){
        $years=Year::all();
        return view('dashboard.filteration',compact('years'));
    }
    public function createQuestion(){
        $chapters=Chapter::all();
        return view('dashboard.createQuestion',compact('chapters'));
    }
    public function questions(Request $request){

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

            return view('dashboard.editQuestions', compact('subject', 'year', 'chapter','chapters', 'questions','questionType','questionSource'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Not accepted enter validate data');
        }


    }


////////////////////////////////////////////////////
public function storeQuestion(Request $request)
{
$validatedData = $request->validate([
    'chapter_name' => 'required|string|exists:chapters,chapter_name',
    'question' => 'required|string',
    'type' => ['required','string', 'in:QCM,Cas Cliniques'],
    'source' => ['required','string', "in:Toutes ces questions là sont des questions tombables et prennent comme source les sujets d'externat,Reponse unique,Residanat de la faculté Médecine en Algerie,all"],
    'answers' => 'required|array|min:2',
    'answers.*.answer' => 'required|string',
    'answers.*.is_correct' => 'required|in:0,1',
    'comment' => 'nullable|string'
]);


    $chapter = Chapter::firstOrCreate(['chapter_name' => $validatedData['chapter_name']]);

    $question = new Question();
    $question->question = $validatedData['question'];
    $question->type = $validatedData['type'];
    $question->source = $validatedData['source'];
    $question->chapter_id = $chapter->id;
    $question->comment = $validatedData['comment'];
    $question->save();

    foreach ($validatedData['answers'] as $answerData) {
        $answer = new Answer();
        $answer->answer = $answerData['answer'];
        $answer->is_correct = $answerData['is_correct'];
        $question->answers()->save($answer);
    }

    return redirect()->back()->with('success', 'Question created successfully.');
}


public function updateQuestion(Request $request, $questionId)
{
  try{  $request->validate([
        'question' => 'required',
        'comment' => 'nullable|string'
    ]);

    $question = Question::findOrFail($questionId);
    $question->question = $request->question;
    $question->comment = $request->comment;
    $question->save();
    return redirect()->route('filteration')->with('success', 'Question updated successfully.');

}
catch (\Exception $e) {
    return redirect()->route('filteration')->withInput()->withErrors(["error"=>"enter correct question"]);
}


}

public function updateAnswer(Request $request, $answerId)
{
    try{ $request->validate([
        'answer' => 'required|string',
        'is_correct' => 'required|in:0,1',

    ]);

    $answer = Answer::findOrFail($answerId);
    $answer->answer = $request->answer;
    $answer->is_correct=$request->is_correct;
    $answer->save(); // Save the changes

    return redirect()->route('filteration')->with('success', 'Answer updated successfully.');}
    catch (\Exception $e) {
        return redirect()->route('filteration')->withInput()->withErrors(["error"=>"enter correct answer"]);
    }


}


public function deleteQuestion($questionId)
{
    $question = Question::findOrFail($questionId);

    $question->answers()->delete();
    $question->delete();

    return redirect()->route('filteration')->with('success', 'Question deleted successfully.');

}

public function deleteAnswer($answerId)
{
    $answer = Answer::findOrFail($answerId);
    $answer->delete();

    return redirect()->route('filteration')->with('success', 'Answer deleted successfully.');
}



}
