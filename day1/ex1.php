<?php
$fileName = __DIR__ . "/input.txt";
$inputFile = fopen($fileName, "r") or die("Unable to open file!");

$inputArray[] = array();
$timesDepthIncreased = 0;
array_push($inputArray, fgets($inputFile));
for ($i = 1; $i < filesize($fileName); $i++) {
    array_push($inputArray, fgets($inputFile));
    if ($inputArray[$i - 1] < $inputArray[$i])
        $timesDepthIncreased++;
}
echo ("result=" . $timesDepthIncreased);
fclose($inputFile);
