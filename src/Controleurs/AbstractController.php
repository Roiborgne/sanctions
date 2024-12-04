<?php

namespace App\Controleurs;
use Doctrine\ORM\EntityManager;


abstract class AbstractController
{
    public function render(string $view, array $data = []): void
    {
        extract($data);
        
        ob_start();
        require __DIR__ . '/../../views/' . $view . '.php';
        $content = ob_get_clean();
        
        require __DIR__ . '/../../views/base.php';
    }

    public function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    public function renderError(int $code = 404, string $message = null): void
    {
        http_response_code($code);
        
        if ($code === 404) {
            $this->render('error/404');
            exit;
        }
    }
} 