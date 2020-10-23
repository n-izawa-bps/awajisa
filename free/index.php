<?php

date_default_timezone_set('Asia/Tokyo');

define(
    'HEADER',
    array(
        'gender'            => '性別',
        'age'               => '年齢',
        'address-level1'    => '都道府県',
        'address-level2'    => '市町村',
        'transportation'    => '交通手段',
        'companion'         => '利用人数',
        'smart-ic'          => 'スマートIC利用',
        'purpose2'          => '外出理由',
        'course'            => '訪問先',
        'highway'           => '高速道路利用',
        'reason'            => '高速道路利用理由',
        'sa'                => 'サービスエリア',
        'purpose'           => '目的',
        'shop'              => '店舗',
        'price'             => '金額',
        'place'             => 'お土産場所',
        'timeZone'          => '時間帯',
        'staying-time'      => '滞在時間',
        'oasis'             => 'オアシス利用',
        'purpose3'          => 'オアシス利用目的',
        'facility'          => '利用施設',
        'request'           => '要望',
        'p'                 => 'アクセス元',
        'user_agent'        => 'user-agent',
    )
);

// ランダムな英数字を生成
function createRandomString($length = 4)
{
    $result = "";
    $str = array_merge(range('a', 'z'), range('0', '9'));

    for ($i = 0; $i < $length; $i++) {
        $result .= $str[rand(0, count($str) - 1)];
    }

    return $result;
}

// データを取得
function getCsvData($key)
{
    // 個別処理
    if ($key == "user_agent") {
        return $_SERVER['HTTP_USER_AGENT'] ?? "";
    }

    if ($key == "p") {
        if (!isset($_GET[$key])) {
            return "";
        }

        return $_GET[$key];
    }

    // POSTデータ処理
    if (!isset($_POST[$key])) {
        return "";
    }

    if (is_array($_POST[$key])) {
        $tmp = "\"" . implode(",", $_POST[$key]) . "\"";
        return $tmp;
    }

    return $_POST[$key];
}

function exportCsv($row, $file_option)
{
    $file_path = getcwd() . "/csv/" . $file_option . ".csv";
    $file = fopen($file_path, "w");

    // ヘッダーセット
    $header = array_values(HEADER);
    $header = mb_convert_encoding($header, "UTF-8");
    fputcsv($file, $header);

    // データセット
    $row = mb_convert_encoding($row, "UTF-8");
    fputcsv($file, $row);

    fclose($file);
}

