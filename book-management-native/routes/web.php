<?php

require_once __DIR__ . '/../controllers/BookController.php';

$bookController = new BookController();

// Basic router switch
/** @var string $path */
switch ($path) {
    case '':
    case '/':
    case '/books':
        $bookController->index();
        break;
    case '/books/create':
        $bookController->create();
        break;
    case '/books/store':
        $bookController->store();
        break;
    case '/books/delete':
        $bookController->delete();
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
