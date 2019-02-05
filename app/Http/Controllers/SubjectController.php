<?php

namespace App\Http\Controllers;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubjectController extends Controller
{
    /**
     * Get the subjects belonging to one course.
     *
     * @param string $courseId
     * @return json 
     */
    public function getCourseSubjects($courseId)
    {
        $data = Subject::where('course_id', $courseId)->get()->toArray();
        if (empty($data)) {
            throw new ModelNotFoundException();
        }
        return response()->json(['msg' => 'success', 'data' => $data], 200);
    }

    /**
     * Get the details of one subject.
     *
     * @param string $subjectId
     * @return json 
     */
    public function getSubjectDetails($subjectId)
    {
        $data = Subject::findOrFail($subjectId);
#        $data = Subject::withTrashed()->where('id', $subjectId)->get();
        return response()->json(['msg' => 'success', 'data' => $data], 200);
    }

    /**
     * Soft delete one subject.
     *
     * @param string $subjectId
     * @return json 
     */
    public function deleteSubject($subjectId)
    {
        $data = Subject::where('id', $subjectId)->delete(); 
        return response()->json(['msg' => 'success', 'data' => $data], 204);
    }

    /**
     * Hide or unhide one subject.
     *
     * @param Illuminate\Http\Request $request
     * @param string $subjectId
     * @return json 
     */
    public function hideSubject(Request $request, $subjectId)
    {
        if (intval($request->hidden) !== 1 && intval($request->hidden) !== 2) {
            return response()->json(['msg' => 'Bad Request'], 400);
        }
        $data = Subject::findOrFail($subjectId);
        $data->hidden = intval($request->hidden);
        $data->save();
        return response()->json(['msg' => 'success', 'data' => $data], 200);
    }

    /**
     * update one subject.
     *
     * @param Illuminate\Http\Request $request
     * @param string $subjectId
     * @return json 
     */
    public function editSubject(Request $request, $subjectId)
    {
        $data = Subject::findOrFail($subjectId);
        $data->update($request->all());
        return response()->json(['msg' => 'success', 'data' => $data], 200);
    }
}
