<?php
$html = file_get_contents('C:\Users\devry\.gemini\antigravity-ide\brain\037c1ba3-dce0-4b9f-a314-c45b80024365\.system_generated\steps\244\content.md');

$json = null;
if (preg_match_all('/<script\b[^>]*>(.*?)<\/script>/is', $html, $scripts)) {
    foreach ($scripts[1] as $script) {
        $script = trim($script);
        if (strpos($script, 'occurrences.shared') !== false) {
            $json = $script;
            break;
        }
    }
}

if ($json) {
    $data = json_decode($json, true);
    if ($data !== null) {
        $sharedError = $data['props']['sharedError'] ?? null;
        if ($sharedError) {
            echo "--- SHARED ERROR STRUCT ---\n";
            echo json_encode($sharedError['error'] ?? $sharedError, JSON_PRETTY_PRINT) . "\n";
        }
    }
}
