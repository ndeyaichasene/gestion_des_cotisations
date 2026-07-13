<?php

function required(string $field, &$value, array &$errors): void{
    $value = trim($_POST[$field] ?? '');
    if ($value === '') {
        $errors[$field] = "Le champ $field est obligatoire.";
    }
}

function unique(string $field, string $value, array $datas, array &$errors, string $message = ""): void {

    if ($value === '') {
        return;
    }
    foreach ($datas as $data) {
        if (strtolower($data[$field]) === strtolower($value)) {
            $errors[$field] = $message ?: "Cette valeur existe déjà.";
            return;
        }
    }
}

function isEmail(string $field, string $value, array &$errors): void{
    if ($value === '') {
        return;
    }
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $errors[$field] = "Adresse email invalide.";
    }
}

function isPassword(string $field, string $value, array &$errors): void{
    if ($value === '') {
        return;
    }
    if (strlen($value) < 5) {
        $errors[$field] = "Le mot de passe doit contenir au moins 5 caractères.";
    }
}

function same(string $field, string $value, string $otherValue, array &$errors): void {
    if ($value !== $otherValue) {
        $errors[$field] = "Les deux champs ne correspondent pas.";
    }
}