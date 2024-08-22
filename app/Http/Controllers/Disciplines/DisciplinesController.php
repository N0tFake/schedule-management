<?php

namespace App\Http\Controllers\Disciplines;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Discipline;

class DisciplinesController extends Controller
{
    public function index()
    {
        try {
            $disciplines = Discipline::with('course')->get();

            return response()->json(['disciplines' => $disciplines], 200);
        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'syllabus' => 'string',
                'course_id' => 'required|string',
                'professor_name' => 'required|string',
                'professor_email' => 'required|email',
            ]);

            if ($validator->fails())
            {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $discipline = Discipline::create([
                'name' => $request->name,
                'syllabus' => $request->syllabus,
                'course_id' => $request->course_id,
                'professor_name' => $request->professor_name,
                'professor_email' => $request->professor_email,
            ]);

            return response()->json(['discipline' => $discipline], 200);

        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $discipline = Discipline::find($id);
            return response()->json(['discipline' => $discipline], 200);
        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'syllabus' => 'string',
                'course_id' => 'required|string',
                'professor_name' => 'required|string',
                'professor_email' => 'required|email',
            ]);


            if ($validator->fails())
            {
                return response()->json(['error' => true, 'message' => $validator->errors()]);
            }

            $discipline = Discipline::find($id);
            if (!$discipline) {
                return response()->json(['error' => true, 'message' => 'Discipline not found'], 404);
            }
            $discipline->name = $request->name;
            $discipline->syllabus = $request->syllabus;
            $discipline->course_id = $request->course_id;
            $discipline->professor_name = $request->professor_name;
            $discipline->professor_email = $request->professor_email;
            $discipline->save();

            return response()->json(['discipline' => $discipline], 200);

        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $discipline = Discipline::find($id);
            $discipline->delete();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['Error' => true, 'message' => $e->getMessage()]);
        }
    }
}
