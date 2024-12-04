<?php

namespace App\Controleurs;

use App\Controleurs\AbstractController;

class HomeController extends AbstractController
{
    public function index(): void
    {
        $this->render('home/accueil');
    }

    public function legal(): void
    {
        $this->render('home/mentions');
    }
} 