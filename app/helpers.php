<?php

if (!function_exists('clean')) {
    function clean($html, $config = 'default')
    {
        // If mews/purifier is installed, use it
        if (class_exists('\Mews\Purifier\Facades\Purifier')) {
            try {
                return \Mews\Purifier\Facades\Purifier::clean($html, $config);
            } catch (\Exception $e) {
                \Log::warning('Purifier failed: ' . $e->getMessage());
            }
        }

        // Fallback: Allow more tags and attributes
        $allowed_tags = '<p><br><strong><b><em><i><u><h1><h2><h3><h4><h5><h6><ul><ol><li><a><img><blockquote><code><pre><table><thead><tbody><tr><th><td><hr><span><div>';

        // Strip tags but keep allowed ones
        $cleaned = strip_tags($html, $allowed_tags);

        // Allow basic attributes on specific tags (this is a basic approach)
        // For production, use mews/purifier instead
        return $cleaned;
    }
}