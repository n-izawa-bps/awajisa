<?php
require "function.php";

// 回答判定
if (!isset($_COOKIE['answered'])) {
	header("location: .");
}

// 初回表示判定
$first_show = false;
if (!isset($_COOKIE['shown_thanks'])) {
	$first_show = true;
}

// 粗品メッセージ表示状態取得
$is_survey_state = isStartSurvey(date('Y-m-d H:i:s'));
$is_show_present_message = isShowPresentMessage($_GET["p"], date('Y-m-d H:i:s'));

// cokkie
setcookie('shown_thanks', 1, strtotime(date("Y-m-d") . "+1 days"));
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
			<h1 class="pt-4">
				アンケートにご協力いただきありがとうございました。
				<div class="my-3">
					<span id="time" style="font-size: small;"></span>
				</div>
			</h1>

			<?php if ($is_show_present_message && $is_survey_state == NOW) : ?>
				<div class="info py-2">
					<p>「コンソメたまねぎ棒（２本セット）」をプレゼントしますので</p>
					<p>この画面をインフォメーションの係員に提示してください。</p>
					<p class="mt-4">この画面を閉じずに提示してください。</p>
				</div>
				<input class="d-block mx-auto" type="button" onclick="location.replace('http://www.jb-highway.co.jp/index.php')" value="プレゼントを受け取りました。">
			<?php else : ?>
				<div class="info py-2">
					<p>今後とも本四道路のご利用をお願いいたします。</p>
				</div>
				<input class="d-block mx-auto" type="button" onclick="location.replace('http://www.jb-highway.co.jp/index.php')" value="この画面を閉じる">
			<?php endif; ?>

		<?php else : ?>
			<h1 class="p-4">大変申し訳ございません。<br>本ページの再表示は、行えません。</h1>
		<?php endif; ?>
	</div>
</body>

</html>