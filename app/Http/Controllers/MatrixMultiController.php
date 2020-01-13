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
        $data = $request->input("data");
        $data = json_decode($data);
        $matrix1 = $data->m1;
        $matrix2 = $data->m2;
        $key = "ouytuoba";
        // checks if the matrix has always the same column
        if(!($this->matrixCheckColumn($matrix1)) || !($this->matrixCheckColumn($matrix2)))
        {
            return "Error: Matrix columns should be the same size.";
        }

        if(!$this->columnEqualRow($matrix1,$matrix2))
        {
            return "Error: blabla";
        }
        $this->matrixMultiplication($matrix1,$matrix2);

        return "yes";
    }

    /**
     * The function matrixCheckColumn is checking if a matrix has the same column sizes & checks if the matrix consists only of integers/ numbers
     * 
     * @param $matrix / 2 demensional array 
     * 
     * @return boolean / returns true false 
     */

    private function matrixCheckColumn($matrix)
    {
        $fistColumnLength = null;
        foreach($matrix as $keyR => $row)
        {
            $fistColumnLength = ($fistColumnLength == null ?  sizeOf($row) : $fistColumnLength);
            if($fistColumnLength !== sizeOf($row))
            {
                return false;
            }
            foreach($row as $keyC => $column)
            {
                if(is_int($column) == false)
                {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * This funcion checks if the column count in the first matrix is equal to the row count of the second matrix
     */
    private function columnEqualRow($matrix1, $matrix2)
    {
        if(sizeOf($matrix1[0]) == sizeOf($matrix2))
        {
            return true;
        }
        return false;
    }

    private function matrixMultiplication($matrix1, $matrix2)
    {
        $temp = null;
        //row 
        for($i = 0; $i < sizeOf($matrix1); $i++)
        {   
            sizeOf($matrix1[$i]);
            $q = null;
            //column
            for($n = 0; $n < sizeOf($matrix1[$i]); $n++)
            {
                
                for($k = 0; $k < sizeOf($matrix2[$i]); $k++)
                {
                    
                    if($q == null){
                        $q = $n;
                    }
                    
                    echo($matrix1[$i][$n]. " * ". $matrix2[$n][$k] . "<br>");
                    $temp = $matrix1[$i][$n] * $matrix2[$n][$q];
                    $n++;
                
                } 
                dd($temp);




                echo($matrix1[$i][$n]);
               
               
                // for($k = 0; $k < sizeOf($matrix2[$i]); $k++)
                // {
                //     $temp = $temp + $matrix1[$i][$n] * $matrix2[$i][$k];
                // }
                // dd($temp);
                
            }
            // foreach($matrix1 as $key)
            // {

            // }

        }
    }

    private function matrixToAlpabet($matrix)
    {




    }

}