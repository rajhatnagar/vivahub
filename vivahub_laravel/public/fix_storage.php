<?php
$target = __DIR__ . '/../storage/app/public';
$shortcut = __DIR__ . '/storage';

if (file_exists($shortcut)) {
    echo "Symlink already exists at $shortcut";
} else {
    if (symlink($target, $shortcut)) {
        echo "Symlink created successfully: $shortcut -> $target";
    } else {
        echo "Failed to create symlink. Check permissions.";
        // Fallback: copy if symlink fails (optional, but not recommended for storage)
    }
}
?>
