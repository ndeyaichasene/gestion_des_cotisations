<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion — Carnet de Cohorte P8</title>
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="auth-page">
  <div class="auth-card">

    <div class="auth-hero">
      <div class="logo"><span class="mark">CC</span> Carnet de Cohorte</div>
      <div>
        <h1>L'excellence dans la tenue de comptes.</h1>
        <p>Suivez les cotisations hebdomadaires et les campagnes ponctuelles de votre cohorte, en toute transparence, du premier au dernier mois de formation.</p>
      </div>
      <div class="signature">Carnet digital — cohorte active</div>
    </div>

    <div class="auth-form">
      <h2>Connexion à votre espace</h2>
      <p class="hint">Renseignez vos identifiants pour accéder au tableau de bord.</p>
      <?php require_once dirname(__DIR__) . '/components/error.php'; ?>
      
      <?php
      $success = getData('success_message');
      if ($success) {
          echo '<div style="background-color: var(--green-soft); color: var(--green-700); padding: 12px; border-radius: var(--radius-sm); margin-bottom: 16px; border: 1px solid var(--green-500); font-size: 13px; font-weight: 500;">' . htmlspecialchars($success) . '</div>';
          save('success_message', null);
      }
      ?>

      <form method="POST" action="/login">
        <div class="field">
          <label for="email">Email</label>
          <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" placeholder="ex : awa.ndiaye@cohorte.com" autocomplete="username">
        </div>
        <div class="field">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" placeholder="*******" autocomplete="current-password">
        </div>

        <div class="field-row">
          <label><input type="checkbox" name="remember"> Se souvenir de moi</label>
          <a href="#" class="btn-ghost">Mot de passe oublié ?</a>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter →</button>
          
      </form>

      <p class="auth-foot">Besoin d'un compte ? <a href="/inscription" class="btn-ghost">S'inscrire</a></p>

      <div style="margin-top: 15px; padding: 10px; background: var(--paper-soft); border-radius: var(--radius-sm); border: 1px solid var(--line); font-size: 11px;">
        <strong>Comptes de test (Mot de passe: Passer123) :</strong><br>
        • Gérant : <code>awa.ndiaye@cohorte.com</code><br>
        • Apprenant : <code>fatou.sarr@cohorte.com</code>
      </div>

      <div class="auth-help">
        Portail partagé par les Gérants, les Coachs et les Apprenants de la cohorte active.
      </div>
    </div>

  </div>
</div>

</body>
</html>
