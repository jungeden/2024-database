<?php
echo '<pre>';
print_r($_FILES);
echo '</pre>';

if (isset($_FILES['testfiles']) && is_array($_FILES['testfiles']['name'])) {
    $uploadDir = './uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadedFiles = [];
    for ($i = 0; $i < count($_FILES['testfiles']['name']); $i++) {
        $fileName = basename($_FILES['testfiles']['name'][$i]);
        $fileTmpName = $_FILES['testfiles']['tmp_name'][$i];
        $fileError = $_FILES['testfiles']['error'][$i];

        if ($fileError === UPLOAD_ERR_OK) {
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($fileTmpName, $targetPath)) {
                $uploadedFiles[] = $fileName;
            }
        }
    }

    if (!empty($uploadedFiles)) {
        echo "Uploaded files: " . implode(", ", $uploadedFiles);
    } else {
        echo "No files uploaded.";
    }
} else {
    echo "No files selected.";
}
?>
