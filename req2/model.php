<?php

// 基本 SQL
$_POST["query"] = <<<QUERY
select 社員コード,氏名,フリガナ from 社員マスタ
QUERY;

// 入力値で条件作成
if ( $_POST["simei"] != "" ) {
    $_POST["query"] .= " where 氏名 like :simei ";
}

try {
    $stmt = $sqlite->prepare($_POST["query"]);
    if ( $_POST["simei"] != "" ) {
        $stmt->bindValue( ':simei', "%" . $_POST["simei"] . "%", PDO::PARAM_STR );
    }
    $stmt->execute();
}
catch ( PDOException $e ) {
    $GLOBALS["error"]["db"] .= $GLOBALS["dbname"];
    $GLOBALS["error"]["db"] .= " " . $e->getMessage();
}

$title = "";
$data_body = "";
while ( $row = $stmt->fetch() ) {
    if ( $title == "" ) {
        $title .= "<tr>";
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $meta = $stmt->getColumnMeta($i);
            $title .= "<td>{$meta['name']}</td>";
        }
        $title .= "</tr>";
    }
    $data_body .= "<tr>";
    for( $i = 0; $i <  $stmt->columnCount(); $i++ ) {

        if ( $i == 1 ) {
            $data_body .= "<td><a href='#' onclick='setData(\"{$row[0]}\",\"{$row[1]}\")'>{$row[$i]}</a></td>";
        }
        else {
            $data_body .= "<td>{$row[$i]}</td>";
        }

    }
    $data_body .= "</tr>";

}

?>
