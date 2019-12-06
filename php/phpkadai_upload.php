<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML4.01 Transitional//EN"> <html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>アップロード</title>
</head>

<body>
    <?php
    $upfile = $_FILES['upfile'];
    move_uploaded_file($upfile['tmp_name'], './files/' . $upfile['name']);
    print file_exists('./files/'.$upfile['name'])."<br/>";
    if(file_exists('./files/'.$upfile['name'])==true){
            echo "アップロードに成功しました。<br/>";
        }
    else {
        echo"アップロードに失敗しました。";
    }
    ?>
</body>

</html>
