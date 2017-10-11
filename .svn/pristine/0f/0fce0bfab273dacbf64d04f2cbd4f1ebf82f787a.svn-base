<?php
$env = env('APP_ENV', 'local');

switch ($env) {
    case 'local':
        $app_path = 'http://estone.local.com';
        break;
    case 'testing':
        $app_path = 'http://estone.test.yufu365.com';
        break;
    case 'production':
        $app_path = 'http://estone.yufu365.com';
        break;
    default:
        $app_path = 'http://estone.local.com';
        break;
}

return [
    '__ROOT__' => $app_path
];