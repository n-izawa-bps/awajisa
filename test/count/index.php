<?php
    $dir_up_open = '../out/up/open/';
    $dir_up_close = '../out/up/close/';
    $dir_dwn_open = '../out/dwn/open/';
    $dir_dwn_close = '../out/dwn/close/';
    $dir_etc = '../out/etc/';

    $files_up_open = glob($dir_up_open . '{*.csv}', GLOB_BRACE);
    $files_up_close = glob($dir_up_close . '{*.csv}', GLOB_BRACE);
    $files_dwn_open = glob($dir_dwn_open . '{*.csv}', GLOB_BRACE);
    $files_dwn_close = glob($dir_dwn_close . '{*.csv}', GLOB_BRACE);
    $files_etc = glob($dir_etc . '{*.csv}', GLOB_BRACE);

    $cnt_up_open = count($files_up_open);
    $cnt_dwn_open = count($files_dwn_open);
    $sum_open = $cnt_up_open + $cnt_dwn_open;

    $cnt_up_close = count($files_up_close);
    $cnt_dwn_close = count($files_dwn_close);
    $sum_close = $cnt_up_close + $cnt_dwn_close;

    $sum_up = $cnt_up_open + $cnt_up_close;
    $sum_dwn = $cnt_dwn_open + $cnt_dwn_close;
    $sum_all = $sum_up + $sum_dwn;
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>回答数カウント</title>
</head>
<body>
    <h1>アンケート回答数</h1>
	<table  border="1" width="500" cellspacing="0" cellpadding="5" bordercolor="#333333">
	<tr>
	<th></th>
	<th>上り線</th>
	<th>下り線</th>
	<th>計</th>
	</tr>
	<tr>
	<td>インフォメーション時間内</th>
	<td><?= $cnt_up_open ?></th>
	<td><?= $cnt_dwn_open ?></th>
	<td><?= $sum_open ?></th>
	</tr>
	<tr>
	<td>インフォメーション時間外</th>
	<td><?= $cnt_up_close ?></th>
	<td><?= $cnt_dwn_close ?></th>
	<td><?= $sum_close ?></th>
	</tr>
	<tr>
	<td>計</th>
	<td><?= $sum_up ?></th>
	<td><?= $sum_dwn ?></th>
	<td><?= $sum_all ?></th>
	</tr>
	</table>
</body>
</html>