<?php

namespace App\Routing;

use App\Controllers\HomeController;
use App\Controllers\SUbjectController;
use App\Views\Display;

class Router
{
    public function handle(): void
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $requestUri = $_SERVER['REQUEST_URI'];
        if ($method === 'POST' && isset($_POST['_method']))
        {
            $method = strtoupper($_POST['_method']);
        }
        $this->dispatch($method, $requestUri);
    }
    private function dispatch(string $method, string $requestUri): void
    {
        switch ($method)
        {
            case 'GET':
                $this->handleGetRequests($requestUri);
                break;
            case 'POST':
                $this->handlePostRequests($requestUri);
                break;
            case 'PATCH':
                $this->handlePatchRequests($requestUri);
                break;
            case 'DELETE':
                $this->handleDeleteRequests($requestUri);
                break;
            default:
                $this->methodNotAllowed();
        }
    }
    private function handleGetRequests(string $requestUri)
    {
        switch ($requestUri)
        {
            case '/':
                HomeController::index();
                return;
            case '/subjects':
                $subjectController = new SubjectController();
                $subjectController->index();
                return;
            default:
                $this->notFound();
        }
    }
    private function handlePostRequests(string $requestUri)
    {
        // TODO
    }
    private function handlePatchRequests(string $requestUri)
    {
        // TODO
    }
    private function handleDeleteRequests(string $requestUri)
    {
        // TODO
    }
    private function notFound(): void
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        Display::message("404 Not Found");
    }
    private function methodNotAllowed(): void
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        Display::message("405 Method Not Allowed");
    }
}