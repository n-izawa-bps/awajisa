<?php
// アンケート開始日程
define('SURVEY_PRE',    '2020-10-31 06:00:00'); // 記入例：2020-10-23 09:00:00
define('SURVEY_START',  '2020-10-31 09:00:00');

// アンケート終了日程
define('SURVEY_END',    '2020-11-24 00:00:00');

// 営業開始時刻
define('UP_OPEN',  "09:00:00");	// 記入例：09:00:00
define('DWN_OPEN', "08:00:00");

// 営業終了時刻
define('UP_CLOSE_WEEKDAYS', "18:00:00");
define('UP_CLOSE_HOLIDAYS', "19:00:00");
define('DWN_CLOSE',		    "17:00:00");

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

// アンケート情報
// 上りSA店名一覧
define(
    'UP_SA_SHOPS',
    array(
        'レストランロイヤル',
        'ラーメン尊',
        'カフェ a-too',
        'フードコート',
        '売店',
        '外売店',
        '自動販売機',
        '店舗は利用していない',
    )
);

// 下りSA店名一覧
define(
    'DWN_SA_SHOPS',
    array(
        'レストランロイヤル',
        '神戸ベル（ベーカリー）',
        'ミスタードーナツ',
        'ザ・丼（丼コーナー）',
        'スターバックスコーヒー',
        'フードコート',
        '売店',
        '外売店',
        '自動販売機',
        '店舗は利用していない',
    )
);

// アンケート表示状態
define('BEFORE', 1);
define('BEFORE_PRE', 2);
define('NOW', 3);
define('AFTER', 4);

// CSV情報
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

// 曜日リスト
define(
    'WEEK',
    array(
        "日",
        "月",
        "火",
        "水",
        "木",
        "金",
        "土",
    )
);
?>