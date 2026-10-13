<?php
// Export database to MySQL-compatible SQL
$db = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);

$sql = "-- Sky Web Innovations Database Export\n";
$sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Source: SQLite | Target: MySQL\n\n";
$sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

foreach ($tables as $table) {
    $sql .= "-- Table: $table\n";
    $rows = $db->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) { $sql .= "\n"; continue; }

    $sql .= "TRUNCATE TABLE `$table`;\n";

    foreach ($rows as $row) {
        $cols = array_map(fn($k) => "`$k`", array_keys($row));
        $vals = array_map(function($v) use ($db) {
            if ($v === null) return 'NULL';
            if (is_numeric($v)) return $v;
            return $db->quote($v);
        }, array_values($row));
        $sql .= "INSERT INTO `$table` (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ");\n";
    }
    $sql .= "\n";
}

$sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

$outputPath = __DIR__ . '/database_export.sql';
file_put_contents($outputPath, $sql);
echo "Export complete: " . filesize($outputPath) . " bytes, " . count($tables) . " tables\n";
foreach ($tables as $t) {
    $count = $db->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
    echo "  - $t: $count rows\n";
}
