<?php
    $dir_up = '../out/up/';
    $dir_dwn = '../out/dwn/';
    $dir_etc = '../out/etc/';

    $files_up = glob($dir_up . '{*.csv}', GLOB_BRACE);
    $files_dwn = glob($dir_dwn . '{*.csv}', GLOB_BRACE);
    $files_etc = glob($dir_etc . '{*.csv}', GLOB_BRACE);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>回答数カウント</title>
</head>
<body>
    <h1>アンケート回答数</h1>
    <p>上り線：<?php echo count($files_up) ?>件<br></p>
    <p>下り線：<?php echo count($files_dwn) ?>件<br></p>
    <p>不明：<?php echo count($files_etc) ?>件<br></p>
</body>
</html>