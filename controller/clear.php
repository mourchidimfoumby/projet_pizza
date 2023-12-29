<?php
session_start();
session_unset();
$response = [
    "message" => "SESSION UNSET"
];
echo json_encode($response);
?>