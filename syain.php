<?php
require_once("setting.php");

header( "Content-Type: text/html; charset=utf-8" );

// データベースに接続する
require_once("db_connect.php");
require_once("model.php");

// 所属コンボボックス( エラー時に再度表示するので常に読み込む )
build_combobox( $sqlite );

// **************************
// データ表示処理
// **************************
if ( $_POST["btn"] == "確認" ) {

    // 社員コードで存在チェック
    $row = check( $sqlite );

    // 社員データの内容による画面編集
    edit_after_check( $sqlite, $row );

}

// **************************
// データ更新処理
// **************************
if ( $_POST["btn"] == "更新" ) {

    // 画面入力内容のチェック
    $row = check_entry($sqlite);

    // 更新処理後の編集
    edit_after_check_entry( $sqlite, $row );

}

// プロテクトコントロール
protect_control( $gno );


require_once("syain-view.php");

// debug_print();
