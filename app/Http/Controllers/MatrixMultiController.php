<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class MatrixMultiController extends Controller
{
    public function get()
    {
        dd("tests");
        
    }

    public function post(Request $request)
    {
        // dd($request);
        $a1 = array('0' => array('0' =>  21, '1' => 73), '1' => array('0' => 35, '1' => 81 ) );
        $a2 = array('0' => array('0' =>  32, '1' => 98), '1' => array('0' => 17, '1' => 7) );
        // check if both matrix have the same height & width
        $this->matrixCheck($a1);
    }

    private function matrixCheck($matrix)
    {
        foreach($matrix as $key => $value)
        {
            dd($value);
        }
    }
}