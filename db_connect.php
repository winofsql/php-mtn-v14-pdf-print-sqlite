<?php
// ***************************
// 接続
// ***************************
try {
    $sqlite = new PDO( "sqlite:../{$dbname}" );
}
catch ( PDOException $e ) {
    $error["db"] .= $dbname;
    $error["db"] .= " " . $e->getMessage();
}
// 接続以降で try ～ catch を有効にする設定
$sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);