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
    if (($cloudDirection == "horizontal" && $startPoint[0] > $endPoint[0]) || ($cloudDirection == "vertical" && $startPoint[1] > $endPoint[1])) {
        $temp = array();
        $temp = array_replace($temp, $startPoint);
        $startPoint = array_replace($startPoint, $endPoint);
        $endPoint = array_replace($endPoint, $temp);
    }

    $cloudLength = ($cloudDirection == "horizontal") ? $endPoint[0] - $startPoint[0] + 1 : $endPoint[1] - $startPoint[1] + 1;
    if ($cloudDirection != "oblique") {
        $cloudsMap = drawCloud($cloudsMap, $startPoint, $endPoint, $cloudDirection, $cloudLength);
    }
}

$result = 0;
for ($i = 0; $i < 1000; $i++) {
    for ($y = 0; $y < 1000; $y++) {
        if (isset($cloudsMap[$i][$y]) && $cloudsMap[$i][$y] >= 2)
            $result++;
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
        case "vertical":
            for ($i = 0; $i < $cloudLength; $i++) {
                if (isset($cloudsMap[$startPoint[1] + $i][$startPoint[0]]))
                    $cloudsMap[$startPoint[1] + $i][$startPoint[0]] += 1;
                else
                    $cloudsMap[$startPoint[1] + $i][$startPoint[0]] = 1;
            }
            break;

        case "horizontal":
            for ($i = 0; $i < $cloudLength; $i++) {
                if (isset($cloudsMap[$startPoint[1]][$startPoint[0] + $i]))
                    $cloudsMap[$startPoint[1]][$startPoint[0] + $i] += 1;
                else
                    $cloudsMap[$startPoint[1]][$startPoint[0] + $i] = 1;
            }
            break;
    }
    return $cloudsMap;
}
