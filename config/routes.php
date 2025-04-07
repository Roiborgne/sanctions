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
    '/etudiant/index' => ['EtudiantControleur', 'index'],
    //Sanction
    '/sanction'=> ['SanctionControleur', 'index'],
    '/sanction/create'=> ['SanctionControleur', 'create'],
    //legal
    '/mentions' => ['HomeController', 'legal']
]; 