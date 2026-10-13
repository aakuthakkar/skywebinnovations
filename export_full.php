<?php
// Generate complete MySQL SQL with CREATE TABLE + INSERT statements
$db = new PDO('sqlite:' . __DIR__ . '/database/database.sqlite');

// Read all migration files to get CREATE TABLE statements
$migrationFiles = glob(__DIR__ . '/database/migrations/*.php');
$createTableSQL = '';
foreach ($migrationFiles as $file) {
    $content = file_get_contents($file);
    // Extract the up() method content between Schema::create and closing brace
    if (preg_match('/Schema::create\((.*?),\s*function\s*\(Blueprint\s*\$table\)\s*\{([\s\S]*?)\n\s{12}\}\);/', $content, $matches)) {
        $tableName = $matches[1];
        $body = $matches[2];
        // Indent body properly
        $body = preg_replace('/^ {12}/m', '    ', $body);
        $createTableSQL .= "\n-- Create table: $tableName\n";
        $createTableSQL .= "CREATE TABLE IF NOT EXISTS `$tableName` (\n";
        // Parse the body lines
        $lines = explode("\n", $body);
        $columns = [];
        $indexes = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if (preg_match('/^\$table->(\w+)\((.*?)\)(.*?);$/', $line, $m)) {
                $method = $m[1];
                $args = $m[2];
                $rest = $m[3];
                if ($method === 'id') {
                    $columns[] = "    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY";
                } elseif ($method === 'string') {
                    $colName = $args;
                    $nullable = str_contains($rest, 'nullable') ? '' : ' NOT NULL';
                    $default = preg_match('/->default\((.*?)\)/', $rest, $dm) ? " DEFAULT {$dm[1]}" : '';
                    $columns[] = "    `$colName` VARCHAR(255)$nullable$default";
                } elseif ($method === 'text') {
                    $colName = $args;
                    $nullable = str_contains($rest, 'nullable') ? '' : ' NOT NULL';
                    $columns[] = "    `$colName` TEXT$nullable";
                } elseif ($method === 'boolean') {
                    $colName = $args;
                    $default = preg_match('/->default\((.*?)\)/', $rest, $dm) ? " DEFAULT {$dm[1]}" : ' DEFAULT 1';
                    $columns[] = "    `$colName` BOOLEAN$default";
                } elseif ($method === 'integer' || $method === 'unsignedInteger' || $method === 'unsignedTinyInteger') {
                    $colName = $args;
                    $nullable = str_contains($rest, 'nullable') ? '' : ' NOT NULL';
                    $default = preg_match('/->default\((.*?)\)/', $rest, $dm) ? " DEFAULT {$dm[1]}" : '';
                    $type = $method === 'unsignedTinyInteger' ? 'TINYINT UNSIGNED' : 'INT';
                    $columns[] = "    `$colName` $type$nullable$default";
                } elseif ($method === 'decimal') {
                    preg_match('/decimal\((\d+),\s*(\d+)\)/', $args, $dm);
                    $colName = $args;
                    $precision = $dm[1] ?? 10;
                    $scale = $dm[2] ?? 2;
                    $nullable = str_contains($rest, 'nullable') ? '' : ' NOT NULL';
                    $columns[] = "    `$colName` DECIMAL($precision,$scale)$nullable";
                } elseif ($method === 'date') {
                    $colName = $args;
                    $nullable = str_contains($rest, 'nullable') ? '' : ' NOT NULL';
                    $columns[] = "    `$colName` DATE$nullable";
                } elseif ($method === 'timestamp') {
                    $colName = $args;
                    $nullable = str_contains($rest, 'nullable') ? '' : ' NOT NULL';
                    $default = preg_match('/->useCurrent/', $rest) ? ' DEFAULT CURRENT_TIMESTAMP' : '';
                    $columns[] = "    `$colName` TIMESTAMP$nullable$default";
                } elseif ($method === 'json') {
                    $colName = $args;
                    $nullable = str_contains($rest, 'nullable') ? '' : ' NOT NULL';
                    $columns[] = "    `$colName` JSON$nullable";
                } elseif ($method === 'timestamps') {
                    $columns[] = "    `created_at` TIMESTAMP NULL DEFAULT NULL";
                    $columns[] = "    `updated_at` TIMESTAMP NULL DEFAULT NULL";
                } elseif ($method === 'softDeletes') {
                    $columns[] = "    `deleted_at` TIMESTAMP NULL DEFAULT NULL";
                } elseif ($method === 'foreignId') {
                    preg_match('/\'(\w+)\'\)/', $args, $fm);
                    $colName = $fm[1] ?? $args;
                    $nullable = str_contains($rest, 'nullable') ? '' : ' NOT NULL';
                    $columns[] = "    `$colName` BIGINT UNSIGNED$nullable";
                } elseif ($method === 'index' || $method === 'unique') {
                    $cols = str_replace(['\'', ' '], ['', ''], $args);
                    $prefix = $method === 'unique' ? 'UNIQUE ' : '';
                    $indexes[] = "    $prefix" . 'INDEX (`' . str_replace(',', '`, `', $cols) . '`)';
                } elseif ($method === 'primary') {
                    $cols = str_replace(['\'', ' '], ['', ''], $args);
                    $indexes[] = '    PRIMARY KEY (`' . str_replace(',', '`, `', $cols) . '`)';
                } elseif ($method === 'foreign') {
                    // handled via foreignId
                }
            }
        }
        $createTableSQL .= implode(",\n", array_unique($columns));
        if (!empty($indexes)) {
            $createTableSQL .= ",\n" . implode(",\n", $indexes);
        }
        $createTableSQL .= "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n";
    }
}

// Now get the data
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' AND name != 'migrations'")->fetchAll(PDO::FETCH_COLUMN);

$dataSQL = '';
foreach ($tables as $table) {
    $rows = $db->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) continue;

    foreach ($rows as $row) {
        if ($table === 'sessions') continue;

        if ($table === 'why_us_items' || $table === 'process_steps') {
            $row['number'] = (int)$row['number'];
        }
        if ($table === 'blog_posts' && $row['tags']) {
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

        $dataSQL .= "INSERT INTO `$table` (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ");\n";
    }
}

// Combine and write
$fullSQL = "-- Sky Web Innovations - Complete Database Export\n";
$fullSQL .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$fullSQL .= "-- Target: MySQL (skywotut_skyweb)\n";
$fullSQL .= "-- This file includes CREATE TABLE + INSERT statements\n\n";
$fullSQL .= "SET FOREIGN_KEY_CHECKS=0;\n\n";
$fullSQL .= $createTableSQL . "\n";
$fullSQL .= "-- ============================================\n";
$fullSQL .= "-- DATA\n";
$fullSQL .= "-- ============================================\n\n";
$fullSQL .= $dataSQL . "\n";
$fullSQL .= "SET FOREIGN_KEY_CHECKS=1;\n";

file_put_contents(__DIR__ . '/database_full_export.sql', $fullSQL);
echo "Full export: " . filesize(__DIR__ . '/database_full_export.sql') . " bytes\n";
echo "Tables: " . count($tables) . "\n";
