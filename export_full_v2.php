<?php
// Generate complete MySQL export from SQLite schema + data
$db = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');

$sql = "-- Sky Web Innovations - Complete Database Export\n";
$sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Target: MySQL (skywotut_skyweb)\n\n";
$sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

// Get all tables
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' AND name != 'migrations'")->fetchAll(PDO::FETCH_COLUMN);

foreach ($tables as $table) {
    // Get CREATE TABLE SQL from SQLite
    $createSQL = $db->query("SELECT sql FROM sqlite_master WHERE type='table' AND name='" . $table . "'")->fetchColumn();

    // Convert SQLite schema to MySQL
    $mysqlSQL = $createSQL;
    $mysqlSQL = preg_replace('/AUTOINCREMENT/', 'AUTO_INCREMENT', $mysqlSQL);
    $mysqlSQL = preg_replace('/INTEGER PRIMARY KEY AUTOINCREMENT/', 'BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY', $mysqlSQL);
    $mysqlSQL = preg_replace('/TEXT \([0-9]+\)/', 'TEXT', $mysqlSQL);
    $mysqlSQL = preg_replace('/VARCHAR \([0-9]+\)/', 'VARCHAR(255)', $mysqlSQL);
    $mysqlSQL = preg_replace('/BOOLEAN/', 'BOOLEAN', $mysqlSQL);
    $mysqlSQL = preg_replace('/DATETIME/', 'TIMESTAMP', $mysqlSQL);
    $mysqlSQL = preg_replace('/,/', '`,\n    `', $mysqlSQL);
    // Fix the column list formatting
    $mysqlSQL = str_replace('CREATE TABLE `' . $table . '` (`', "CREATE TABLE IF NOT EXISTS `$table` (\n    ", $mysqlSQL);
    $mysqlSQL = str_replace('`)', "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;", $mysqlSQL);

    $sql .= "-- Table: $table\n";
    $sql .= $mysqlSQL . "\n\n";

    // Get data
    $rows = $db->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
        foreach ($rows as $row) {
            if ($table === 'sessions') continue;

            // Fix data types
            if (($table === 'why_us_items' || $table === 'process_steps') && isset($row['number'])) {
                $row['number'] = (int)$row['number'];
            }
            if ($table === 'blog_posts' && !empty($row['tags'])) {
                $tags = json_decode($row['tags'], true);
                if ($tags) $row['tags'] = json_encode($tags);
            }

            $cols = array_map(fn($k) => "`$k`", array_keys($row));
            $vals = array_map(function($v) use ($db) {
                if ($v === null) return 'NULL';
                if (is_bool($v)) return $v ? '1' : '0';
                if (is_int($v)) return (string)$v;
                if (is_numeric($v)) return $v;
                return $db->quote($v);
            }, array_values($row));

            $sql .= "INSERT INTO `$table` (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ");\n";
        }
        $sql .= "\n";
    }
}

$sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

file_put_contents(__DIR__ . '/database_full_mysql.sql', $sql);
echo "Full MySQL export: " . filesize(__DIR__ . '/database_full_mysql.sql') . " bytes\n";
echo "Tables exported: " . count($tables) . "\n";
