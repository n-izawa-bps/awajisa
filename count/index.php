<?php
function getCntOfCsv()
{
    $dir = '../csv/';
    $files = glob($dir . '{*.csv}', GLOB_BRACE);

    if (!$files) {
        return 0;
    }
    return count($files);
}

    echo "現在の回答数は、" . getCntOfCsv() . " です。";
?>