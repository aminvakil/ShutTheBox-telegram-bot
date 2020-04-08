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
function sendBoard($chatId, $message, $options) {
    $url = $GLOBALS[website]."/sendmessage?chat_id=".$chatId."&text=".urlencode($message)."&reply_markup=".json_encode($options);
    $message = json_decode(file_get_contents($url), TRUE);
    return $message["result"]["message_id"];
}
set_time_limit(0);
ini_set('max_execution_time', 0);
for ($i = 0; $i < 2; $i++) {
    $dice[] = sendDice ($chatId, $message_id);
    $diceId[] = $dice[$i][0];
    $diceValue[] = $dice[$i][1];
}
$board= "What do you want to remove?";
$sum = array_sum($diceValue);
require_once 'numbers.php';
require_once 'board.php';
require_once 'dbupdate.php';
?>
