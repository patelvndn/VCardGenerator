<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = file_get_contents("php://input");
    $file = fopen($_SERVER['DOCUMENT_ROOT'] . "/" . $_POST["filePath"], "w");
    fwrite($file, $data);
    fclose($file);
    http_response_code(200);
  } else {
    http_response_code(400);
  }
?>
