<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AnimalController extends Controller{

  public $animals = ["Kucing ", "Ayam ", "Ikan "];

    public function index(){
        foreach ($this->animals as $animal) {
            echo $animal;
        }
        echo "\n Menambahkan hewan baru";
    }

    public function store(Request $request){
        array_push ($this->animals, $request->nama);
        echo "Nama hewan: $request->nama \n";
        echo "Menambahkan hewan baru";
    }

    public function update(Request $request, $id){
        $this->animals[$id] = $request->nama;
        echo "Nama hewan: $request->nama \n";
        echo "Mengupdate data hewan id $id";
    }

    public function destroy($id){
        array_splice ($this->animals, $id);
        echo "Menghapus data hewan id $id";
    }

}