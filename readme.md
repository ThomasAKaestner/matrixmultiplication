# Task: Matrix multiplication

Create a Laravel / Lumen application for Matrix multiplication. The app should feature a Rest-API with authentication.

## Validation
For Matrix multiplication, the column count in the first matrix should be equal to the row count of the second matrix.
 If this condition is not met, the app should throw a validation error.

## resulting matrix 
The resulting matrix should contain characters rather than numbers, similar to excel columns.
 Examples: 1 => A, 26 => Z, 27 => AA, 28 => AB. At leat the calculation should be covered by tests.

## Technical Details
* At least PHP 7.2 for coding 
* PSR-2 coding standard
* strict type hinting

## Testing
Post this json to the API "/matrixmulti" data={"m1":[[2,3],[7,4]],"m2":[[213,233],[23,23]] }

## Tech Stack 
* Laravel Lumen
* PHP7
* Visual Studio Code
* Post Man
* GIT