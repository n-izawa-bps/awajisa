<?php
require "function.php";

// 回答判定
if (!isset($_COOKIE['answered'])) {
	header("location: .");
	exit();
}

// 初回表示判定
$first_show = false;
if (!isset($_COOKIE['shown_thanks'])) {
	$first_show = true;
}

// 粗品メッセージ表示状態取得
$is_survey_state = isStartSurvey(date('Y-m-d H:i:s'));
$is_show_present_message = isShowPresentMessage($_GET["p"], date('Y-m-d H:i:s'));

// 粗品配布状態取得
$present_state = trim(file_get_contents(__DIR__ . "/present/" . "present.txt"));

// cokkie
setcookie('shown_thanks', 1, strtotime(date("Y-m-d") . "+1 days"));
?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>淡路サービスエリアに関するＷＥＢアンケート</title>
    <meta name="description" content="淡路サービスエリアに関するＷＥＢアンケート">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script type="text/javascript" src="sa.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EGSLEG16QP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-EGSLEG16QP');
    </script>
</head>

<body onload="checkTransition()">
	<div class="main_bk">
        <p class="mt-3"><img class="img-header" src="./img/jbh4.png" alt="JB本四高速"></p>
		<?php if ($first_show) : ?>
			<div id="first">
				<div class="d-flex justify-content-center align-items-center title">
					<h1 class="p-3">淡路サービスエリア等に関する<br>ＷＥＢアンケート（<?= getPlace($_GET['p']) ?>）</h1>
					<p class="d-block"><img class="img-logo" src="./img/wataru.png" alt="わたる君"></p>
				</div>
				<h1 class="pt-4 title">
					アンケートにご協力いただきありがとうございました。
					<div class="my-3">
						<span id="time" style="font-size: small;"></span>
					</div>
				</h1>

				<?php if ($is_show_present_message && $is_survey_state == NOW && $present_state == "1") : ?>
					<div class="info py-2">
						<p>「コンソメたまねぎ棒（２本セット）」をプレゼントしますので</p>
						<p>この画面をインフォメーションの係員に提示してください。</p>
						<p class="mt-4">この画面を閉じずに提示してください。</p>
					</div>
					<input class="d-block mx-auto" type="button" onclick="reloadToHref()" value="プレゼントを受け取りました。">
				<?php else : ?>
					<div class="info py-2">
						<p>今後とも本四道路のご利用をお願いいたします。</p>
					</div>
					<input class="d-block mx-auto" type="button" onclick="reloadToHref()" value="この画面を閉じる">
				<?php endif; ?>
			</div>
			<div id="second">
				<h1 class="p-4">大変申し訳ございません。<br>本ページの再表示は、行えません。</h1>
			</div>
		<?php else : ?>
			<h1 class="p-4">大変申し訳ありません。<br>本ページの再表示は、行えません。</h1>
		<?php endif; ?>
	</div>
	<div class="mt-5 text-center">
        <a href="./privacy.html" target="_blank" class="privacy">プライバシーポリシーについて</a>
	</div>
</body>

</html>