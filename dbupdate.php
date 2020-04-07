<?php
$db = new SQLite3('shutthebox.db');
$query = $db->prepare('SELECT chatId, diceId, boardId FROM messages WHERE chatId = ?');
$query->bindParam(1, $chatId);
$result = $query->execute();
$row = $result->fetchArray();

foreach (unserialize($row['diceId']) as $diceIdDel) {
    deleteMessage ($chatId, $diceIdDel);
}

$query = $db->prepare('
INSERT OR REPLACE INTO messages (chatId, diceId, boardId) 
  VALUES (  ?, 
            ?,
            ?
          );
');
$query->bindParam(1, $chatId);
$query->bindParam(2, serialize($diceId));
$query->bindParam(3, $boardId);
$query->execute();
   $db->close();
?>
