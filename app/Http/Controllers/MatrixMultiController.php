<?php
namespace App\Http\Controllers;
/**
 * using Request for http post requests
 */

use Illuminate\Http\Request;


/**
 * the class MatrixMultiController is 
 * 
 * 
 */
class MatrixMultiController extends Controller
{
    public function get()
    {
        return "Hello Christian";      
    }

    public function post(Request $request)
    {
        $data = $request->input("data");
        $key = $request->input("key");
        if($key !== "XOzTd4KJOq")
        {
            $response = array("http_response"=>401,["error"=>"Unauthenticated","message"=>"the api key is wrong/not set"]);
            return json_encode($response);
        }
        if(is_null($data))
        {
            $response = array("http_response"=>400,["error"=>"Bad Request","message"=>"the parameter data is empty"]);
            return json_encode($response);
        }
        $data = json_decode($data);
        $matrix1 = $data->m1;
        $matrix2 = $data->m2;
        if(!($this->matrixCheckColumn($matrix1)) || !($this->matrixCheckColumn($matrix2)))
        {
            $response = array("http_response"=>400,["error"=>"Bad Request","message"=>"a matrix has not the same column size"]);
            return json_encode($response);
        }
        if(!$this->columnEqualRow($matrix1,$matrix2))
        {
            $response = array("http_response"=>400,["error"=>"Bad Request","message"=>"the column count in the first matrix is not equal to the row count of the second matrix"]);
            return json_encode($response);
        }
        $matrix3 = $this->matrixMultiplication($matrix1,$matrix2);
        $result = $this->matrixToAlphabet($matrix3);
        $response = array("http_response"=>200,[$result]);
        return $response;
    }

    public function test(Request $request)
    {
        return "test";
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
     * @param $matrix1 stands for the first matrix
     * @param $matrix2 stands for the second matrix
     * @return boolean
     */
    private function columnEqualRow($matrix1, $matrix2)
    {
        if(sizeOf($matrix1) == sizeOf($matrix2[0]))
        {
            return true;
        }
        return false;
    }

    /**
     * The function matrixMultiplication is multiplying matrix1 with matrix2
     * @param $matrix1 stands for the first matrix
     * @param $matrix2 stands for the second matrix
     * @return $matrix3 stands for the resulting matrix
     */
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

    /**
     * The function matrixToAlphabet is converting an integer matrix into a matrix consisting of chars
     * @param $matrix is a matrix consisting of numbers/ integers
     * @return $result is a matrix consisting of chars
     */
    private function matrixToAlphabet($matrix)
    {   
        $result = array();
        foreach($matrix as $keyR => $row)
        {
            foreach($row as $keyC => $column)
            {
                $result[$keyR][$keyC] = $this->integerToChar($column); 
            }
        }
        return $result;
    }

    /**
     * The function integerToChar is converting an integer to a character. for example: 1 => A, 26 => Z, 27 => AA, 28 => AB.
     * @param $param stands for an integer 
     * @return $text stands for a string consisting of one or more characters
     */
    private function integerToChar($param)
    {
        $text = "";
        while ($param > 0)
        {
            $currentLetterNumber = ($param - 1) % 26;
            $currentLetter = chr($currentLetterNumber + 65);
            $text = $currentLetter. $text;
            $param = ($param - ($currentLetterNumber + 1)) / 26;
        }
        return $text;
    }
}