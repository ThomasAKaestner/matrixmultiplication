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
        $matrix3 = $this->matrixMultiplication($matrix1,$matrix2);
        return $this->matrixToAlpabet($matrix3);
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
            if($fistColumnLength  !== sizeOf($row))
            {
                return false;
            }
        }
        return true;
    }

    /**
     * This funcion checks if the column count in the first matrix is equal to the row count of the second matrix
     */
    private function columnEqualRow($matrix1, $matrix2)
    {
        if(sizeOf($matrix1) == sizeOf($matrix2[0]))
        {
            return true;
        }
        return false;

    }

    private function matrixMultiplication($matrix1, $matrix2)
    {
        $matrix3 = array();
        for($i=0; $i < sizeOf($matrix1); $i++)
        {
            for($n =0; $n < sizeOf($matrix2[0]); $n++)
            {
                $matrix3[$i][$n]=0;
                for($k= 0; $k < sizeOf($matrix2); $k++)
                {
                    $matrix3[$i][$n] += $matrix1[$i][$k]*$matrix2[$k][$n];
                }
            }
        }
        return $matrix3;
    }

    private function matrixToAlpabet($matrix)
    {   
        $result = array();
        foreach($matrix as $keyR => $row)
        {
            foreach($row as $keyC => $column)
            {
                $result[$keyR][$keyC] = $this->integerToChar($column); 
            }
        }
    }

    private function integerToChar($param)
    {

        $rest = 26;
        dd($rest);
    }
}