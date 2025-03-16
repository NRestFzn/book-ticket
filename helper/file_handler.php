<?php
class FileHandler
{
    public function uploadFile()
    {
        if ($_FILES['file_upload'] && $_FILES['file_upload']['name']) {
            $folder = "{$_SERVER['DOCUMENT_ROOT']}/uploads/";

            $listName = array();
            $explodedFileName = explode(" ", basename($_FILES["file_upload"]["name"]));

            foreach ($explodedFileName as $key => $value) {
                $listName[] = $value;
            }

            $filename = time() . "-" . implode("_", $listName);
            $targetFile = $folder . $filename;
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $uploadOk = 1;
            if (!is_dir($folder)) {
                mkdir($folder, 0755, true);
            }
            $allowedTypes = ["jpg", "png", "jpeg", "gif", "pdf"];
            if (!in_array($fileType, $allowedTypes)) {
                echo json_encode(['message' => 'only jpg, png and jpeg format is allowed']);
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                move_uploaded_file($_FILES["file_upload"]["tmp_name"], $targetFile);
            }

            return "/uploads" . $filename;
        } else {
            return null;
        }
    }
}
