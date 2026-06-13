<?php
$dir = new RecursiveDirectoryIterator('.');
$iterator = new RecursiveIteratorIterator($dir);
$regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

foreach ($regex as $file) {
    $filePath = $file[0];
    if (strpos($filePath, 'vendor') !== false || strpos($filePath, 'node_modules') !== false || strpos($filePath, 'scratch') !== false) {
        continue;
    }
    $lines = file($filePath);
    foreach ($lines as $num => $line) {
        if (stripos($line, 'futsal') !== false) {
            echo $filePath . ":" . ($num+1) . ": " . trim($line) . "\n";
        }
    }
}
?>
