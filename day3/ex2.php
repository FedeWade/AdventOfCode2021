<?

$fileName = __DIR__ . "/input.txt";
$inputFile = fopen($fileName, "r") or die("unable to open file");

$inputArray = array();
while (!feof($inputFile)) {
    array_push($inputArray, fgets($inputFile));
}

$lineLength = strlen($inputArray[0]) - 2;

$oxyArray = $inputArray;
$co2Array = $inputArray;
for ($i = 0; $i < $lineLength; $i++) {
    $oxyArray = reduceArray($oxyArray, $i, findMostValuableBit($oxyArray, $i));
    $co2Array = reduceArray($co2Array, $i, findMostValuableBit($co2Array, $i) == 0 ? 1 : 0);
}

$oxyRating = bindec($oxyArray[0]);
$co2Rating = bindec($co2Array[0]);
echo "result= " . $oxyRating * $co2Rating . PHP_EOL;




function findMostValuableBit($inputArray, $position)
{
    $numOfZeroes = 0;
    $numOfOnes = 0;
    for ($i = 0; $i < count($inputArray); $i++) {
        ($inputArray[$i][$position] == "0") ? $numOfZeroes++ : $numOfOnes++;
    }
    if ($numOfZeroes > $numOfOnes) return 0;
    else return 1;
}

function reduceArray($array, $position, $mostValuableBit)
{
    if (count($array) == 1) return $array;
    foreach ($array as $key => $value) {

        if ($value[$position] == $mostValuableBit)
            unset($array[$key]);
    }
    return array_values($array);
}
