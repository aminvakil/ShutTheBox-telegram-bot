<?php
$db = new SQLite3('bestdicer.db');
$query = $db->prepare('SELECT chatId, diceId, boardId FROM messages WHERE chatId = ?');
$query->bindParam(1, $chatId);
$result = $query->execute();
$row = $result->fetchArray();
deleteMessage ($chatId, $row['diceId']);

$query = $db->prepare('
INSERT OR REPLACE INTO messages (chatId, diceId, boardId)
  VALUES (  ?,
            ?,
            ?
          );
');
$query->bindParam(1, $chatId);
$query->bindParam(2, $diceId);
$query->bindParam(3, $boardId);
$query->execute();
   $db->close();
?>
