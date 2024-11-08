<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();

        if($students) {
            $data = [
                'message' => 'Get all students',
                'data' => $students
            ];
        } else {
            $data = [
                'message' => 'Student is empty'
            ];
        }

        return response()->json($data, 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'numeric|required',
            'email' => 'email|required',
            'jurusan' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'error' => $validator->errors()
            ], 422);
        }

        $students = Student::create($request->all());
        $data = [
            'message' => 'Student is created successfully',
            'data' => $students
        ];
 
        return response()->json($data, 201);
    }


    public function update(Request $request, $id){
        $student = Student::find($id);

        if ($student) {
            // menangkap data request
            $input = [
                'nama' => $request->nama ?? $request->nama,
                'nim' => $request->nim ?? $request->nim, 
                'email' => $request->email ?? $request->email,
                'jurusan' => $request->jurusan ?? $request->jurusan,
            ];

            // melakukan update data
            $student->update($input);

            $data = [
                'message' => 'Student is updated',
                'data' => $student,
            ];
            // menampilkan data (json) dan kode 200
            return response()->json($data, 200);
            
        } else {
            $data = [
                'message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function destroy($id){
        // mencari id students yang ingin di hapus
        $student = Student::find($id);

        if ($student) {
            // hapus data student tersebut
            $student->delete();

            $data = [
                'message' => 'Student is deleted'
            ];
            // mengembalikan data (json) dan kode 200
            return response()->json($data, 200);

        } else {
            $data = [
                'message' => 'Data not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function show($id){
        $student = student::find($id);

        if ($student){
            $data = [
                'message' => 'Get detail student',
                'data' => $student,
            ];
            // mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        }else{
            $data = [
                'message' => 'Student not found',
            ];
            return response()->json($data, 404);
        }
    }

}