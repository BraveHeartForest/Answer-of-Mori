<?php
var_dump($_FILES);
$file = $_FILES['upload_file']['tmp_name'];
var_dump($file);
// const IMF = 'C:\xampp\htdocs\mori_folder\img';
const IMF = 'C:/xampp/htdocs/mori_folder/img';
print "const IMF =".IMF;
move_uploaded_file($file,IMF);
