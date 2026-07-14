<?php
require_once dirname(__DIR__) . '/core/sessionManager.php';

function initialiserUsersSiVide(): void
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
}

function getUtilisateurByEmail(string $email): ?array
{
    initialiserUsersSiVide();
    $users = $_SESSION["users"];
    foreach ($users as $user) {
        if (strtolower($user["email"]) === strtolower($email)) {
            return $user;
        }
    }
    return null;
}

function saveInscription(array $userArray): void
{
    initialiserUsersSiVide();
    
    // Auto-increment ID
    $maxId = 0;
    foreach ($_SESSION["users"] as $u) {
        if ($u["id"] > $maxId) {
            $maxId = $u["id"];
        }
    }
    
    $userArray["id"] = $maxId + 1;
    $userArray["role"] = $userArray["role"] ?? "APPRENANT";
    $userArray["dateInscription"] = $userArray["dateInscription"] ?? date("Y-m-d");
    $userArray["estActif"] = isset($userArray["estActif"]) ? (bool)$userArray["estActif"] : true;
    $userArray["estAJour"] = isset($userArray["estAJour"]) ? (bool)$userArray["estAJour"] : true;
    
    $_SESSION["users"][] = $userArray;
}

function getAllUsers(): array
{
    initialiserUsersSiVide();
    return $_SESSION["users"];
}

function getAllApprenants(): array
{
    initialiserUsersSiVide();
    $apprenants = [];
    foreach ($_SESSION["users"] as $user) {
        if ($user["role"] === "APPRENANT") {
            $apprenants[] = $user;
        }
    }
    return $apprenants;
}

function modifierStatutActif(int $id, bool $estActif): void
{
    initialiserUsersSiVide();
    foreach ($_SESSION["users"] as &$user) {
        if ($user["id"] === $id) {
            $user["estActif"] = $estActif;
            break;
        }
    }
}
