<?php
if (!isset($apprenants)) {
    header('Location: /gerant/dashboard');
    exit;
}

require_once dirname(__DIR__) . '/layouts/header.php';
require_once dirname(__DIR__) . '/layouts/gerant/header.gerant.php';

// Calculate dynamic stats
$totalApprenants = count($apprenants);
$retardsCount = 0;
foreach ($apprenants as $app) {
    if ($app['estActif'] && !$app['estAJour']) {
        $retardsCount++;
    }
}
?>

<div class="page-head">
  <div class="eyebrow">Gérant — Tableau de bord</div>
  <h1>Bonjour, <?php echo htmlspecialchars($currentUser['prenom'] ?? 'Gérant'); ?></h1>
  <p>Vue d'ensemble de la collecte pour la Cohorte P8</p>
</div>

<div class="kpi-grid">
  <div class="kpi-card dark">
    <div class="kpi-label">Recouvré ce mois</div>
    <div class="kpi-value">18 500 F</div>
    <div class="kpi-sub">sur 18 500 F attendus</div>
  </div>
  <div class="kpi-card">
    <div class="kpi-label">Nouveaux paiements</div>
    <div class="kpi-value">4 Éléments</div>
    <div class="kpi-sub">depuis hier</div>
  </div>
  <div class="kpi-card">
    <div class="kpi-label">Campagnes ouvertes</div>
    <div class="kpi-value">03 Actives</div>
    <div class="kpi-sub">1 décès, 1 anniversaire, 1 autre</div>
  </div>
  <div class="kpi-card <?php echo ($retardsCount > 0) ? 'alert' : ''; ?>">
    <div class="kpi-label">Retards actifs</div>
    <div class="kpi-value"><?php echo sprintf("%02d", $retardsCount); ?></div>
    <div class="kpi-sub">apprenants à relancer</div>
  </div>
</div>

<div class="two-col">
  <div>
    <div class="panel">
      <div class="panel-head">
        <h2>Tableau croisé de cotisation</h2>
        <a href="/gerant/apprenants">Gérer la classe →</a>
      </div>
      <div class="table-scroll">
        <table class="cross">
          <thead>
            <tr>
              <th class="who">Apprenant</th>
              <th>Semaine 38</th>
              <th>Semaine 39</th>
              <th>Semaine 40</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($apprenants)): ?>
              <tr>
                <td colspan="4" style="text-align: center; color: var(--ink-soft);">Aucun apprenant inscrit pour le moment.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($apprenants as $app): ?>
                <tr style="<?php echo !$app['estActif'] ? 'opacity: 0.6;' : ''; ?>">
                  <td class="who">
                    <?php echo htmlspecialchars($app['prenom'] . ' ' . $app['nom']); ?>
                    <?php if (!$app['estActif']): ?>
                      <span class="tag deces" style="font-size: 9px; padding: 2px 6px; margin-left: 5px;">Abandon</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (!$app['estActif']): ?>
                      <span style="color: var(--ink-soft);">-</span>
                    <?php else: ?>
                      <span class="pill <?php echo $app['estAJour'] ? 'ok' : 'retard'; ?>"><?php echo $app['estAJour'] ? '✓' : '✕'; ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (!$app['estActif']): ?>
                      <span style="color: var(--ink-soft);">-</span>
                    <?php else: ?>
                      <span class="pill <?php echo $app['estAJour'] ? 'ok' : 'retard'; ?>"><?php echo $app['estAJour'] ? '✓' : '✕'; ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (!$app['estActif']): ?>
                      <span style="color: var(--ink-soft);">-</span>
                    <?php else: ?>
                      <span class="pill <?php echo $app['estAJour'] ? 'ok' : 'retard'; ?>"><?php echo $app['estAJour'] ? '✓' : '✕'; ?></span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <h2>Campagnes en cours</h2>
        <a href="#">Nouvelle campagne +</a>
      </div>
      <table class="simple">
        <thead><tr><th>Campagne</th><th>Type</th><th>Collecté</th><th>Échéance</th></tr></thead>
        <tbody>
          <tr><td>Cas social — Famille Koné</td><td><span class="tag deces">Décès</span></td><td>28 000 F</td><td>12/07</td></tr>
          <tr><td>Anniversaires de juillet</td><td><span class="tag anniversaire">Anniversaire</span></td><td>18 000 F</td><td>Fin de mois</td></tr>
          <tr><td>Sortie pédagogique</td><td><span class="tag autre">Autre</span></td><td>9 000 F</td><td>20/07</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <div>
    <div class="panel">
      <div class="panel-head"><h2>Activité récente</h2></div>
      <div class="feed-item">
        <div class="feed-dot"></div>
        <div><div class="txt"><strong>Fatou Sarr</strong> est à jour de ses cotisations</div><div class="time">Récemment</div></div>
      </div>
      <div class="feed-item">
        <div class="feed-dot alert"></div>
        <div><div class="txt">Suivi actif pour <strong><?php echo $totalApprenants; ?> apprenant(s)</strong></div><div class="time">Mise à jour session</div></div>
      </div>
    </div>

    <div class="panel dark-panel" style="background:var(--green-900);color:var(--paper-soft);border:none;">
      <div class="kpi-label" style="color:rgba(247,243,231,.65);">Solde trésorerie</div>
      <div class="kpi-value" style="color:#fff;">60 000 F</div>
      <a href="#" class="btn btn-primary" style="margin-top:14px;background:var(--gold);color:var(--green-900);">+ Nouveau versement</a>
    </div>
  </div>
</div>

<?php
require_once dirname(__DIR__) . '/layouts/gerant/nav.gerant.php';
require_once dirname(__DIR__) . '/layouts/footer.php';
?>
