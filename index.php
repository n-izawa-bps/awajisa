<?php

date_default_timezone_set ('Asia/Tokyo');

define('HEADER',
    array(
        'gender' => '性別',
        'age'    => '年齢'
    )
);

function createRandomString($length){
    $str = array_merge(range('a', 'z'), range('0', '9'));

    for ($i = 0; $i < $length; $i++) {
        $result .= $str[rand(0, count($str)-1)];
    }

    return $result;
}

// データ作成


// csv準備
$file_path = getcwd() . "/csv/" . date('YmdHis') . createRandomString(4) . ".csv";
if (!file_exists($file_path)) {
    touch($file_path);
}
$file = fopen($file_path, "w");

// ヘッダーセット
$header = array_values(HEADER);
$header = mb_convert_encoding($header, "SJIS-WIN", "UTF-8");
fputcsv($file, $header);

// データセット
$data = [];
fputcsv($file, $data);

fclose($file);

// ページ遷移

if(isset($_POST['gender'])) {
    $gender = $_POST['gender'];
    echo HEADER['gender'] . ":" . $gender;
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
	<script type="text/javascript" src="sa.js"></script>
</head>

<body>



    <!----- header----->
    <header></header>
    <!----- /header ----->

    <!----- main ----->
    <div class="main_bk">
        <h1>淡路サービスエリアに関する<br>ＷＥＢアンケート</h1>
        <div class="info">
			<p>ご回答いただいた方全員に淡路ＳＡ（上り・下り）インフォメーションにて「○○○○」をプレゼント。<br>
			※プレゼントはお一人様１回限りとさせていただきます。<br>（アンケートは３分程度で終わります）</p>
		</div>
        <div class="container_bk">
            <form name="questionnaire_form" id="questionnaire_form" method="POST">
                <div class="box">
					<div class="form-group">
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">1</span>
							</div>
							<div class="col-11 pr-0">
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
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">2</span>
							</div>
							<div class="col-11 pr-0">
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
                    	<div class="row mb-2 title-box">
							<div class="col-1 content-title">
							    <span class="question">3</span>
							</div>
							<div class="col-11 pr-0">
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
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">4</span>
							</div>
							<div class="col-11 pr-0">
							    お住まいの市町村を教えてください。
							</div>
						</div>
                        <div class="input-box">
                            <input type="text" name="address-level2" placeholder="市区町村">
                        </div>
                    </div>
					<div class="form-group">
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">5</span>
							</div>
							<div class="col-11 pr-0">
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
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">6</span>
							</div>
							<div class="col-11 pr-0">
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
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">7</span>
							</div>
							<div class="col-11 pr-0">
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
                    <div class="form-group" id="purpose">
                    	<div class="row mb-2 title-box">
							<div class="col-2  content-title">
							    <span class="question">7-1</span>
							</div>
							<div class="col-10 p-0">
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
                    	<div class="row mb-2 pl-1 title-box">
							<div class="col-2  content-title">
							    <span class="question">7-1-1</span>
							</div>
							<div class="col-10 p-0">
							    淡路島島内を観光された方にお伺いします。淡路島島内で訪れた場所を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
							</div>
						</div>
                        <div class="input-box">
                            <p>
								<input type="checkbox" name="course[]" value="1" class="right-space">県立淡路島公園（ニジゲンノモリ）<br>
								<input type="checkbox" name="course[]" value="2" class="right-space">淡路夢舞台<br>
								<input type="checkbox" name="course[]" value="3" class="right-space">淡路島国営明石海峡公園<br>
								<input type="checkbox" name="course[]" value="4" class="right-space">あわじ花さじき<br>
								<input type="checkbox" name="course[]" value="5" class="right-space">道の駅あわじ<br>
								<input type="checkbox" name="course[]" value="6" class="right-space">その他
                            </p>
                        </div>
                    </div>
					<div class="form-group" id="highway">
                    	<div class="row mb-2 title-box">
							<div class="col-2  content-title">
							    <span class="question">7-2</span>
							</div>
							<div class="col-10 p-0">
							    淡路北スマートICをご利用後、高速道路を利用して本州や四国などの淡路島島外へ向かわれましたか。<br><span class="required-box">※必須</span>
							</div>
						</div>
                        <div class="input-box">
                            <select name="highway">
                                <option value="">選択してください</option>
                                <option value="yes">はい</option>
                                <option value="no">いいえ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="reason">
                    	<div class="row mb-2 title-box">
							<div class="col-2  content-title">
							    <span class="question">7-3</span>
							</div>
							<div class="col-10 p-0">
							    その際、淡路北スマートICをご利用になった理由を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
							</div>
						</div>
                        <div class="input-box">
                            <p>
								<input type="checkbox" name="reason[]" value="1" class="right-space">淡路SAに立ち寄るため<br>
								<input type="checkbox" name="reason[]" value="2" class="right-space">淡路ハイウェイオアシスに立ち寄るため<br>
								<input type="checkbox" name="reason[]" value="3" class="right-space">近くのICだったため<br>
								<input type="checkbox" name="reason[]" value="4" class="right-space">その他
                            </p>
                        </div>
                    </div>
					<div class="form-group">
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">8</span>
							</div>
							<div class="col-11 pr-0">
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
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">9</span>
							</div>
							<div class="col-11 pr-0">
							    何を目的にお立ち寄りになりましたか。<br>（複数回答可）<span class="required-box">※必須</span>
							</div>
						</div>
                        <div class="input-box">
                            <p>
								<input type="checkbox" name="purpose[]" value="1" class="right-space">お土産の購入<br>
								<input type="checkbox" name="purpose[]" value="2" class="right-space">食事<br>
								<input type="checkbox" name="purpose[]" value="3" class="right-space">トイレ<br>
								<input type="checkbox" name="purpose[]" value="4" class="right-space">休憩<br>
								<input type="checkbox" name="purpose[]" value="5" class="right-space">大観覧車<br>
								<input type="checkbox" name="purpose[]" value="6" class="right-space">ドッグラン<br>
								<input type="checkbox" name="purpose[]" value="7" class="right-space">蓄光石<br>
								<input type="checkbox" name="purpose[]" value="8" class="right-space">恋人の聖地<br>
								<input type="checkbox" name="purpose[]" value="9" class="right-space">橋の見える丘ギャラリー<br>
								<input type="checkbox" name="purpose[]" value="10" class="right-space">ベビールームの利用<br>
								<input type="checkbox" name="purpose[]" value="11" class="right-space">観光情報の入手<br>
								<input type="checkbox" name="purpose[]" value="12" class="right-space">その他
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">10</span>
							</div>
							<div class="col-11 pr-0">
							    ご利用になったお店を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
							</div>
						</div>
                        <div class="input-box">
                            <p>
								<input type="checkbox" name="shop[]" value="1" class="right-space">ロイヤル<br>
								<input type="checkbox" name="shop[]" value="2" class="right-space">フードコート<br>
								<input type="checkbox" name="shop[]" value="3" class="right-space">ラーメン尊<br>
								<input type="checkbox" name="shop[]" value="4" class="right-space">カフェ a-too<br>
								<input type="checkbox" name="shop[]" value="5" class="right-space">売店<br>
								<input type="checkbox" name="shop[]" value="6" class="right-space">外売店<br>
								<input type="checkbox" name="shop[]" value="7" class="right-space">ミスタードーナッツ<br>
								<input type="checkbox" name="shop[]" value="8" class="right-space">ザ・丼<br>
								<input type="checkbox" name="shop[]" value="9" class="right-space">神戸ベル<br>
								<input type="checkbox" name="shop[]" value="10" class="right-space">スターバックス<br>
								<input type="checkbox" name="shop[]" value="11" class="right-space">店舗は利用していない
                            </p>
                        </div>
                    </div>
					<div class="form-group">
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">11</span>
							</div>
							<div class="col-11 pr-0">
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
                    <div class="form-group" id="place">
                    	<div class="row mb-2 title-box">
							<div class="col-2  content-title">
							    <span class="question">11-1</span>
							</div>
							<div class="col-10 p-0">
							    どちらのお土産を買われましたか。
							</div>
						</div>
                        <div class="input-box">
                            <select name="place">
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
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">12</span>
							</div>
							<div class="col-11 pr-0">
							    立ち寄った時間帯を教えてください。<br><span class="required-box">※必須</span>
							</div>
						</div>
                        <div class="input-box">
                            <select name="timeZone" id="timeZzone">
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
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">13</span>
							</div>
							<div class="col-11 pr-0">
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
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">14</span>
							</div>
							<div class="col-11 pr-0">
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
                    <div class="form-group" id="purpose3">
                    	<div class="row mb-2 title-box">
							<div class="col-2  content-title">
							    <span class="question">14-1</span>
							</div>
							<div class="col-10 p-0">
							    お立ち寄りになった場合、お立ち寄りの目的を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
							</div>
						</div>
                        <div class="input-box">
                            <p>
								<input type="checkbox" name="purpose3[]" value="1" class="right-space">お土産の購入<br>
								<input type="checkbox" name="purpose3[]" value="2" class="right-space">食事<br>
								<input type="checkbox" name="purpose3[]" value="3" class="right-space">休憩<br>
								<input type="checkbox" name="purpose3[]" value="4" class="right-space">観光<br>
								<input type="checkbox" name="purpose3[]" value="5" class="right-space">トイレ<br>
								<input type="checkbox" name="purpose3[]" value="6" class="right-space">その他
                            </p>
                        </div>
                    </div>
                    <div class="form-group" id="facility">
                    	<div class="row mb-2 title-box">
							<div class="col-2  content-title">
							    <span class="question">14-2</span>
							</div>
							<div class="col-10 p-0">
							    ご利用になった施設を教えてください。<br>（複数回答可）<span class="required-box">※必須</span>
							</div>
						</div>
                        <div class="input-box">
                            <p>
								<input type="checkbox" name="facility[]" value="1" class="right-space">オアシス館（物産館、フードコート、レストラン）<br>
								<input type="checkbox" name="facility[]" value="2" class="right-space">トレピチ（パスタ＆ピザ）<br>
								<input type="checkbox" name="facility[]" value="3" class="right-space">大富（鯛料理＆洋食）<br>
								<input type="checkbox" name="facility[]" value="4" class="right-space">県立淡路島公園（ニジゲンノモリ）<br>
								<input type="checkbox" name="facility[]" value="5" class="right-space">利用していない
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="row mb-2 title-box">
							<div class="col-1  content-title">
							    <span class="question">15</span>
							</div>
							<div class="col-11 pr-0">
							    今後、どんな施設やサービスがあれば、淡路SAを訪れたいと思いますか。
							</div>
						</div>
                        <div class="input-box">
                            <textarea name="request"></textarea>
                        </div>
                    </div>
                    <div class="form-group text-center">
						<input type="submit" value="送信" class="btn btn-info w-50">
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