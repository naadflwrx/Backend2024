<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();

        $data = [
            'message' => 'Get all students',
            'data' => $students
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request) {
        // menangkap data request
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];

        $student = Student::create($input);

        $data = [
            'message' => 'Student is created succesfully',
            'data' => $student,
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
}