<?php

function handelUpload(&$data)
{
    $target_dir =  '/var/www/html/blog/public/img/article-imgs/';
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = true;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if (!$check !== false) {
        $data['img_error'] =  "File is not an image.";
        $uploadOk = false;
    }

    if (
        $imageFileType != "jpg" && $imageFileType != "png" &&
        $imageFileType != "jpeg" && $imageFileType != "gif"
    ) {
        $data['img_error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = false;
    }

    if ($uploadOk) {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    } else {
        die('failed to store ');
    }
}
