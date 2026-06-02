<?php
// Standalone PHP script to fix leading whitespaces and BOMs in Laravel files
// Upload this to htdocs/fix.php and visit https://e-suratkominfo.rf.gd/fix.php

header('Content-Type: text/plain');

$fixed = [];
try {
    $dir = new RecursiveDirectoryIterator(__DIR__ . '/app');
    $iterator = new RecursiveIteratorIterator($dir);
    $regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

    $filesToCheck = [];
    foreach ($regex as $info) {
        $filesToCheck[] = $info[0];
    }
    $filesToCheck[] = __DIR__ . '/bootstrap/app.php';
    $filesToCheck[] = __DIR__ . '/routes/web.php';
    $filesToCheck[] = __DIR__ . '/config/database.php';
    
    foreach ($filesToCheck as $file) {
        if (!file_exists($file)) continue;
        
        $content = file_get_contents($file);
        if (strlen($content) === 0) continue;
        
        $original = $content;
        
        // 1. Remove UTF-8 BOM if present
        $bom = pack("CCC", 0xef, 0xbb, 0xbf);
        if (substr($content, 0, 3) === $bom) {
            $content = substr($content, 3);
        }
        
        // 2. Remove leading whitespaces, newlines, or invisible characters before <?php
        $pos = strpos($content, '<?php');
        if ($pos !== false && $pos > 0) {
            $before = substr($content, 0, $pos);
            if (trim($before) === '') {
                // It was just whitespace/newlines
                $content = substr($content, $pos);
            }
        }
        
        if ($content !== $original) {
            file_put_contents($file, $content);
            $fixed[] = str_replace(__DIR__, '', $file);
        }
    }
    
    if (count($fixed) > 0) {
        echo "Successfully fixed files:\n";
        echo implode("\n", $fixed) . "\n";
    } else {
        echo "No files needed fixing (all clean).\n";
    }
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
