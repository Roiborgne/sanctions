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
    //promotion
    '/promotion/ajouter' => ['PromotionControleur', 'ajouter'],
    //étudiant
    '/etudiant/importer' => ['EtudiantControleur', 'importer'],
    //legal
    '/mentions' => ['HomeController', 'legal']
]; 