<?php 
/**
 * Module namespaces to pass to the SPL autoloader on initialization
 * This should list all modules, plugins, libraries you intend 
 * to call by namespace.
 * 
 * Use double backslashes if module has a subclass
 * ie Namespace\\Class\\Service
 * 
 * @return array namespaces to load
 */
return [
    // list all modules, plugins, libraries to load in this array
    'modules' => [
        'Notifications',
        'Lightweight\\Application',
    ],
    
    // This should be an array of paths in which modules reside.
    // If a string key is provided, the listener will consider that a module
    // namespace, the value of that key the specific path to that module's
    // Module class.
    'modules_path' => [
        './module',
        './vendor'
   ],
    
    // An array of paths from which to glob configuration files after
    // modules are loaded. These effectively override configuration
    // provided by modules themselves. Paths may use GLOB_BRACE notation.
    'config_glob_paths' => [
        realpath(__DIR__) . '/{{,*.}global,{,*.}local}.php',
    ],
    
    // Whether or not to enable a configuration cache.
    // If enabled, the merged configuration will be cached and used in
    // subsequent requests.
    'config_cache_enabled' => true,
];

?>