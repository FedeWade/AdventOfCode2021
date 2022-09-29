<?
$fileName = __DIR__ . "/input.txt";
$inputFile = fopen($fileName, "r") or die("unable to open file");

$input = fgets($inputFile);
$inputList = explode(",", $input);

$fishMap = array(0, 0, 0, 0, 0, 0, 0, 0, 0);

foreach ($inputList as $value) {
    $fishMap[$value]++;
}

for ($i = 0; $i < 80; $i++) {
    $newFish = array_shift($fishMap);
    $fishMap[6] += $newFish;
    array_push($fishMap, $newFish);
}
echo array_sum($fishMap);
