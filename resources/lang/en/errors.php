<?php

return [
    \Constants::METHOD_NOT_ALLOWED => [
        'title' => 'Method not allowed',
        'message' => 'Be right back',
    ],
    \Constants::UNAUTHORIZED_CODE => [
        'title' => 'Access denied',
        'message' => 'The request has not been applied because it lacks valid authentication credentials for the target resource'
    ],
    \Constants::FORBIDDEN_CODE => [
        'title' => 'Forbidden',
        'message' => 'You do not have permission to access these resources'
    ],
    \Constants::NOT_FOUND_CODE => [
        'title' => 'Not found',
        'message' => 'We could not find the page you were looking for'
    ],
    \Constants::ERROR_CODE => [
        'title' => 'Internal error',
        'message' => 'Some error occurred. View error log to learn more',
    ],
    \Constants::MAINTENANCE_MODE => [
        'title' => 'Maintenance mode',
        'message' => 'This site is on maintenance mode. We will come back soon',
    ],
];