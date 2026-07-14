<?php
if (!isset($currentUser)) {
    header('Location: /apprenant/dashboard');
    exit;
}

require_once dirname(__DIR__) . '/layouts/header.php';
require_once dirname(__DIR__) . '/layouts/apprenant/header.apprenant.php';
?>

<div class="panel" style="background:linear-gradient(160deg,var(--green-900),var(--green-700));color:#fff;border:none;">
  <div class="eyebrow" style="color:rgba(247,243,231,.7);">Bienvenue</div>
  <h1 style="color:#fff;font-size:22px;margin-top:4px;">Bonjour, <?php echo htmlspecialchars($currentUser['prenom'] ?? 'Apprenant'); ?>.</h1>
  
  <?php if ($currentUser['estAJour'] ?? true): ?>
    <p style="font-size:13px;color:rgba(247,243,231,.8);margin:6px 0 16px;">Votre carnet est à jour pour la semaine en cours.</p>
    <div class="kpi-label" style="color:rgba(247,243,231,.65);">Solde de cotisations</div>
    <div class="kpi-value" style="color:#fff;font-size:28px;">2 000 F</div>
  <?php else: ?>
    <p style="font-size:13px;color:#ff9e9e;margin:6px 0 16px;">Attention : vous avez des cotisations en retard à régulariser.</p>
    <div class="kpi-label" style="color:rgba(247,243,231,.65);">Solde de cotisations</div>
    <div class="kpi-value" style="color:#ff9e9e;font-size:28px;">0 F (En retard)</div>
  <?php endif; ?>
  
  <div class="kpi-sub" style="color:rgba(247,243,231,.6);">Prochaine échéance : samedi 00h00</div>
</div>

<div class="panel">
  <div class="panel-head"><h2>Dernières semaines</h2></div>
  <div class="week-strip">
    <div class="week-chip ok"><div class="num">S38</div><div class="amt">100 F</div><div class="st">✓ Payé le 28/06</div></div>
    <div class="week-chip ok"><div class="num">S39</div><div class="amt">100 F</div><div class="st">✓ Payé le 05/07</div></div>
    <div class="week-chip ok"><div class="num">S40</div><div class="amt">100 F</div><div class="st">✓ Payé le 12/07</div></div>
    <div class="week-chip"><div class="num">S41</div><div class="amt">100 F</div><div class="st">À venir</div></div>
  </div>
</div>

<div class="two-col">
  <div class="panel">
    <div class="panel-head"><h2>Historique complet</h2><a href="#">Afficher plus →</a></div>
    <table class="simple">
      <thead><tr><th>Date</th><th>Désignation</th><th>Montant</th><th>Statut</th></tr></thead>
      <tbody>
        <tr><td>12 Juil. 2026</td><td>Cotisation hebdomadaire — S40</td><td>100 F</td><td><span class="pill ok">Complet</span></td></tr>
        <tr><td>05 Juil. 2026</td><td>Cotisation hebdomadaire — S39</td><td>100 F</td><td><span class="pill ok">Complet</span></td></tr>
        <tr><td>01 Juil. 2026</td><td>Cotisation Anniversaire</td><td>2 000 F</td><td><span class="pill ok">Complet</span></td></tr>
        <tr><td>28 Juin 2026</td><td>Cotisation hebdomadaire — S38</td><td>100 F</td><td><span class="pill ok">Complet</span></td></tr>
      </tbody>
    </table>
  </div>

  <div class="panel">
    <div class="panel-head"><h2>Notifications</h2><span class="tag deces">Nouveau</span></div>
    <div class="feed-item"><div class="feed-dot alert"></div><div><div class="txt">Nouvelle campagne Cas Social</div><div class="time">Il y a 2 jours</div></div></div>
    <div class="feed-item"><div class="feed-dot"></div><div><div class="txt">Paiement S40 enregistré</div><div class="time">Il y a 3 jours</div></div></div>
    <a href="#" class="btn btn-primary" style="margin-top:12px;width:100%;">✉ Envoyer un message</a>
  </div>
</div>

<?php
require_once dirname(__DIR__) . '/layouts/apprenant/nav.apprenant.php';
require_once dirname(__DIR__) . '/layouts/footer.php';
?>
