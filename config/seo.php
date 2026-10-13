<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Backlink Health Checker
    |--------------------------------------------------------------------------
    |
    | Settings for the SEO backlink monitor, which verifies tracked backlinks
    | by fetching each source page and confirming it still links to your site.
    |
    */

    // Seconds to wait for each source page before giving up.
    'backlink_check_timeout' => env('SEO_BACKLINK_TIMEOUT', 15),

    // Identify the monitor politely. Some sites block generic/no user agents.
    'backlink_check_user_agent' => env(
        'SEO_BACKLINK_USER_AGENT',
        'Mozilla/5.0 (compatible; SkyWebBacklinkMonitor/1.0; +https://skywebinnovations.com)'
    ),

    // Max backlinks verified per health-check run (keeps the request from timing out).
    'backlink_check_batch_size' => env('SEO_BACKLINK_BATCH', 50),
];
