<?
$fileName = __DIR__ . "/input.txt";
$inputFile = fopen($fileName, "r") or die("unable to open file");

$cloudsMap = array();

while (!feof($inputFile)) {
    $currentLine = trim(fgets($inputFile));
    $coordinates = explode("->", $currentLine);
    $startPoint = explode(",", trim($coordinates[0]));
    $endPoint = explode(",", trim($coordinates[1]));

    $cloudDirection = getDirection($startPoint, $endPoint);
    if (($cloudDirection == "horizontal" && $startPoint[0] > $endPoint[0]) || $startPoint[1] > $endPoint[1]) {
        $temp = array();
        $temp = array_replace($temp, $startPoint);
        $startPoint = array_replace($startPoint, $endPoint);
        $endPoint = array_replace($endPoint, $temp);
    }

    $cloudLength = ($cloudDirection == "horizontal") ? $endPoint[0] - $startPoint[0] + 1 : $endPoint[1] - $startPoint[1] + 1;
    $cloudsMap = drawCloud($cloudsMap, $startPoint, $endPoint, $cloudDirection, $cloudLength);
}

$counter = 0;
array_walk_recursive($cloudsMap, function ($value, $key) use (&$counter) {
    if ($value > 1)
        $counter++;
}, $counter);

echo "result: " . $counter; //21698 correct result



function getDirection($startPoint, $endPoint)
{
    if ($startPoint[0] == $endPoint[0]) return "vertical";
    if ($startPoint[1] == $endPoint[1]) return "horizontal";
    if (($startPoint[0] < $endPoint[0] && $startPoint[1] < $endPoint[1]) || ($startPoint[0] > $endPoint[0] && $startPoint[1] > $endPoint[1])) return "obliqueRight";
    if (($startPoint[0] > $endPoint[0] && $startPoint[1] < $endPoint[1]) || $startPoint[0] < $endPoint[0] && $startPoint[1] > $endPoint[1]) return "obliqueLeft";
}

function drawCloud($cloudsMap, $startPoint, $endPoint, $cloudDirection, $cloudLength)
{
    switch ($cloudDirection) {
        case "vertical":
            for ($i = 0; $i < $cloudLength; $i++) {
                $cloudsMap[$startPoint[1] + $i][$startPoint[0]]++;
            }
            break;

        case "horizontal":
            for ($i = 0; $i < $cloudLength; $i++) {
                $cloudsMap[$startPoint[1]][$startPoint[0] + $i]++;
            }
            break;

        case "obliqueRight":
            for ($i = 0; $i < $cloudLength; $i++) {
                $cloudsMap[$startPoint[1] + $i][$startPoint[0] + $i]++;
            }
            break;

        case "obliqueLeft":
            for ($i = 0; $i < $cloudLength; $i++) {
                $cloudsMap[$startPoint[1] + $i][$startPoint[0] - $i]++;
            }
            break;
    }
    return $cloudsMap;
}
