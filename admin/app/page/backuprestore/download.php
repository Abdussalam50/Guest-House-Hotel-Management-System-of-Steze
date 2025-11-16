<?php
if (file_exists('file/database.sql')) {
    header('Content-Type: application/sql');
    header('Content-Disposition: attachment; filename="database.sql"');
    readfile('file/database.sql');
    exit;
} else {
    echo "File not found.";
}
?>