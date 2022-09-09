<?php
$fileName = __DIR__ . "/input.txt";
$inputFile = fopen($fileName, "r") or die("Unable to open file!");

$depth = 0;
$distance = 0;
$aim = 0;
while (!feof($inputFile)) {
    $line = explode(' ', fgets($inputFile));
    $direction = $line[0];
    $value = $line[1];

    switch ($direction) {
        case "forward":
            $distance += $value;
            $depth += ($aim * $value);
            break;
        case "down":
            $aim += $value;
            break;
        case "up":
            $aim -= $value;
            break;
    }
}

echo "result: " . $depth * $distance;
fclose($inputFile);
