<?php
date_default_timezone_set ('Asia/Tokyo');

// アンケート開始時刻
define('TIME_S_UP',	  "09:00:00");	// 記入例：09:00:00
define('TIME_S_DWN', "08:00:00");

// アンケート終了時刻
define('TIME_E_UP_WEEKDAYS', "18:00:00");
define('TIME_E_UP_HOLIDAYS', "19:00:00");
define('TIME_E_DWN',		 "17:00:00");

// 祝日リスト
define(
	'HOLIDAYS',
	array(
		'2020-11-03',
		'2020-11-23',
		'2021-01-01',
		'2021-01-11',
		'2021-02-11',
		'2021-02-23',
		'2021-03-20',
		'2021-04-29',
		'2021-05-03',
		'2021-05-04',
		'2021-05-05',
	)
);

// アンケート規定回答数
define('REGULATION_CNT', "1000");

// 翌日のタイムスタンプ取得
function getTomorrowTimeStamp()
{
    return mktime(0, 0, 0, date('n'), date('j')+1, date('Y'));
}

function getCntOfCsv()
{
    $dir = './csv/';
    $files = glob($dir . '{*.csv}', GLOB_BRACE);

    if (!$files) {
        return 0;
    }
    return count($files);
}

// 上りSAの終了時間取得
function getEndTimeOfUp($date)
{
	$day = date('Y-m-d', strtotime($date));
	$day_type = date('w', strtotime($date));

	// 祝日判定
	foreach (HOLIDAYS as $holiday) {
		if (strtotime($day) == strtotime($holiday)) {
			return TIME_E_UP_HOLIDAYS;
		}
	}

	// 土日判定
	if ($day_type == 0 || $day_type == 6) {
		return TIME_E_UP_HOLIDAYS;
	}

	// 平日
	return TIME_E_UP_WEEKDAYS;
}

// 営業時間内判定
function isJudgeOpen($time_s, $time_e, $date)
{
	$day = date('Y-m-d', strtotime($date));

	if (strtotime($date) >= strtotime($day . $time_s) && strtotime($date) < strtotime($day . $time_e)) {
		return true;
	}

	return false;
}

// 進呈メッセージ表示判定
function isShowPresentMessage($p, $date)
{
	if ($p == 'up') {
		return isJudgeOpen(TIME_S_UP, getEndTimeOfUp($date), $date);
	}

	if ($p == 'dwn') {
		return isJudgeOpen(TIME_S_DWN, TIME_E_DWN, $date);
	}

	return false;
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

// アンケート回答数取得
$answer_count = getCntOfCsv();

// 粗品メッセージ表示状態取得
$is_show_present_message = isShowPresentMessage($_GET["p"], date('Y-m-d H:i:s'));

// cokkie
setcookie('shown_thanks', 1, strtotime("+1 days"));

// テスト
// echo isShowPresentMessage('up', "2020-11-03 19:00:00");

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
		<?php if ($first_show) : ?>
			<h1 class="p-4">淡路サービスエリアに関する<br>ＷＥＢアンケート</h1>
			<h1 class="pt-4">アンケートにご回答頂きまして、誠にありがとうございます。
			<div class="my-3">
				<span id="time" STYLE="font-size: small;"></span>
			</div></h1>

			<?php if ($is_show_present_message) : ?>
				<div class="info py-2">
					<p>アンケートにご協力いただいたお礼に粗品を用意しております。</p>
					<p><strong>この画面を閉じずに、</strong>インフォメーションにて係員にご提示ください。</p>
				</div>
			<?php endif; ?>

			<input type="button" onclick="location.replace('http://www.jb-highway.co.jp/index.php')" value="本画面を閉じる">
		<?php else : ?>
			<h1 class="p-4">大変申し訳ございません。<br>本ページの再表示は、行えません。</h1>
		<?php endif; ?>
	</div>
</body>

</html>