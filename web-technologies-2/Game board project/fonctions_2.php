<?php
function createBoard($fileName) {
    $file = fopen($fileName, 'r');
    if (!$file) {
        echo "<p>Error: Unable to open the file.</p>";
        return;
    }

    $board = [];
    $lineLength = 0;
    $rowCount = 0;

    while (($line = fgets($file)) !== false) {
        $line = trim($line); 
        if ($line === '') continue; 

        if ($lineLength === 0) {
            $lineLength = strlen($line); 
        }

        if (strlen($line) !== $lineLength) {
            echo "<p>Error: Detected rows with inconsistent lengths.</p>";
            fclose($file);
            return;
        }

        $board[] = $line;
        $rowCount++;
    }
    fclose($file);

    if ($rowCount !== $lineLength) {
        echo "<p>Error: The board is not square!</p>";
        return;
    }

    echo '<table class="plateau">';
    foreach ($board as $row) {
        echo '<tr>';
        foreach (str_split($row) as $cell) {
            if ($cell === 'B') {
                echo '<td class="blanc"><span>B</span></td>';
            } elseif ($cell === 'N') {
                echo '<td class="noir"><span>N</span></td>';
            } else {
                echo '<td></td>';
            }
        }
        echo '</tr>';
    }
    echo '</table>';
}
?>
