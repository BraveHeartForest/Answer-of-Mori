<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML4.01 Transitional//EN"> <html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>ファイル課題</title>
</head>

<body>
    <?php
    if (file_exists('file_exists.php') == true) {
      echo "file_exists.phpが見つかりました。";
    } else {
      echo "file_exists.phpは見つかりませんでした。";
    }
    ?>
</body>

</html>
