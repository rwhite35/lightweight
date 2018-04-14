<?php 
/**
 * Global Configurations Array
 * Array of configurations needing global scope.
 * Note the path is relative to the app/index.php root directory
 */
return [
    'notification_data' => [        // NoSql flat file storage
        'data_mapper_path' => 'data/notifications.php',
    ]
];


?>