function exportJson($file_option)
{
    $dir_name = getcwd() . "/json/" . date("Ymd") . "/";
    if (!is_dir($dir_name)) {
        mkdir($dir_name, 0777, true);
    }

    $file = fopen($dir_name . $file_option . ".txt", "w");
    fwrite($file, json_encode($_POST, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    fwrite($file, json_encode($_GET, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    fwrite($file, json_encode($_SERVER['HTTP_USER_AGENT'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    fclose($file);
}

if (!empty($_POST)) {
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
    header("location: thanks.php");
}

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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script type="text/javascript" src="sa.js"></script>
</head>

<body>
    <!----- header----->
    <header></header>
    <!----- /header ----->

    <!----- main ----->
    <div class="main_bk">
        <h1 class="p-4">淡路サービスエリアに関する<br>ＷＥＢアンケート</h1>
            <div class="info">
                <p>ご回答いただいた方全員に淡路ＳＡ（上り・下り）インフォメーションにて「○○○○」をプレゼント。<br>
                ※プレゼントはお一人様１回限りとさせていただきます。<br>（アンケートは３分程度で終わります）</p>
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
                                    性別を教えてください。<br><span class="required-box">※必須</span>
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
                                <select name="address-level1" id="address-level2">
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
                                <input type="text" name="address-level2" placeholder="市区町村" maxlength="20">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">5</span>
                                </div>
                                <div class="pr-0 content-text">
                                    当日の交通手段は何ですか。<br><span class="required-box">※必須</span>
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
                                    どなたとご利用でしたか。
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="companion" id="companion">
                                    <option value="">選択してください</option>
                                    <option value="solo">おひとりで</option>
                                    <option value="friend">ご友人と</option>
                                    <option value="lover">恋人と</option>
                                    <option value="family">ご家族と</option>
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
                                    淡路北スマートICをご利用になりましたか。<br><span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="smart-ic" id="smart-ic" onchange="entryChange1();">
                                    <option value="">選択してください</option>
                                    <option value="yes">はい</option>
                                    <option value="no">いいえ</option>
                                </select>
                            </div>  
                        </div>
                        <div class="form-group" id="go-out">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">7-1</span>
                                </div>
                                <div class="pr-0 content-text">
                                    淡路北スマートICをご利用になった外出の主な目的を教えてください。<br><span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="purpose2"  id="purpose2" onchange="entryChange2();">
                                    <option value="">選択してください</option>
                                    <option value="1">淡路島島内の観光</option>
                                    <option value="2">淡路島島外の観光</option>
                                    <option value="3">食事</option>
                                    <option value="4">お買い物</option>
                                    <option value="5">仕事</option>
                                    <option value="6">帰省</option>
                                    <option value="7">その他</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="island">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">7-1-1</span>
                                </div>
                                <div class="pr-0 content-text">
                                    淡路島島内を観光された方にお伺いします。淡路島島内で訪れた場所を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
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
                                            <input type="checkbox" id="course6" name="course[]" value="6" class="right-space">その他
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="awaji-highway">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">7-2</span>
                                </div>
                                <div class="pr-0 content-text">
                                    淡路北スマートICをご利用後、高速道路を利用して本州や四国などの淡路島島外へ向かわれましたか。<br><span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="highway" id="highway">
                                    <option value="">選択してください</option>
                                    <option value="yes">はい</option>
                                    <option value="no">いいえ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="awaji-reason">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">7-3</span>
                                </div>
                                <div class="pr-0 content-text">
                                    その際、淡路北スマートICをご利用になった理由を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <div id="reason">
                                    <div class="py-2">
                                        <label for="reason1">
                                            <input type="checkbox" id="reason1" name="reason[]" value="1" class="right-space">淡路SAに立ち寄るため
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="reason2">
                                            <input type="checkbox" id="reason2" name="reason[]" value="2" class="right-space">淡路ハイウェイオアシスに立ち寄るため
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="reason3">
                                            <input type="checkbox" id="reason3" name="reason[]" value="3" class="right-space">近くのICだったため
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="reason4">
                                            <input type="checkbox" id="reason4" name="reason[]" value="4" class="right-space">その他
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
                                    淡路SA上り・淡路SA下りのどちらにお立ち寄りになりましたか。<br><span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="sa" id="sa">
                                    <option value="">選択してください</option>
                                    <option value="1">淡路SA上りに立ち寄った</option>
                                    <option value="2">淡路SA下りに立ち寄った</option>
                                    <option value="3">両方に立ち寄った</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">9</span>
                                </div>
                                <div class="pr-0 content-text">
                                    何を目的にお立ち寄りになりましたか。<br>（複数回答可）<span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <div id="purpose">
                                    <div class="py-2">
                                        <label for="purpose-1">
                                            <input type="checkbox" id="purpose-1" name="purpose[]" value="1" class="right-space">お土産の購入
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-2">
                                            <input type="checkbox" id="purpose-2" name="purpose[]" value="2" class="right-space">食事
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-3">
                                            <input type="checkbox" id="purpose-3" name="purpose[]" value="3" class="right-space">トイレ
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-4">
                                            <input type="checkbox" id="purpose-4" name="purpose[]" value="4" class="right-space">休憩
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-5">
                                            <input type="checkbox" id="purpose-5" name="purpose[]" value="5" class="right-space">大観覧車
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-6">
                                            <input type="checkbox" id="purpose-6" name="purpose[]" value="6" class="right-space">ドッグラン
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-7">
                                            <input type="checkbox" id="purpose-7" name="purpose[]" value="7" class="right-space">蓄光石
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-8">
                                            <input type="checkbox" id="purpose-8" name="purpose[]" value="8" class="right-space">恋人の聖地
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-9">
                                            <input type="checkbox" id="purpose-9" name="purpose[]" value="9" class="right-space">橋の見える丘ギャラリー
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-10">
                                            <input type="checkbox" id="purpose-10" name="purpose[]" value="10" class="right-space">ベビールームの利用
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-11">
                                            <input type="checkbox" id="purpose-11" name="purpose[]" value="11" class="right-space">観光情報の入手
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose-12">
                                            <input type="checkbox" id="purpose-12" name="purpose[]" value="12" class="right-space">その他
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
                                    ご利用になったお店を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <div id="shop">
                                    <div class="py-2">
                                        <label for="shop1">
                                            <input type="checkbox" id="shop1" name="shop[]" value="1" class="right-space">ロイヤル
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop2">
                                            <input type="checkbox" id="shop2" name="shop[]" value="2" class="right-space">フードコート
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop3">
                                            <input type="checkbox" id="shop3" name="shop[]" value="3" class="right-space">ラーメン尊
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop4">
                                            <input type="checkbox" id="shop4" name="shop[]" value="4" class="right-space">カフェ a-too
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop5">
                                            <input type="checkbox" id="shop5" name="shop[]" value="5" class="right-space">売店
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop6">
                                            <input type="checkbox" id="shop6" name="shop[]" value="6" class="right-space">外売店
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop7">
                                            <input type="checkbox" id="shop7" name="shop[]" value="7" class="right-space">ミスタードーナッツ
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop8">
                                            <input type="checkbox" id="shop8" name="shop[]" value="8" class="right-space">ザ・丼
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop9">
                                            <input type="checkbox" id="shop9" name="shop[]" value="9" class="right-space">神戸ベル
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop10">
                                            <input type="checkbox" id="shop10" name="shop[]" value="10" class="right-space">スターバックス
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="shop11">
                                            <input type="checkbox" id="shop11" name="shop[]" value="11" class="right-space">店舗を利用していない
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">11</span>
                                </div>
                                <div class="pr-0 content-text">
                                    お土産を購入された方にお伺いします。お土産の購入に総額でおいくら程度お使いになりましたか。
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="price" id="price" onchange="entryChange3();">
                                    <option value="">選択してください</option>
                                    <option value="1">1,000円未満</option>
                                    <option value="2">1,000円以上2,000円未満</option>
                                    <option value="3">2,000円以上3,000円未満</option>
                                    <option value="4">3,000円以上</option>
                                    <option value="5">購入していない</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="from-souvenir">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">11-1</span>
                                </div>
                                <div class="pr-0 content-text">
                                    どちらのお土産を買われましたか。
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="place" id="place">
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
                                    <span class="question">12</span>
                                </div>
                                <div class="pr-0 content-text">
                                    立ち寄った時間帯を教えてください。<br><span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="timeZone" id="timeZone">
                                    <option value="">選択してください</option>
                                    <option value="1">午前中</option>
                                    <option value="2">お昼時</option>
                                    <option value="3">午後</option>
                                    <option value="4">夕方</option>
                                    <option value="5">夜</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">13</span>
                                </div>
                                <div class="pr-0 content-text">
                                    およその滞在時間を教えてください。<br><span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="staying-time" id="staying-time">
                                    <option value="">選択してください</option>
                                    <option value="1">10分以内</option>
                                    <option value="2">30分程度</option>
                                    <option value="3">60分未満</option>
                                    <option value="4">60分以上</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">14</span>
                                </div>
                                <div class="pr-0 content-text">
                                    淡路ハイウェイオアシスにはお立ち寄りになりましたか。<br><span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <select name="oasis" id="oasis" onchange="entryChange4();">
                                    <option value="">選択してください</option>
                                    <option value="yes">はい</option>
                                    <option value="no">いいえ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="oasis-purpose">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">14-1</span>
                                </div>
                                <div class="pr-0 content-text">
                                    お立ち寄りになった場合、お立ち寄りの目的を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <div id="purpose3">
                                    <div class="py-2">
                                        <label for="purpose3-1">
                                            <input type="checkbox" id="purpose3-1" name="purpose3[]" value="1" class="right-space">お土産の購入
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose3-2">
                                            <input type="checkbox" id="purpose3-2" name="purpose3[]" value="2" class="right-space">食事
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose3-3">
                                            <input type="checkbox" id="purpose3-3" name="purpose3[]" value="3" class="right-space">休憩
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose3-4">
                                            <input type="checkbox" id="purpose3-4" name="purpose3[]" value="4" class="right-space">観光
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose3-5">
                                            <input type="checkbox" id="purpose3-5" name="purpose3[]" value="5" class="right-space">トイレ
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="purpose3-6">
                                            <input type="checkbox" id="purpose3-6" name="purpose3[]" value="6" class="right-space">その他
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="oasis-facility">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">14-2</span>
                                </div>
                                <div class="pr-0 content-text">
                                    ご利用になった施設を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
                                </div>
                            </div>
                            <div class="input-box">
                                <div id="facility">
                                    <div class="py-2">
                                        <label for="facility1">
                                            <input type="checkbox" id="facility1" name="facility[]" value="1" class="right-space">オアシス館（物産館、フードコート、レストラン）
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="facility2">
                                            <input type="checkbox" id="facility2" name="facility[]" value="2" class="right-space">トレピチ（パスタ＆ピザ）
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="facility3">
                                            <input type="checkbox" id="facility3" name="facility[]" value="3" class="right-space">大富（鯛料理＆洋食）
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="facility4">
                                            <input type="checkbox" id="facility4" name="facility[]" value="4" class="right-space">県立淡路島公園（ニジゲンノモリ）
                                        </label>
                                    </div>
                                    <div class="py-2">
                                        <label for="facility5">
                                            <input type="checkbox" id="facility5" name="facility[]" value="5" class="right-space">利用していない
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-2 title-box">
                                <div class="content-title">
                                    <span class="question">15</span>
                                </div>
                                <div class="pr-0 content-text">
                                    今後、どんな施設やサービスがあれば、淡路SAを訪れたいと思いますか。
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
    </div>
    <!----- /main ----->

    <!----- footer ----->
    <footer></footer>
    <!----- /footer ----->
</body>

</html>