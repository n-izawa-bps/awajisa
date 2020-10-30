<?php
require "config.php";
date_default_timezone_set('Asia/Tokyo');

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

// CSVデータを取得
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

    if ($key == "date") {
        return date('Y-m-d');
    }

    if ($key == "time") {
        return date('H:i:s');
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

// パラメータから出力フォルダ名を取得
function getOutputName($p, $is_open)
{
    if ($p == "up") {
        if ($is_open) {
            return "up/open";
        }

        return "up/close";
    }

    if ($p == "dwn") {
        if ($is_open) {
            return "dwn/open";
        }

        return "dwn/close";
    }

    return "etc";
}

// CSVファイル出力
function exportCsv($row, $file_option, $is_open)
{
    $file_path = getcwd() . "/out/" . getOutputName($_GET["p"], $is_open) . "/" . $file_option . ".csv";
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

// JSONファイル出力
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

// アンケート表示判定
function isStartSurvey($date)
{
    if (strtotime($date) < strtotime(SURVEY_PRE)) {
        return BEFORE;
    }

    if (strtotime($date) < strtotime(SURVEY_START)) {
        return BEFORE_PRE;
    }

    if (strtotime($date) >= strtotime(SURVEY_END)) {
        return AFTER;
    }

    return NOW;
}

// 場所取得
function getPlace($p)
{
    if ($p == 'up') {
        return "上り線";
    }

    if ($p == 'dwn') {
        return "下り線";
    }

    return "－";
}

// 現在のSAを取得
function getNowSA($p)
{
    if ($p == 'up') {
        return "上り";
    }

    if ($p == 'dwn') {
        return "下り";
    }

    return "";
}

// 現在と反対のSAを取得
function getReverseSA($p)
{
    if ($p == 'up') {
        return "下り";
    }

    if ($p == 'dwn') {
        return "上り";
    }

    return "";
}

// 現在のSAの店名一覧を取得
function getShops($p)
{
    if ($p == 'up') {
        return UP_SA_SHOPS;
    }

    if ($p == 'dwn') {
        return DWN_SA_SHOPS;
    }

    return array();
}

// 上りSAの終了時間取得
function getEndTimeOfUp($date)
{
	$day = date('Y-m-d', strtotime($date));
	$day_type = date('w', strtotime($date));

	// 祝日判定
	foreach (HOLIDAYS as $holiday) {
		if (strtotime($day) == strtotime($holiday)) {
			return UP_CLOSE_HOLIDAYS;
		}
	}

	// 土日判定
	if ($day_type == 0 || $day_type == 6) {
		return UP_CLOSE_HOLIDAYS;
	}

	// 平日
	return UP_CLOSE_WEEKDAYS;
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
		return isJudgeOpen(UP_OPEN, getEndTimeOfUp($date), $date);
	}

	if ($p == 'dwn') {
		return isJudgeOpen(DWN_OPEN, DWN_CLOSE, $date);
	}

	return false;
}
?>