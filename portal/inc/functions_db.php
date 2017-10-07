<?php

function db_escape($string) {
    return mysql_real_escape_string($string);
}

function db_column_exists($column, $table, $conn = null) {
    $result = mysql_query(sprintf("SHOW COLUMNS FROM `%s` LIKE '%s'", $table, db_escape($column)), $conn);
    return mysql_num_rows($result) > 0;
}
