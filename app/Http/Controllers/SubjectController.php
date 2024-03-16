<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Chapter;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSubjectsByYear($year)
{
    // Ensure $year is a valid integer
    if (!ctype_digit($year)) {
        return response()->json(['error' => 'Invalid year parameter.'], 400);
    }

    // Query subjects for the given year
    $subjects = Subject::where('year_id', $year)->pluck('subject_name', 'id');

    // Check if any subjects are found
    if ($subjects->isEmpty()) {
        return response()->json(['message' => 'No subjects found for the given year.'], 404);
    }

    // Return the list of subjects
    return response()->json($subjects);
}

public function getChaptersBySubject($subjectId)
{
    // Query chapters for the given subject
    $chapters = Chapter::where('subject_id', $subjectId)->pluck('chapter_name', 'id');

    // Return the list of chapters as JSON response
    return response()->json($chapters);
}

}
