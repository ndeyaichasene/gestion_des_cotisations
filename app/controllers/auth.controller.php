<?php

function login()
{
    require_once dirname(__DIR__) . '/core/sessionManager.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        require_once dirname(__DIR__) . '/core/validator.php';

        $errors = [];

        required("email", $email, $errors);
        required("password", $password, $errors);
        isEmail("email", $email, $errors);


        if (!empty($errors)) {
            require_once dirname(__DIR__) . '/views/auth/login.php';
            return;
        }

        $user = initUtilisateurs($email, $password);

        if ($user === null) {
            $errors["login"] = "Identifiants incorrects";

            require_once dirname(__DIR__) . '/views/auth/login.php';
            return;
        }

        startSession();

        unset($user['motDePasse']);

        save('user', $user);

        switch ($user['role']) {

            case 'GERANT':
                header('Location: /gerant/dashboard');
                break;

            case 'COACH':
                header('Location: /coach/dashboard');
                break;

            case 'APPRENANT':
                header('Location: /apprenant/dashboard');
                break;
        }

        exit;


    } else {

        require_once dirname(__DIR__) . '/views/auth/login.php';
    }
}

function logout()
{
    require_once dirname(__DIR__) . '/core/sessionManager.php';

    startSession();

    destroySession();

    header('Location: /login');
    exit;
}

function inscription()
{
    require_once dirname(__DIR__) . '/core/sessionManager.php';
    require_once dirname(__DIR__) . '/models/user.model.php';
    require_once dirname(__DIR__) . '/core/validator.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = '';
        $prenom = '';
        $telephone = '';
        $email = '';
        $password = '';
        $confirmPassword = '';
        $errors = [];

        required("nom", $nom, $errors);
        required("prenom", $prenom, $errors);
        required("telephone", $telephone, $errors);
        required("email", $email, $errors);
        required("password", $password, $errors);
        required("confirmPassword", $confirmPassword, $errors);

        isEmail("email", $email, $errors);
        if (empty($errors['email'])) {
            $users = getAllUsers();
            unique("email", $email, $users, $errors, "Cette adresse email est déjà utilisée.");
        }

        isPassword("password", $password, $errors);
        if (empty($errors['password'])) {
            same("confirmPassword", $confirmPassword, $password, $errors);
        }

        if (!empty($errors)) {
            require_once dirname(__DIR__) . '/views/auth/inscription.php';
            return;
        }

        $newUser = [
            "nom" => $nom,
            "prenom" => $prenom,
            "telephone" => $telephone,
            "email" => $email,
            "motDePasse" => $password,
            "role" => "APPRENANT",
            "dateInscription" => date("Y-m-d"),
            "estActif" => true,
            "estAJour" => true
        ];

        saveInscription($newUser);

        // Flash message
        save('success_message', "Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.");

        header('Location: /login');
        exit;
    } else {
        require_once dirname(__DIR__) . '/views/auth/inscription.php';
    }
}