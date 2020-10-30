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
	[
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
	]
);

// アンケート情報
// 上りSA店名一覧
define(
    'UP_SA_SHOPS',
    [
        'レストランロイヤル',
        'ラーメン尊',
        'カフェ a-too',
        'フードコート',
        '売店',
        '外売店',
        '自動販売機',
        '店舗は利用していない',
    ]
);

// 下りSA店名一覧
define(
    'DWN_SA_SHOPS',
    [
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
    ]
);

// アンケート表示状態
define('BEFORE', 1);
define('BEFORE_PRE', 2);
define('NOW', 3);
define('AFTER', 4);

// CSV情報
define(
    'HEADER',
    [
        'gender'            => '1.性別',
        'age'               => '2.年齢',
        'address-level1'    => '3.都道府県',
        'address-level2'    => '4.市町村',
        'transportation'    => '5.交通手段',
        'companion'         => '6.利用人数',
        'main-purpose'      => '7.主な目的',
        'destination'       => '7-1.目的地',
        'destination-etc'   => '7-1-etc.目的地(その他)',
        'course'            => '7-1-1.訪問先',
        'course-etc'        => '7-1-1-etc.訪問先（その他）',
        'known-smartic'     => '8.ICの開通認識',
        'smartic'           => '9.IC利用',
        'smartic-reason'    => '9-1.IC利用の理由',
        'smartic-reason-etc'=> '9-1-etc.IC利用の理由(その他)',
        'frequency'         => '10.頻度',
        'both'              => '11.IC利用状況',
        'goal'              => '12.SAが目的地',
        'awajisa-purpose'   => '13.SAの利用目的',
        'awajisa-purpose-etc'=> '13-etc.SAの利用目的(その他)',
        'shop'              => '13-1.店舗',
        'price'             => '13-2.金額',
        'from-souvenir'     => '13-3.お土産場所',
        'timezone'          => '14.時間帯',
        'staying-time'      => '15.滞在時間',
        'oasis'             => '16.オアシス利用',
        'oasis-purpose'     => '16-1.オアシス利用目的',
        'oasis-purpose-etc' => '16-1-etc.オアシス利用目的(その他)',
        'facility'          => '16-2.利用施設',
        'request'           => '17.要望',
        'opinion'           => '18.意見',
        'date'              => '日付',
        'time'              => '時間',
        'open'              => '営業時間内',
        'p'                 => 'アクセス元',
        'user_agent'        => 'user-agent',
    ]
);

// 曜日リスト
define(
    'WEEK',
    [
        "日",
        "月",
        "火",
        "水",
        "木",
        "金",
        "土",
    ]
);
?>