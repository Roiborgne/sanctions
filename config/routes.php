<?php

return [
    //index
    '/' => ['HomeController', 'index'],
    //compte
    '/compte' => ['AuthentificationControleur', 'index'],
    '/compte/creer' => ['AuthentificationControleur', 'creer'],
    '/compte/connexion' => ['AuthentificationControleur', 'connecter'],
    '/compte/disconnect' => ['AuthentificationControleur', 'deconnecter'],
    //vue
    '/inscription' => ['VueControleur', 'inscription'],
    '/connexion' => ['VueControleur', 'connexion'],
    '/promotion' => ['VueControleur', 'promotion'],
    //promotion
    '/promotion/ajouter' => ['PromotionControleur', 'ajouter'],
    //legal
    '/mentions' => ['HomeController', 'legal']
]; 