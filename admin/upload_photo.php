<?php
    $photo = $_FILES['photo'];

    $photo_name = basename($photo['name']);

    $image = "../public/product_images/" . $photo_name;

    $allowed_ext = ['jpg', 'png', 'jpeg', 'gif'];

    $ext = pathinfo($photo_name, PATHINFO_EXTENSION);

    if(in_array($ext, $allowed_ext) && $photo['size'] < 2000000) {
        move_uploaded_file($photo['tmp_name'], $image);
        echo json_encode(['success' => true, 'image' => $photo_name]);
        exit();
    }
    else {
        echo json_encode(['success' => false, 'error' => 'Invalid file']);
    }
?>