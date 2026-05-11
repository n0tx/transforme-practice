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
    case '/books/edit':
        $bookController->edit();
        break;
    case '/books/update':
        $bookController->update();
        break;

    // --- REST API ROUTES ---
    case '/api/books':
        require_once __DIR__ . '/../controllers/ApiBookController.php';
        $apiBookController = new ApiBookController();

        // Di sinilah kita mengecek Method: GET, POST, PUT, atau DELETE
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                if (isset($_GET['id'])) {
                    $apiBookController->show((int)$_GET['id']);
                } else {
                    $apiBookController->index();
                }
                break;

            case 'POST':
                $apiBookController->store();
                break;

            case 'PUT':
                if (isset($_GET['id'])) {
                    $apiBookController->update((int)$_GET['id']);
                } else {
                    http_response_code(400);
                    echo json_encode(["message" => "ID buku diperlukan!"]);
                }
                break;

            case 'DELETE':
                // Nanti kita arahkan ke: $apiBookController->destroy($id);
                break;

            default:
                http_response_code(405); // Method Not Allowed
                echo json_encode(["message" => "Method not allowed"]);
                break;
        }
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
