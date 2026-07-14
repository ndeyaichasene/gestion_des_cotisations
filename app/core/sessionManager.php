<?php

function startSession(): void 
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}


function initUtilisateurs(string $email, string $password): ?array
{
    startSession();

    if (!isset($_SESSION["users"])) {

        $_SESSION["users"] = [
            [
                "id" => 1,
                "nom" => "Ndiaye",
                "prenom" => "Awa",
                "email" => "awa.ndiaye@cohorte.com",
                "motDePasse" => "Passer123",
                "role" => "GERANT",
                "dateInscription" => "2026-01-10",
                "telephone" => "771234567",
                "estActif" => true,
                "estAJour" => true
            ],

            [
                "id" => 2,
                "nom" => "Diop",
                "prenom" => "Moussa",
                "email" => "moussa.diop@cohorte.com",
                "motDePasse" => "Passer123",
                "role" => "COACH",
                "dateInscription" => "2026-01-12",
                "telephone" => "771234568",
                "estActif" => true,
                "estAJour" => null
            ],

            [
                "id" => 3,
                "nom" => "Sarr",
                "prenom" => "Fatou",
                "email" => "fatou.sarr@cohorte.com",
                "motDePasse" => "Passer123",
                "role" => "APPRENANT",
                "dateInscription" => "2026-01-15",
                "telephone" => "771234569",
                "estActif" => true,
                "estAJour" => true
            ]
        ];
    }


    $users = $_SESSION["users"];

    foreach ($users as $user) {

        if (strtolower($user["email"]) === strtolower($email) 
            && $user["motDePasse"] === $password) {

            return $user;
        }
    }

    return null;
}



function save(string $key, mixed $data): void
{
    startSession();
    $_SESSION[$key] = $data;
}



function getData(string $key): mixed
{
    startSession();
    return $_SESSION[$key] ?? null;
}



function removeData(string $key): void
{
    startSession();
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}



function destroySession(): void
{
    startSession();
    session_destroy();
}