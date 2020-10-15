<?php
    $dir = '../csv/';
    $files = glob($dir . '{*.csv}', GLOB_BRACE);

    if (!$files) {
        $file_count = 0;
    }
    $file_count = count($files);

    echo "現在の回答数は、" . $file_count . " です。";
?>