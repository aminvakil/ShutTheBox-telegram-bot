<?php
//error_reporting(E_ALL);
require_once 'token.php';
$website = "https://api.telegram.org/bot" . $botToken;
$update = file_get_contents("php://input");
$updateArray = json_decode($update, TRUE);
$chatId = $updateArray["message"]["chat"]["id"];
$message = $updateArray["message"]["text"];
$message_id = $updateArray["message"]["message_id"];
$id = $updateArray["message"]["from"]["id"];
function sendMessage($chatId, $message) {
    $url = $GLOBALS[website]."/sendmessage?chat_id=".$chatId."&text=".urlencode($message);
    file_get_contents($url);
}
function sendDice($chatId,$message_id) {
    $url = $GLOBALS[website]."/sendDice?chat_id=".$chatId."&reply_to_message_id=".$message_id;
    file_get_contents($url);
}
set_time_limit(0);
ini_set('max_execution_time', 0);
//sendMessage ($chatId, $updateArray["message"]["text"]);
//sendMessage ($chatId, $message_id);
sendDice ($chatId,$message_id);
?>
