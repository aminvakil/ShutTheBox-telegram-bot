<?php
$posses = array(
    "inline_keyboard" => array(array())
);
foreach ($numbers[$sum] as $diceValue) {
    array_push($posses["inline_keyboard"][0], array("text" => $diceValue, "callback_data" => $diceValue));
}
$boardId = sendBoard ($chatId, $board, $posses);
?>
