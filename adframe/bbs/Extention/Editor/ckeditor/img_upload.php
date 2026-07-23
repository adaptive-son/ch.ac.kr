<?php
error_reporting(E_ALL);
    ini_set("display_errors", 1);
// 업로드된 파일 처리
$uploadDirBase = '/home/dev/data/smartEditorUpload/'; // 상대 경로

$fdate = date("Ym"); // Unix timestamp 기준 폴더명

// 업로드 폴더 생성
$uploadDir = $uploadDirBase . $fdate . '/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
    // mkdir()의 모드는 프로세스 umask 영향을 받아 0777 그대로 적용되지 않을 수 있어서
    // (실제로 0755로 생성되어 업로드 계정 외에는 쓰기가 안 되는 문제가 있었음) 명시적으로 재적용.
    chmod($uploadDir, 0777);
}

$returnFiles = array();

if (!empty($_FILES['imgfile'])) {
    // 다중 파일 처리
    $fileCount = count($_FILES['imgfile']['name']);

    for ($i = 0; $i < $fileCount; $i++) {
        $tmpName = $_FILES['imgfile']['tmp_name'][$i];
        $originalName = $_FILES['imgfile']['name'][$i];
        $size = $_FILES['imgfile']['size'][$i];

        // 파일명과 확장자 분리
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $newName = time() . ($i + 1) . '.' . $ext;
        $fullPath = $uploadDir . $newName;

        // 파일 업로드
        if (move_uploaded_file($tmpName, $fullPath)) {
            $returnFiles[] = $originalName . '|' .$fdate."/". $newName;
        }
    }
}

// 결과 출력 (ASP처럼 문자열로 반환)
echo implode(',', $returnFiles);
?>
