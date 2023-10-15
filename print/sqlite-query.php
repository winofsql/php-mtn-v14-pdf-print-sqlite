<?php
require_once("../setting.php");
$dbname = "../{$dbname}";
require_once("../db_connect.php");
require_once("print.php");

// ******************************
// 初期処理や変数の設定
// ******************************
// フォント選択とフォントのサイズ指定
$pdf->SetFont('ume-tmo3', '', 14);

$counter = 0;			// ページ用カウンタ
$row_height = 8;		// 行の高さ
$header_height = 40;	// ヘッダ部分の高さ
$rmax = 15;				// ページ内の最大明細行数
$lcount = 0;			// 次に印字する行位置

$init = true;			// 初回フラグ

$cur_position = $header_height;

// データの印字
$_POST["query"] = <<<QUERY
select 社員コード,氏名,フリガナ from 社員マスタ
QUERY;

try {
    $stmt = $sqlite->prepare($_POST["query"]);
    $stmt->execute();
}
catch ( PDOException $e ) {
    $GLOBALS["error"]["db"] .= $GLOBALS["dbname"];
    $GLOBALS["error"]["db"] .= " " . $e->getMessage();
}

$init = true;
while ( $row = $stmt->fetch() ) {

    // 初回のみヘッダを印字する
    if(  $init  ) {
        $init = false;
        $pdf->AddPage();
        print_header( $pdf );
    }

    // 改ページ コントロール
    $lcount += 1;
    if ( $lcount > $rmax ) {
        // ページ追加
        $pdf->AddPage();

        $counter += 1;
        print_header( $pdf );

        // 行カウントを初期化する
        $lcount = 1;
        // 印字位置を先頭に持っていく
        $cur_position = $header_height;
    }

    user_text( $pdf, 10, $cur_position, $row["社員コード"] );
    user_text( $pdf, 28, $cur_position, $row["氏名"] );
    user_text( $pdf, 51+15, $cur_position, $row["フリガナ"] );

    $cur_position += $GLOBALS['row_height'];

}

// ブラウザへ PDF を出力します
$pdf->Output("test_output.pdf", "I");

// ************************************
// ヘッダの印字
// ************************************
function print_header( $pdf ) {

    global $counter;

    $page_info = $pdf->getPageDimensions();
    $cur_position = $page_info['tm'];	// トップマージン

    // ページの先頭
    user_text( $pdf, 125,   $cur_position, "社員一覧表" );
    user_text( $pdf, 224,   $cur_position, "ページ :" );
    user_text( $pdf, 250,   $cur_position, number_format($counter+1), 5, 0, "R" );

    // データのタイトル
    $cur_position += $GLOBALS['row_height'] * 2;
    user_text( $pdf, 10,    $cur_position, "コード" );
    user_text( $pdf, 28,    $cur_position, "氏名" );
    user_text( $pdf, 51+15, $cur_position, "フリガナ" );

}

?>
