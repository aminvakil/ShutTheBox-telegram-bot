<?php
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('bestdicer.db');
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
      (CHATID TEXT PRIMARY KEY     NOT NULL,
      DICE           TEXT    NOT NULL,
      BOARD          TEXT     NOT NULL);
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
   $db->close();
?>
