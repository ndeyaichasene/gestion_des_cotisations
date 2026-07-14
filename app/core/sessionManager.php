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
                "estActif" => true,
                "estAJour" => true
            ]
        ];
    }


    $users = $_SESSION["users"];

    foreach ($users as $user) {

        if ($user["email"] === $email 
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



function destroySession(): void
{
    startSession();
    session_destroy();
}