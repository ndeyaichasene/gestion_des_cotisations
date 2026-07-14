<?php

function dashboard()
{
    require_once dirname(__DIR__) . '/core/sessionManager.php';
    require_once dirname(__DIR__) . '/models/user.model.php';

    startSession();
    $currentUser = getData('user');
    $apprenants = getAllApprenants();

    $activePage = 'dashboard';
    $pageTitle = 'Tableau de bord — Gérant';

    require_once dirname(__DIR__) . '/views/gerant/dashboard.php';
}

function apprenants()
{
    require_once dirname(__DIR__) . '/core/sessionManager.php';
    require_once dirname(__DIR__) . '/models/user.model.php';
    require_once dirname(__DIR__) . '/core/validator.php';

    startSession();
    $currentUser = getData('user');
    $errors = [];
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'ajouter') {
            $nom = '';
            $prenom = '';
            $telephone = '';
            $email = '';
            
            required("nom", $nom, $errors);
            required("prenom", $prenom, $errors);
            required("telephone", $telephone, $errors);
            required("email", $email, $errors);

            isEmail("email", $email, $errors);
            if (empty($errors['email'])) {
                $users = getAllUsers();
                unique("email", $email, $users, $errors, "Cette adresse email est déjà utilisée.");
            }

            if (empty($errors)) {
                $newUser = [
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "telephone" => $telephone,
                    "email" => $email,
                    "motDePasse" => "Passer123", // default password
                    "role" => "APPRENANT",
                    "dateInscription" => date("Y-m-d"),
                    "estActif" => true,
                    "estAJour" => true
                ];

                saveInscription($newUser);
                save('success_message', "Apprenant ajouté avec succès.");
                header('Location: /gerant/apprenants');
                exit;
            }
        } elseif ($action === 'abandonner') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                modifierStatutActif($id, false);
                save('success_message', "L'apprenant a été marqué comme ayant abandonné.");
            }
            header('Location: /gerant/apprenants');
            exit;
        } elseif ($action === 'reactiver') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                modifierStatutActif($id, true);
                save('success_message', "Le statut de l'apprenant a été réactivé.");
            }
            header('Location: /gerant/apprenants');
            exit;
        }
    }

    $apprenants = getAllApprenants();
    $activePage = 'apprenants';
    $pageTitle = 'Cotisants — Gérant';
    
    $success = getData('success_message');
    if ($success) {
        save('success_message', null); // clear
    }

    require_once dirname(__DIR__) . '/views/gerant/listeApp.php';
}
