<?php
// ******************************
// PHP 8用
// ******************************
$pv = explode(".", phpversion());
if ($pv[0] + 0 >= 8) {
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
}

// ******************************
// キャッシュ
// ******************************
session_cache_limiter('nocache');
session_start();

// ******************************
// 日本語用
// ******************************
mb_language('Japanese');
mb_internal_encoding('UTF-8');

// データベース
$dbname = "lightbox.sqlite3";
$error["db"] = " ";

// グローバル変数
$gno = 1; // 会話番号
$disabled_type = "disabled";
$disabled_type_text = "readonly style='background-color:lightgray'";

$readonly_1 = "";
$readonly_2 = $disabled_type_text;
$disabled_1 = "";
$disabled_2 = $disabled_type;

$syozoku_option = "";
$focus = "sname";