<?php
// Clean MySQL export - no TRUNCATE, fixes data issues
$db = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' AND name != 'migrations'")->fetchAll(PDO::FETCH_COLUMN);

$sql = "-- Sky Web Innovations Database Export\n";
$sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Target: MySQL (skywotut_skyweb)\n\n";

foreach ($tables as $table) {
    $rows = $db->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) continue;

    $sql .= "-- Table: $table\n";

    foreach ($rows as $row) {
        // Remove localhost-only session data
        if ($table === 'sessions') {
            continue;
        }

        // Fix number columns that SQLite stores with leading zeros
        if ($table === 'why_us_items' || $table === 'process_steps') {
            $row['number'] = (int)$row['number'];
        }

        // Fix contact_phone_raw - ensure it's a string
        if ($table === 'settings' && $row['key'] === 'contact_phone_raw') {
            $row['value'] = (string)$row['value'];
            $vals = array_map(function($v) use ($db) {
                if ($v === null) return 'NULL';
                if (is_bool($v)) return $v ? '1' : '0';
                if (is_int($v)) return (string)$v;
                if (is_numeric($v)) return $v;
                return $db->quote($v);
            }, array_values($row));
            $cols = array_map(fn($k) => "`$k`", array_keys($row));
            $sql .= "INSERT INTO `$table` (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ");\n";
            continue;
        }

        // Fix blog_post tags - ensure proper JSON format for MySQL
        if ($table === 'blog_posts' && $row['tags']) {
            $tags = json_decode($row['tags'], true);
            if ($tags) {
                $row['tags'] = json_encode($tags);
            }
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

$outputPath = __DIR__ . '/database_export_clean.sql';
file_put_contents($outputPath, $sql);
echo "Clean export: " . filesize($outputPath) . " bytes\n";
foreach ($tables as $t) {
    $count = $db->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
    echo "  - $t: $count rows\n";
}
