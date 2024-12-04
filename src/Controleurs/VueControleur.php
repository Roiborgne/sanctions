<?php

namespace App\Controleurs;

class VueControleur extends AbstractController
{
    public function inscription(){
        $this->render('compte/creer');
    }
    public function connexion(){
        $this->render('compte/connexion');
    }
    public function promotion(){
        $this->render('/promotion/ajouter');
    }
}