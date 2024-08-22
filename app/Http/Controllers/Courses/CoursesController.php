<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Courses;

class CoursesController extends Controller
{
    // Get All courses
    public function index()
    {
        try {
            $courses = Courses::with('coordinator')->get();
            return response()->json(['courses' => $courses], 200);
        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }

    // Create a new course
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'coordinator_id' => 'required|integer',
            ]);

            if ($validator->fails())
            {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $course = Courses::create([
                'name' => $request->name,
                'coordinator_id' => $request->coordinator_id,
            ]);

            return response()->json(['course' => $course], 200); 

        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }

    // 
    public function show(string $id)
    {
        try {
            $course = Courses::find($id);
            return response()->json(['course' => $course], 200);
        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }

    // 
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'coordinator_id' => 'required|integer',
            ]);

            if ($validator->fails())
            {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $course = Courses::find($id);
            $course->name = $request->name;
            $course->coordinator_id = $request->coordinator_id;
            $course->save();

            return response()->json(['course' => $course], 200);

        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }

    // 
    public function destroy(string $id)
    {
        try {
            $course = Courses::find($id);
            $course->delete();
            return response()->json(['success' => 'Course deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }
}
