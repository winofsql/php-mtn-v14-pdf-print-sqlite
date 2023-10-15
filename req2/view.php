<!DOCTYPE html>
<html>

<head>
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="sqlite.css?_=<?= time() ?>">
<script>
$(function(){

    // **************************
    // この IFRAME を閉じる
    // **************************
    $(window).on("keydown", function(e){

        var key_code = e.which ? e.which : e.keyCode;

        if ( key_code == 27 ) {
            parent.$("#iframe2").eq(0).css({"display": "none"});
        }

    });

});

// **************************
// 本体にデータ転送して閉じる
// **************************
function setData(scode,sname){

    var parent = window.parent;
    parent.$("#scode").val(scode);

    // 非表示にする
    parent.$("#iframe1").eq(0).css({
        "display": "none"
    });

    parent.$("[value='確認']").click();

}
</script>
</head>
<body>

<div id="main">
<form method="post" style='position:fixed;left:500px;top:10px;'>

    <div class="text-block">
    <input name="simei" value="<?= $_POST["simei"] ?>">
    <input type="submit" name="send1" value="送信">
    </div>

</form>

<b style="color:red;"><?= $GLOBALS["error"]["db"] ?></b>

<table class="table table-hover table-responsive" style='width:400px'>

    <?= $title ?>
    <?= $data_body ?>

</table>

</div>

</body>
</html>
