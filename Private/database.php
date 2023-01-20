<?php
$db_path = '../Private/db/cms.db';
$db = new SQLite3($db_path);
'ALTER TABLE users ADD COLUMN image BLOB;'
?>