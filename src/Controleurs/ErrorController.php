<?php

namespace App\Controleurs;

use App\Controleurs\AbstractController;

class ErrorController extends AbstractController
{
    public function error404(): void
    {
        $this->renderError(404);
    }
} 