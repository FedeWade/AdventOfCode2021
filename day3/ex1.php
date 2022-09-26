<?php

$fileName = __DIR__ . "/input.txt";
$inputFile = fopen($fileName, "r") or die("unable to open file");

$inputArray = array();
while (!feof($inputFile)) {
    array_push($inputArray, fgets($inputFile));
}

//calculate gamma rate
$lineLength = strlen($inputArray[0]) - 2;
$gammaRate = "";

for ($columnIndex = 0; $columnIndex < $lineLength; $columnIndex++) {
    $numOfZeroes = 0;
    $numOfOnes = 0;
    for ($i = 0; $i < count($inputArray); $i++) {
        $currChar = strpos($inputArray[$i], $columnIndex);
        ($currChar == "0") ? $numOfZeroes++ : $numOfOnes++;
    }
    ($numOfZeroes > $numOfOnes) ? $gammaRate .= "0" : $gammaRate .= "1";
    echo $numOfOnes . " -1-0- " . $numOfZeroes . PHP_EOL;
}

//calculate epsilon rate
$epsilonRate = $gammaRate;
$epsilonRate = str_replace("0", "x", $epsilonRate);
$epsilonRate = str_replace("1", "0", $epsilonRate);
$epsilonRate = str_replace("x", "1", $epsilonRate);


$gammaRate = bindec($gammaRate);
$epsilonRate = bindec($epsilonRate);

echo $gammaRate * $epsilonRate;
