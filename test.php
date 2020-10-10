<?php

$postParam = file_get_contents("php://input");
$input=json_decode($postParam,JSON_UNESCAPED_UNICODE);
echo (var_dump($input));
die();

?>