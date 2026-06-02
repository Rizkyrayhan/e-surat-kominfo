<?php
$dir = new RecursiveDirectoryIterator('app');
$iterator = new RecursiveIteratorIterator($dir);
$regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

foreach ($regex as $info) {
    $file = $info[0];
    $content = file_get_contents($file);
    if (strlen($content) > 0) {
        // Check if the file starts with BOM or whitespace before <?php
        // BOM for UTF-8 is EF BB BF
        $startsWithBOM = (substr($content, 0, 3) === pack("CCC", 0xef, 0xbb, 0xbf));
        $actualStart = $startsWithBOM ? substr($content, 3) : $content;
        
        if (substr(trim($actualStart), 0, 5) === '<?php') {
            // It has <?php but maybe there is whitespace before it?
            if (substr($actualStart, 0, 5) !== '<?php') {
                echo "Whitespace before <?php in file: $file (Hex start: " . bin2hex(substr($actualStart, 0, 10)) . ")\n";
            }
        } else {
            // Doesn't start with <?php at all or has something else
            echo "Does not start with <?php: $file (Hex start: " . bin2hex(substr($content, 0, 10)) . ")\n";
        }
    }
}

// Check other bootstrap, config, routes files
$otherFiles = ['bootstrap/app.php', 'config/database.php', 'routes/web.php'];
foreach ($otherFiles as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $startsWithBOM = (substr($content, 0, 3) === pack("CCC", 0xef, 0xbb, 0xbf));
        $actualStart = $startsWithBOM ? substr($content, 3) : $content;
        if (substr(trim($actualStart), 0, 5) === '<?php') {
            if (substr($actualStart, 0, 5) !== '<?php') {
                echo "Whitespace before <?php in file: $file (Hex start: " . bin2hex(substr($actualStart, 0, 10)) . ")\n";
            }
        }
    }
}
echo "Scan complete.\n";
