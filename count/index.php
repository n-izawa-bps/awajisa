<?php
    $dir_up = '../out/up/';
    $dir_dwn = '../out/dwn/';
    $dir_etc = '../out/etc/';

    $files_up = glob($dir_up . '{*.csv}', GLOB_BRACE);
    $files_dwn = glob($dir_dwn . '{*.csv}', GLOB_BRACE);
    $files_etc = glob($dir_etc . '{*.csv}', GLOB_BRACE);

    echo "アンケート回答数<br>";
    echo "上り線：" . count($files_up) . "件<br>";
    echo "下り線：" . count($files_dwn) . "件<br>";
    echo "不明：" . count($files_etc) . "件<br>";
?>