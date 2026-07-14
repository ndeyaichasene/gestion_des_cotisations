<?php

function dashboard()
{
    require_once dirname(__DIR__) . '/core/sessionManager.php';
    require_once dirname(__DIR__) . '/models/user.model.php';

    startSession();
    $currentUser = getData('user');

    $activePage = 'dashboard';
    $pageTitle = 'Mon Espace — Apprenant';

    require_once dirname(__DIR__) . '/views/apprenant/dashboard.php';
}
