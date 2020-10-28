<?php
if ($_POST["present"]) {
    $f = fopen("present.txt", "w");
    @fwrite($f, $_POST["present"]);
    fclose($f);
}

// 制御ファイル読み込み
$present = file_get_contents(__DIR__ . "/" . "present.txt");

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../style.css">
    <title>粗品配布制御</title>
</head>
<body class="main_bk">
    <h1>粗品配布状態の切替</h1>
    <form action="index.php" method="POST">
        <div class="input-box">
            <select name="present">
                <option value="1" <?= $present == 1 ? "selected" : "" ?>>粗品配布</option>
                <option value="2" <?= $present == 2 ? "selected" : "" ?>>粗品配布の終了</option>
            </select>
        </div>
        <button type="submit" class="btn btn-info w-50 mt-2 d-block mx-auto">切替</button>
    </form>
</body>
</html>