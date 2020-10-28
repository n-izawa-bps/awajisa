<?php
require "function.php";


// アンケート出力
if (!empty($_POST) && !$_COOKIE['answered']) {
    // データ作成
    $header_keys = array_keys(HEADER);
    $data = array_map('getCsvData', $header_keys);

    $file_option = date('YmdHis') . createRandomString(4);

    // CSV出力
    exportCsv($data, $file_option);

    // Json出力（予備）
    exportJson($file_option);

    // cokkie
    setcookie('shown_thanks', '');
    setcookie('answered', 1, strtotime("+1 days"));

    // ページ遷移
    if ($_GET["p"] == "up" || $_GET["p"] == "dwn") {
        header("location: thanks.php?p=" . $_GET["p"]);
    } else {
        header("location: thanks.php");
    }
}

// アンケート表示状態取得
$is_show_state = isShowQuestion($_GET['p'], date('Y-m-d H:i:s'));
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>淡路サービスエリア等に関するＷＥＢアンケート</title>
    <meta name="description" content="淡路サービスエリアに関するＷＥＢアンケート">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script type="text/javascript" src="sa.js"></script>
</head>

<body>
    <!----- header----->
    <header></header>
    <!----- /header ----->

    <!----- main ----->
    <div class="main_bk">
        <h1 class="p-3">淡路サービスエリア等に関する<br>ＷＥＢアンケート（<?php echo getPlace($_GET['p']) ?>）</h1>
        <?php if ($is_show_state == BEFORE) : ?>
            <div class="info">
                <p class="my-2"><?php echo date('Y年m月d日 H時', strtotime(getStartTime($_GET['p']))) ?>よりアンケート開始</p>
            </div>
        <?php elseif ($is_show_state == AFTER) : ?>
            <div class="info">
                <p class="my-2">アンケート終了しました。ご協力ありがとうございました。</p>
            </div>
        <?php else : ?>
            <?php if (isset($_COOKIE['answered'])) : ?>
                <div class="info">
                    <p class="my-2">アンケートの回答にご協力いただき、ありがとうございます。<br>
                    本アンケートは、お一人様１回限りとなっております。</p>
                </div>
            <?php else : ?>
                <div class="info">
                    <p>
                        アンケート完了画面をインフォメーションにてご提示いただいた方に淡路SA（上り・下り）インフォメーションにて「コンソメたまねぎ棒（２本セット）」をプレゼント。<br>
                        ※プレゼントのお渡しはインフォメーション営業時間中のみで、お一人様１回限りとさせていただきます。<br>
                        （アンケートは３分程度で終わります）
                    </p>
                </div>
                <div class="container_bk">
                    <form name="questionnaire_form" id="questionnaire_form" method="POST">
                        <div class="box">
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">1</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        性別を教えてください。
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="gender" id="gender">
                                        <option value="">選択してください</option>
                                        <option value="man">男性</option>
                                        <option value="woman">女性</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">2</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        年齢を教えてください。<br><span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="age" id="age">
                                        <option value="">選択してください</option>
                                        <option value="10">10代以下</option>
                                        <option value="20">20代</option>
                                        <option value="30">30代</option>
                                        <option value="40">40代</option>
                                        <option value="50">50代</option>
                                        <option value="60">60代</option>
                                        <option value="70">70代以上</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">3</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        お住まいのエリアを教えてください。<br><span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="address_bk">
                                    <select name="address-level1" id="address-level1">
                                    <option value="" selected>選択してください</option>
                                    <optgroup label="関西">
                                        <option value="滋賀県">滋賀県</option>
                                        <option value="京都府">京都府</option>
                                        <option value="大阪府">大阪府</option>
                                        <option value="兵庫県">兵庫県</option>
                                        <option value="奈良県">奈良県</option>
                                        <option value="和歌山県">和歌山県</option>
                                    </optgroup>
                                    <optgroup label="中国">
                                        <option value="鳥取県">鳥取県</option>
                                        <option value="島根県">島根県</option>
                                        <option value="岡山県">岡山県</option>
                                        <option value="広島県">広島県</option>
                                        <option value="山口県">山口県</option>
                                    </optgroup>
                                    <optgroup label="四国">
                                        <option value="徳島県">徳島県</option>
                                        <option value="香川県">香川県</option>
                                        <option value="愛媛県">愛媛県</option>
                                        <option value="高知県">高知県</option>
                                    </optgroup>
                                    <optgroup label="北海道・東北">
                                        <option value="北海道">北海道</option>
                                        <option value="青森県">青森県</option>
                                        <option value="岩手県">岩手県</option>
                                        <option value="宮城県">宮城県</option>
                                        <option value="秋田県">秋田県</option>
                                        <option value="山形県">山形県</option>
                                        <option value="福島県">福島県</option>
                                    </optgroup>
                                    <optgroup label="関東">
                                        <option value="茨城県">茨城県</option>
                                        <option value="栃木県">栃木県</option>
                                        <option value="群馬県">群馬県</option>
                                        <option value="埼玉県">埼玉県</option>
                                        <option value="千葉県">千葉県</option>
                                        <option value="東京都">東京都</option>
                                        <option value="神奈川県">神奈川県</option>
                                    </optgroup>
                                    <optgroup label="甲信越・北陸">
                                        <option value="新潟県">新潟県</option>
                                        <option value="富山県">富山県</option>
                                        <option value="石川県">石川県</option>
                                        <option value="福井県">福井県</option>
                                        <option value="山梨県">山梨県</option>
                                        <option value="長野県">長野県</option>
                                    </optgroup>
                                    <optgroup label="東海">
                                        <option value="岐阜県">岐阜県</option>
                                        <option value="静岡県">静岡県</option>
                                        <option value="愛知県">愛知県</option>
                                        <option value="三重県">三重県</option>
                                    </optgroup>
                                    <optgroup label="九州・沖縄">
                                        <option value="福岡県">福岡県</option>
                                        <option value="佐賀県">佐賀県</option>
                                        <option value="長崎県">長崎県</option>
                                        <option value="熊本県">熊本県</option>
                                        <option value="大分県">大分県</option>
                                        <option value="宮崎県">宮崎県</option>
                                        <option value="鹿児島県">鹿児島県</option>
                                        <option value="沖縄県">沖縄県</option>
                                    </optgroup>
                                    <optgroup label="その他">
                                        <option value="海外">海外</option>
                                        <option value="その他">その他</option>
                                    </optgroup>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">4</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        お住まいの市町村を教えてください。
                                    </div>
                                </div>
                                <div class="input-box">
                                    <input type="text" name="address-level2" placeholder="市町村" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">5</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        本日の交通手段は何ですか。<br><span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="transportation" id="transportation">
                                        <option value="">選択してください</option>
                                        <option value="bicycle">自動車</option>
                                        <option value="bike">バイク</option>
                                        <option value="bus">観光バス</option>
                                        <option value="other">その他</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">6</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        どなたとご利用ですか。
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="companion" id="companion">
                                        <option value="">選択してください</option>
                                        <option value="solo">おひとりで</option>
                                        <option value="family">ご家族と</option>
                                        <option value="friend">ご友人と</option>
                                        <option value="lover">恋人と</option>
                                        <option value="other">その他</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">7</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        本日の外出の主な目的を教えてください。<br><span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="main-purpose" id="main-purpose" onchange="entryChangeMainPurpose();">
                                        <option value="">選択してください</option>
                                        <option value="1">観光</option>
                                        <option value="2">帰省</option>
                                        <option value="3">お仕事</option>
                                        <option value="4">お買い物</option>
                                        <option value="5">お食事</option>
                                        <option value="6">通院</option>
                                        <option value="7">その他</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="q-destination">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">7-1</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        観光の主な目的地をおしえてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <div id="destination">
                                        <div class="py-2">
                                            <label for="destination1">
                                                <input type="checkbox" id="destination1" name="destination[]" value="1" class="right-space" onchange="entryChangeDestination();">淡路島
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="destination2">
                                                <input type="checkbox" id="destination2" name="destination[]" value="2" class="right-space">関西地方
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="destination3">
                                                <input type="checkbox" id="destination3" name="destination[]" value="3" class="right-space">四国地方
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="destination4">
                                                <input type="checkbox" id="destination4" name="destination[]" value="4" class="right-space">その他の地方
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="q-course">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">7-1-1</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        淡路島島内で訪れる予定または訪れた場所を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <div id="course">
                                        <div class="py-2">
                                            <label for="course1">
                                                <input type="checkbox" id="course1" name="course[]" value="1" class="right-space">県立淡路島公園（ニジゲンノモリ）
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="course2">
                                                <input type="checkbox" id="course2" name="course[]" value="2" class="right-space">淡路夢舞台
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="course3">
                                                <input type="checkbox" id="course3" name="course[]" value="3" class="right-space">淡路島国営明石海峡公園
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="course4">
                                                <input type="checkbox" id="course4" name="course[]" value="4" class="right-space">あわじ花さじき
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="course5">
                                                <input type="checkbox" id="course5" name="course[]" value="5" class="right-space">道の駅あわじ
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="course6">
                                                <input type="checkbox" id="course6" name="course[]" value="6" class="right-space">道の駅うずしお
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="course7">
                                                <input type="checkbox" id="course7" name="course[]" value="7" class="right-space">イングランドの丘
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="course8">
                                                <input type="checkbox" id="course8" name="course[]" value="8" class="right-space">その他
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">8</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        本年３月に淡路北スマートインターチェンジが開通したのはご存じでしたか。<br><span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="known-smartic" id="known-smartic">
                                        <option value="">選択してください</option>
                                        <option value="yes">はい</option>
                                        <option value="no">いいえ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">9</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        本日、淡路SAをご利用になる際、淡路北スマートインターチェンジをご利用になりましたか。<br><span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="smartic" id="smartic" onchange="entryChangeSmartic();">
                                        <option value="">選択してください</option>
                                        <option value="yes">はい</option>
                                        <option value="no">いいえ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="q-smartic-reason">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">9-1</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        淡路北スマートインターチェンジをご利用になった理由を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <div id="smartic-reason">
                                        <div class="py-2">
                                            <label for="smartic-reason1">
                                                <input type="checkbox" id="smartic-reason1" name="smartic-reason[]" value="1" class="right-space">淡路SAを利用するため
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="smartic-reason2">
                                                <input type="checkbox" id="smartic-reason2" name="smartic-reason[]" value="2" class="right-space">淡路ハイウェイオアシスを利用するため
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="smartic-reason3">
                                                <input type="checkbox" id="smartic-reason3" name="smartic-reason[]" value="3" class="right-space">最寄りのインターチェンジだったため
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="smartic-reason4">
                                                <input type="checkbox" id="reason4" name="reason[]" value="4" class="right-space">その他
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">10</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        淡路SAのご利用は何度目ですか。
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="frequency" id="frequency">
                                        <option value="">選択してください</option>
                                        <option value="1">はじめて</option>
                                        <option value="2">ときどき</option>
                                        <option value="3">よく利用している</option>
                                    </select>
                                </div>
                            </div>
                            <?php if($_GET['p'] == "up" || $_GET['p'] == "dwn"): ?>
                                <div class="form-group">
                                    <div class="mb-2 title-box">
                                        <div class="content-title">
                                            <span class="question">11</span>
                                        </div>
                                        <div class="pr-0 content-text">
                                            現在いらっしゃるのは淡路SA<?php echo getNowSA($_GET['p']) ?>です。<?php echo getReverseSA($_GET['p']) ?>SAはご利用になりましたか、またはこれからご利用ですか。
                                        </div>
                                    </div>
                                    <div class="input-box">
                                        <select name="both" id="both">
                                            <option value="">選択してください</option>
                                            <option value="1"><?php echo getReverseSA($_GET['p']) ?>SAを利用した（利用予定）</option>
                                            <option value="2">両方のSAを行き来した</option>
                                            <option value="3"><?php echo getReverseSA($_GET['p']) ?>SAは利用しない</option>
                                        </select>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">12</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        淡路SA・淡路ハイウェイオアシスは今回の外出の目的地でしたか。
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="goal" id="goal">
                                        <option value="">選択してください</option>
                                        <option value="1">目的地だった</option>
                                        <option value="2">目的地への途中で利用予定だった</option>
                                        <option value="3">たまたま立ち寄った</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">13</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        淡路SAをご利用になった目的をおしえてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <div id="awajisa-purpose">
                                        <div class="py-2">
                                            <label for="awajisa-purpose1">
                                                <input type="checkbox" id="awajisa-purpose1" name="awajisa-purpose[]" value="1" class="right-space" onchange="entryChangeAwajisaPurpose();">お土産の購入
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose2">
                                                <input type="checkbox" id="awajisa-purpose2" name="awajisa-purpose[]" value="2" class="right-space" onchange="entryChangeAwajisaPurpose();">食事
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose3">
                                                <input type="checkbox" id="awajisa-purpose3" name="awajisa-purpose[]" value="3" class="right-space">トイレ
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose4">
                                                <input type="checkbox" id="awajisa-purpose4" name="awajisa-purpose[]" value="4" class="right-space">休憩
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose5">
                                                <input type="checkbox" id="awajisa-purpose5" name="awajisa-purpose[]" value="5" class="right-space">ガソリンスタンド
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose6">
                                                <input type="checkbox" id="awajisa-purpose6" name="awajisa-purpose[]" value="6" class="right-space">展望台
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose7">
                                                <input type="checkbox" id="awajisa-purpose7" name="awajisa-purpose[]" value="7" class="right-space">大観覧車
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose8">
                                                <input type="checkbox" id="awajisa-purpose8" name="awajisa-purpose[]" value="8" class="right-space">ドッグラン
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose9">
                                                <input type="checkbox" id="awajisa-purpose9" name="awajisa-purpose[]" value="9" class="right-space">夜景・イルミネーション
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose10">
                                                <input type="checkbox" id="awajisa-purpose10" name="awajisa-purpose[]" value="10" class="right-space">恋人の聖地
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose11">
                                                <input type="checkbox" id="awajisa-purpose11" name="awajisa-purpose[]" value="11" class="right-space">橋の見える丘ギャラリー
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose12">
                                                <input type="checkbox" id="awajisa-purpose12" name="awajisa-purpose[]" value="12" class="right-space">ベビールームの利用
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose13">
                                                <input type="checkbox" id="awajisa-purpose13" name="awajisa-purpose[]" value="13" class="right-space">観光情報の入手
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="awajisa-purpose14">
                                                <input type="checkbox" id="awajisa-purpose14" name="awajisa-purpose[]" value="14" class="right-space">その他
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($_GET['p'] == "up" || $_GET['p'] == "dwn"): ?>
                                <div class="form-group" id="q-shop">
                                    <div class="mb-2 title-box">
                                        <div class="content-title">
                                            <span class="question">13-1</span>
                                        </div>
                                        <div class="pr-0 content-text">
                                            ご利用になったお店を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                        </div>
                                    </div>
                                    <div class="input-box">
                                        <div id="shop">
                                            <? foreach(getShops($_GET['p']) as $key => $shop) : ?>
                                                <div class="py-2">
                                                    <label for="shop<?php echo $key + 1 ?>">
                                                        <input type="checkbox" id="shop<?php echo $key + 1 ?>" name="shop[]" value="<?php echo $key + 1 ?>" class="right-space"><?php echo $shop ?>
                                                    </label>
                                                </div>
                                            <? endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group" id="q-price">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">13-2</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        お土産の購入に総額でおいくらぐらいお使いになりますか。
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="price" id="price" onchange="entryChange3();">
                                        <option value="">選択してください</option>
                                        <option value="1">1,000円未満</option>
                                        <option value="2">1,000円以上2,000円未満</option>
                                        <option value="3">2,000円以上3,000円未満</option>
                                        <option value="4">3,000円以上</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="q-from-souvenir">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">13-3</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        どちらの地域のお土産を買われますか。
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="from-souvenir" id="from-souvenir">
                                        <option value="">選択してください</option>
                                        <option value="1">淡路</option>
                                        <option value="2">神戸</option>
                                        <option value="3">大阪</option>
                                        <option value="4">京都</option>
                                        <option value="5">四国</option>
                                        <option value="6">その他</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">14</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        淡路SAをご利用になった時間帯を教えてください。<br><span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="timezone" id="timezone">
                                        <option value="">選択してください</option>
                                        <option value="1">6時～11時</option>
                                        <option value="2">11時～13時</option>
                                        <option value="3">13時～17時</option>
                                        <option value="4">17時～21時</option>
                                        <option value="5">それ以外</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">15</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        およその滞在時間を教えてください。<br><span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="staying-time" id="staying-time">
                                        <option value="">選択してください</option>
                                        <option value="1">30分以内</option>
                                        <option value="2">30分～60分以内</option>
                                        <option value="3">60分～120分以内</option>
                                        <option value="4">120分以上</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">16</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        淡路ハイウェイオアシスはご利用になりましたか。または、このあとご利用になる予定がありますか。<br><span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <select name="oasis" id="oasis" onchange="entryChangeOasis();">
                                        <option value="">選択してください</option>
                                        <option value="yes">はい</option>
                                        <option value="no">いいえ</option>
                                        <option value="dunno">淡路SAと淡路ハイウェイオアシスの違いがわからない</option>
                                        <optgroup label=""></optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="q-oasis-purpose">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">16-1</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        ご利用の目的を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <div id="oasis-purpose">
                                        <div class="py-2">
                                            <label for="oasis-purpose1">
                                                <input type="checkbox" id="oasis-purpose1" name="oasis-purpose[]" value="1" class="right-space">お土産の購入
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="oasis-purpose2">
                                                <input type="checkbox" id="oasis-purpose2" name="oasis-purpose[]" value="2" class="right-space">食事
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="oasis-purpose3">
                                                <input type="checkbox" id="oasis-purpose3" name="oasis-purpose[]" value="3" class="right-space">休憩
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="oasis-purpose4">
                                                <input type="checkbox" id="oasis-purpose4" name="oasis-purpose[]" value="4" class="right-space">観光
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="oasis-purpose5">
                                                <input type="checkbox" id="oasis-purpose5" name="oasis-purpose[]" value="5" class="right-space">トイレ
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="oasis-purpose6">
                                                <input type="checkbox" id="oasis-purpose6" name="oasis-purpose[]" value="6" class="right-space">その他
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">17</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        淡路ハイウェイオアシスでご利用になった、またはご利用予定の施設を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <div id="facility">
                                        <div class="py-2">
                                            <label for="facility1">
                                                <input type="checkbox" id="facility1" name="facility[]" value="1" class="right-space">淡路物産館（お土産）
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="facility2">
                                                <input type="checkbox" id="facility2" name="facility[]" value="2" class="right-space">CafeOasis（カフェ）
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="facility3">
                                                <input type="checkbox" id="facility3" name="facility[]" value="3" class="right-space">おあしすキッチン（フードコート）
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="facility4">
                                                <input type="checkbox" id="facility4" name="facility[]" value="4" class="right-space">みけ家（レストラン）
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="facility5">
                                                <input type="checkbox" id="facility5" name="facility[]" value="5" class="right-space">すし富（鮨処）
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="facility6">
                                                <input type="checkbox" id="facility6" name="facility[]" value="6" class="right-space">トレピチ（パスタ＆ピザ）
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="facility7">
                                                <input type="checkbox" id="facility7" name="facility[]" value="7" class="right-space">大富（鯛料理）
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="facility8">
                                                <input type="checkbox" id="facility8" name="facility[]" value="8" class="right-space">県立淡路島公園（ニジゲンノモリ）
                                            </label>
                                        </div>
                                        <div class="py-2">
                                            <label for="facility9">
                                                <input type="checkbox" id="facility9" name="facility[]" value="9" class="right-space">利用なし
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">18</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        今後、どんな施設やサービス、商品・メニューがあれば、また淡路SAを訪れたいと思いますか。
                                    </div>
                                </div>
                                <div class="input-box">
                                    <textarea name="request" maxlength="400" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-2 title-box">
                                    <div class="content-title">
                                        <span class="question">19</span>
                                    </div>
                                    <div class="pr-0 content-text">
                                        その他、ご意見・ご感想等がありましたらお聞かせください。
                                    </div>
                                </div>
                                <div class="input-box">
                                    <textarea name="request" maxlength="400" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" value="送信" class="btn btn-info w-50" onclick="return check();">
                            </div>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <!----- /main ----->

    <!----- footer ----->
    <footer></footer>
    <!----- /footer ----->
</body>

</html>