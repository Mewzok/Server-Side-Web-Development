<?php
    // retrieve raw json
    $data = json_decode(file_get_contents("php://input"), true);

    // check if image data exists
    if(!isset($data['imageData'])) {
        http_response_code(400);
        echo "No image data received.";
        exit;
    }

    // get the image data if it does exit
    $imageData = $data['imageData'];

    // remove prefix
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);

    // decode the image
    $decodedImage = base64_decode($imageData);

    // create folder if it doesn't exist
    $folderPath = 'recent_letters';
    if(!file_exists($folderPath)) {
        mkdir($folderPath, 0755, true);
    }

    // name each letter based on date and time
    $filename = $folder.'/letter_'.time().'.png';

    // save file
    file_put_contents($filename, $decodedImage);

    echo "Saved as $filename";
?>