<?php
// アンケート開始日程
define('START_UP',   '2020-10-31 09:00:00');  // 記入例：2020-10-23 09:00:00
define('START_DOWN', '2020-10-31 08:00:00');
define('START_ETC',  '2020-10-31 08:00:00');

// アンケート終了日程
define('END_UP',   '2020-11-23 19:00:00');
define('END_DOWN', '2020-11-23 17:00:00');
define('END_ETC',  '2020-11-23 19:00:00');

// アンケート表示状態
define('BEFORE', 1);
define('NOW', 2);
define('AFTER', 3);

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

// 営業開始時刻
define('TIME_S_UP',  "09:00:00");	// 記入例：09:00:00
define('TIME_S_DWN', "08:00:00");

// 営業終了時刻
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
?>