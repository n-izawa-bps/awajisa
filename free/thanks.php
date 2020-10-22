<?php

date_default_timezone_set ('Asia/Tokyo');

// 翌日のタイムスタンプ取得
function getTomorrowTimeStamp()
{
    return mktime(0, 0, 0, date('n'), date('j')+1, date('Y'));
}

// 回答判定
if (!isset($_COOKIE['answered'])) {
	header("location: .");
}

// 初回表示判定
$first_show = false;
if (!isset($_COOKIE['shown_thanks'])) {
	$first_show = true;
}

// cokkie
setcookie('shown_thanks', 1, strtotime("+1 days"));
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>淡路サービスエリアに関するＷＥＢアンケート</title>
    <meta name="description" content="淡路サービスエリアに関するＷＥＢアンケート">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
	<script type="text/javascript" src="sa.js"></script>
</head>

<body>
	<div class="main_bk">
			<h1 class="p-4">淡路サービスエリアに関する<br>ＷＥＢアンケート</h1>
			<h1 class="pt-4">アンケートにご回答頂きまして、誠にありがとうございます。
			<div class="my-3">
				<span id="time" STYLE="font-size: small;"></span>
			</div></h1>
			<div class="info py-2">
				<p>アンケートにご協力いただいたお礼に粗品を用意しております。</p>
				<p><strong>この画面を閉じずに、</strong>インフォメーションにて係員にご提示ください。</p>
			</div>
			<input type="button" onclick="location.replace('http://www.jb-highway.co.jp/index.php')" value="本画面を閉じる">
	</div>
</body>

</html>