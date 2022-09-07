<?php
$fileName = __DIR__ . "/input.txt";
$inputFile = fopen($fileName, "r") or die("Unable to open file!");

$inputArray = array();
$timesDepthIncreased = 0;
array_push($inputArray, fgets($inputFile));
array_push($inputArray, fgets($inputFile));
array_push($inputArray, fgets($inputFile));

$previousDepth = $inputArray[0] + $inputArray[2] + $inputArray[3];
for ($i = 3; $i < filesize($fileName); $i++) {
    array_push($inputArray, fgets($inputFile));
    $currentDepth = $inputArray[$i - 2] + $inputArray[$i - 1] + $inputArray[$i];
    if ($previousDepth < $currentDepth)
        $timesDepthIncreased++;
    $previousDepth = $currentDepth;
}

echo ("result=" . $timesDepthIncreased);
fclose($inputFile);
