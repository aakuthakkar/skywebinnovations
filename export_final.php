<?php
// Complete MySQL export - properly handles SQLite backticks
$db = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');

$sql = "-- Sky Web Innovations - Complete Database Export\n";
$sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Target: MySQL (skywotut_skyweb)\n\n";
$sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

// Get all tables except internal
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' AND name != 'migrations' ORDER BY name")->fetchAll(PDO::FETCH_COLUMN);

foreach ($tables as $table) {
    // Get column info from SQLite pragma - this gives clean column names without backticks
    $cols = $db->query("PRAGMA table_info(`$table`)")->fetchAll(PDO::FETCH_ASSOC);

    $colDefs = [];
    $indexSQLs = [];
    $pkCol = 'id';

    foreach ($cols as $col) {
        $name = $col['name'];
        $rawType = strtolower($col['type']);
        $notnull = $col['notnull'] ? ' NOT NULL' : '';
        $defaultVal = $col['dflt_value'];

        // Clean up default value
        if ($defaultVal !== null) {
            $defaultVal = trim($defaultVal, "'");
            if ($defaultVal === '' || $defaultVal === '') $defaultVal = '';
        }

        // Determine if this is the primary key
        $isPK = ($col['pk'] == 1);

        // Map SQLite types to MySQL
        if ($isPK && str_starts_with($rawType, 'integer')) {
            $def = "`$name` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY";
        } elseif (str_starts_with($rawType, 'integer')) {
            $def = "`$name` INT$notnull";
            if ($defaultVal !== null && $defaultVal !== '') $def .= " DEFAULT '$defaultVal'";
        } elseif (str_starts_with($rawType, 'text')) {
            if (preg_match('/text\((\d+)\)/i', $col['type'], $m)) {
                $def = "`$name` VARCHAR({$m[1]})$notnull";
            } else {
                $def = "`$name` TEXT$notnull";
            }
            if ($defaultVal !== null && $defaultVal !== '') $def .= " DEFAULT '" . str_replace("'", "\\'", $defaultVal) . "'";
        } elseif ($rawType === 'boolean' || $rawType === 'bool') {
            $def = "`$name` BOOLEAN$notnull";
            if ($defaultVal !== null && $defaultVal !== '') $def .= " DEFAULT " . ($defaultVal == '1' ? '1' : '0');
        } elseif ($rawType === 'json') {
            $def = "`$name` JSON$notnull";
        } elseif ($rawType === 'date') {
            $def = "`$name` DATE$notnull";
        } elseif ($rawType === 'datetime') {
            $def = "`$name` TIMESTAMP$notnull";
        } elseif ($rawType === 'real') {
            $def = "`$name` DECIMAL(10,2)$notnull";
        } elseif ($rawType === 'blob') {
            $def = "`$name` TEXT$notnull";
        } else {
            $def = "`$name` TEXT$notnull";
        }

        $colDefs[] = "    $def";
    }

    // Get indexes
    $indexList = $db->query("PRAGMA index_list(`$table`)")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($indexList as $idx) {
        $idxCols = $db->query("PRAGMA index_info(`{$idx['name']}`)")->fetchAll(PDO::FETCH_ASSOC);
        $colList = array_map(fn($c) => str_replace('`', '', $c['name']), $idxCols);
        $unique = $idx['unique'] ? 'UNIQUE ' : '';
        $indexSQLs[] = "    $unique" . 'INDEX (`' . implode('`, `', $colList) . '`)';
    }

    $sql .= "-- Table: $table\n";
    $sql .= "CREATE TABLE IF NOT EXISTS `$table` (\n";
    $sql .= implode(",\n", $colDefs);
    if (!empty($indexSQLs)) {
        $sql .= ",\n" . implode(",\n", $indexSQLs);
    }
    $sql .= "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

    // Get data
    $rows = $db->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
        foreach ($rows as $row) {
            if ($table === 'sessions') continue;

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
echo "Done: " . filesize(__DIR__ . '/database_full_mysql.sql') . " bytes\n";
