<?php

function startSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}


function save(string $key, mixed $data): void {
    $_SESSION[$key] = $data;
}

function getData(string $key): mixed {
    return $_SESSION[$key] ?? null;
}

function destroySession(): void {
    session_destroy();
}