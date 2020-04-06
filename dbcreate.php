<?php
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('shutthebox.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }

   $sql =<<<EOF
      CREATE TABLE LASTMESSAGES
      (chatId TEXT PRIMARY KEY     NOT NULL,
      diceId           TEXT    NOT NULL,
      boardId          TEXT     NOT NULL);
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
   $db->close();
?>
