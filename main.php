<?php
require_once 'token.php';
$dbpath = 'shutthebox.db';
if (!file_exists($dbpath)) {
    require_once 'dbcreate.php';
}
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
function deleteMessage($chatId, $message_id) {
    $url = $GLOBALS[website]."/deleteMessage?chat_id=".$chatId."&message_id=".$message_id;
    file_get_contents($url);
}
function sendDice($chatId,$message_id) {
    $url = $GLOBALS[website]."/sendDice?chat_id=".$chatId."&reply_to_message_id=".$message_id;
    $message = json_decode(file_get_contents($url), TRUE);
    return array($message["result"]["message_id"],$message["result"]["dice"]["value"]);
}
set_time_limit(0);
ini_set('max_execution_time', 0);
$dice = sendDice ($chatId, $message_id);
$diceId = $dice[0];
$diceValue = $dice[1];
$boardId= "222";
require_once 'dbupdate.php';
require_once 'numbers.php';
?>
