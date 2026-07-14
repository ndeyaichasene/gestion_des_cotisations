<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription — Carnet de Cohorte P8</title>
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="auth-page">
  <div class="auth-card">

    <div class="auth-hero">
      <div class="logo">
        <span class="mark">CC</span> Carnet de Cohorte
      </div>

      <div>
        <h1>Rejoignez votre cohorte.</h1>
        <p>
          Créez votre compte afin de suivre vos cotisations,
          consulter l'historique des paiements et participer
          aux différentes campagnes organisées au sein de votre cohorte.
        </p>
      </div>

      <div class="signature">
        Carnet digital — cohorte active
      </div>
    </div>

    <div class="auth-form">

      <h2>Créer un compte</h2>
      <p class="hint">
        Remplissez les informations ci-dessous.
      </p>

      <?php require_once dirname(__DIR__) . '/components/error.php'; ?>

      <form action="/inscription" method="POST">

        <div class="field">
          <label for="nom">Nom</label>
          <input
            type="text"
            id="nom"
            name="nom"
            placeholder="Votre nom"
            value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>"
            required>
        </div>

        <div class="field">
          <label for="prenom">Prénom</label>
          <input
            type="text"
            id="prenom"
            name="prenom"
            placeholder="Votre prénom"
            value="<?php echo htmlspecialchars($_POST['prenom'] ?? ''); ?>"
            required>
        </div>

        <div class="field">
          <label for="telephone">Téléphone</label>
          <input
            type="tel"
            id="telephone"
            name="telephone"
            placeholder="77 123 45 67"
            value="<?php echo htmlspecialchars($_POST['telephone'] ?? ''); ?>"
            required>
        </div>

        <div class="field">
          <label for="email">Adresse e-mail</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            placeholder="exemple@cohorte.com" 
            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
            required>
        </div>

        <div class="field">
          <label for="password">Mot de passe</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
            required>
        </div>

        <div class="field">
          <label for="confirmPassword">Confirmer le mot de passe</label>
          <input
            type="password"
            id="confirmPassword"
            name="confirmPassword"
            placeholder="••••••••"
            required>
        </div>

        <button type="submit" class="btn btn-primary">
          Créer mon compte
        </button>

      </form>

      <p class="auth-foot">
        Vous possédez déjà un compte ?
        <a href="/login" class="btn-ghost">
          Se connecter
        </a>
      </p>

      <div class="auth-help">
        Les comptes sont validés par l'administration de la cohorte.
      </div>

    </div>

  </div>
</div>

</body>
</html>
