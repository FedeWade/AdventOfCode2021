<?
$fileName = __DIR__ . "/input.txt";
$inputFile = fopen($fileName, "r") or die("unable to open file");

$estractions = explode(',', trim(fgets($inputFile)));
fgets($inputFile);

$boardsArray = array();
$board = $row = $col = 0;

//Read input from file
while (!feof($inputFile)) {
    $currentLine = trim(str_replace("  ", " ", fgets($inputFile)));

    if ($currentLine == "") {
        $board++;
        $row = 0;
    } else {
        $currentLine = explode(' ', $currentLine);
        $col = 0;
        foreach ($currentLine as $key => $number) {
            $boardsArray[$board][$row][$col] = $number;
            $col++;
        }
        $row++;
    }
}

//Calculate bingo winners
$winningBoard;
$winningNumber;
foreach ($estractions as $key => $estractionNumber) {
    foreach ($boardsArray as $boardIndex => $board) {
        foreach ($board as $rowIndex => $row) {
            foreach ($row as $colIndex => $currBoardNumber) {
                if ($currBoardNumber == $estractionNumber) {
                    $boardsArray[$boardIndex][$rowIndex][$colIndex] = "x";

                    $rowCheck = $colCheck = true;
                    for ($i = 0; $i < 5; $i++) {
                        if ($boardsArray[$boardIndex][$i][$colIndex] != "x") $rowCheck = false;
                        if ($boardsArray[$boardIndex][$rowIndex][$i] != "x") $colCheck = false;
                    }
                    if ($colCheck || $rowCheck) {
                        if (count($boardsArray) == 1) {
                            $winningBoard = $boardIndex;
                            $winningNumber = $estractionNumber;
                            break 4;
                        }
                        unset($boardsArray[$boardIndex]);
                    }
                }
            }
        }
    }
}
$winningBoardScore = getBoardScore($boardsArray, $winningBoard, $winningNumber);
echo "result: " . $winningBoardScore;


function getBoardScore($boardsArray, $winningBoard, $winningNumber)
{
    $result = 0;
    for ($i = 0; $i < 5; $i++) {
        for ($j = 0; $j < 5; $j++) {
            $currentValue = $boardsArray[$winningBoard][$i][$j];
            if ($currentValue != "x") $result += $currentValue;
        }
    }
    return $result * $winningNumber;
}
