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
    if ($cloudDirection == "horizontal" && $startPoint[0] > $endPoint[0]) {
        $temp = $startPoint;
        $startPoint = $endPoint;
        $endPoint = $temp;
    }

    $cloudLength = ($cloudDirection == "horizontal") ? abs($startPoint[0] - $endPoint[0]) : abs($startPoint[1] - $endpoint[1]);
    if ($cloudDirection != "oblique") {
        $cloudsMap = drawCloud($cloudsMap, $startPoint, $endPoint, $cloudDirection, $cloudLength);
    }
}

$result = 0;
for ($i = 0; $i < 1000; $i++) {
    for ($y = 0; $y < 1000; $y++) {
        if (isset($cloudsMap[$i][$y]))
            if ($cloudsMap[$i][$y] >= 2) $result++;
    }
}
echo "result: " . $result;



function getDirection($startPoint, $endPoint)
{
    if ($startPoint[0] == $endPoint[0]) return "vertical";
    if ($startPoint[1] == $endPoint[1]) return "horizontal";
    return "oblique";
}


function drawCloud($cloudsMap, $startPoint, $endPoint, $cloudDirection, $cloudLength)
{
    switch ($cloudDirection) {
        case "horizontal":
            if ($startPoint[0] < $endPoint[0]) {
                for ($i = 0; $i < $cloudLength; $i++) {
                    if (isset($cloudsMap[$startPoint[0] + $i][$startPoint[1]]))
                        $cloudsMap[$startPoint[0] + $i][$startPoint[1]] += 1;
                    else
                        $cloudsMap[$startPoint[0] + $i][$startPoint[1]] = 1;
                }
            } else {
                for ($i = $cloudLength; $i <= 0; $i++) {
                    if (isset($cloudsMap[$startPoint[0] + $i][$startPoint[1]]))
                        $cloudsMap[$startPoint[0] + $i][$startPoint[1]] += 1;
                    else
                        $cloudsMap[$startPoint[0] + $i][$startPoint[1]] = 1;
                }
            }
            break;

        case "vertical":
            if ($startPoint[1] < $endPoint[1]) {

                for ($i = 0; $i < $cloudLength; $i++) {
                    if (isset($cloudsMap[$startPoint[0]][$startPoint[1] + $i]))
                        $cloudsMap[$startPoint[0]][$startPoint[1] + $i] += 1;
                    else
                        $cloudsMap[$startPoint[0]][$startPoint[1] + $i] = 1;
                }
            } else {
                for ($i = $cloudLength; $i <= 0; $i++) {
                    if (isset($cloudsMap[$startPoint[0]][$startPoint[1] + $i]))
                        $cloudsMap[$startPoint[0]][$startPoint[1] + $i] += 1;
                    else
                        $cloudsMap[$startPoint[0]][$startPoint[1] + $i] = 1;
                }
            }
            break;
    }
    return $cloudsMap;
}
