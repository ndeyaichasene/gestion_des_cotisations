<?php
if (!isset($apprenants)) {
    header('Location: /gerant/apprenants');
    exit;
}

require_once dirname(__DIR__) . '/layouts/header.php';
require_once dirname(__DIR__) . '/layouts/gerant/header.gerant.php';

$totalApprenants = count($apprenants);
$actifsCount = 0;
foreach ($apprenants as $app) {
    if ($app['estActif']) {
        $actifsCount++;
    }
}
?>

<div class="page-head">
  <div class="eyebrow">Gestion de la classe</div>
  <h1><?php echo $totalApprenants; ?> apprenant(s) inscrit(s)</h1>
  <p><?php echo $actifsCount; ?> actif(s) — Ajout manuel, auto-inscription ou import Excel/CSV.</p>
</div>

<?php if ($success): ?>
    <div style="background-color: var(--green-soft); color: var(--green-700); padding: 12px; border-radius: var(--radius-sm); margin-bottom: 16px; border: 1px solid var(--green-500); font-size: 13px; font-weight: 500;">
        <?php echo htmlspecialchars($success); ?>
    </div>
<?php endif; ?>

<!-- Inscription Manuelle (Trello Task) -->
<div class="panel">
  <div class="panel-head">
    <h2>Inscription manuelle d'un apprenant</h2>
  </div>
  
  <?php if (!empty($errors)): ?>
      <div style="background-color: var(--red-soft); color: var(--red); padding: 12px; border-radius: var(--radius-sm); margin-bottom: 16px; border: 1px solid var(--red); font-size: 13px;">
          <ul style="margin: 0; padding-left: 20px;">
              <?php foreach ($errors as $err): ?>
                  <li><?php echo htmlspecialchars($err); ?></li>
              <?php endforeach; ?>
          </ul>
      </div>
  <?php endif; ?>

  <form action="/gerant/apprenants" method="POST" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
    <input type="hidden" name="action" value="ajouter">
    
    <div class="field" style="flex: 1; min-width: 130px; margin-bottom: 0;">
      <label for="prenom">Prénom</label>
      <input type="text" id="prenom" name="prenom" placeholder="Prénom" value="<?php echo htmlspecialchars($_POST['prenom'] ?? ''); ?>" required>
    </div>
    
    <div class="field" style="flex: 1; min-width: 130px; margin-bottom: 0;">
      <label for="nom">Nom</label>
      <input type="text" id="nom" name="nom" placeholder="Nom" value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>" required>
    </div>
    
    <div class="field" style="flex: 1; min-width: 130px; margin-bottom: 0;">
      <label for="telephone">Téléphone</label>
      <input type="tel" id="telephone" name="telephone" placeholder="77 123 45 67" value="<?php echo htmlspecialchars($_POST['telephone'] ?? ''); ?>" required>
    </div>
    
    <div class="field" style="flex: 1.5; min-width: 180px; margin-bottom: 0;">
      <label for="email">Adresse e-mail</label>
      <input type="email" id="email" name="email" placeholder="exemple@cohorte.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
    </div>
    
    <button type="submit" class="btn btn-primary" style="width: auto; padding: 12px 24px; height: 42px; margin-bottom: 0;">
      + Inscrire
    </button>
  </form>
</div>

<!-- Lister les apprenants (Trello Task) -->
<div class="panel">
  <div class="panel-head">
    <h2>Liste des apprenants</h2>
  </div>
  
  <div class="table-scroll">
    <table class="simple">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Téléphone</th>
          <th>E-mail</th>
          <th>Date d'inscription</th>
          <th>Statut</th>
          <th style="text-align: right;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($apprenants)): ?>
          <tr>
            <td colspan="6" style="text-align: center; color: var(--ink-soft); padding: 24px;">Aucun apprenant n'est enregistré.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($apprenants as $app): ?>
            <tr style="<?php echo !$app['estActif'] ? 'opacity: 0.6;' : ''; ?>">
              <td>
                <strong><?php echo htmlspecialchars($app['prenom'] . ' ' . $app['nom']); ?></strong>
              </td>
              <td><?php echo htmlspecialchars($app['telephone'] ?? '-'); ?></td>
              <td><code><?php echo htmlspecialchars($app['email']); ?></code></td>
              <td><?php echo htmlspecialchars(date("d/m/Y", strtotime($app['dateInscription']))); ?></td>
              <td>
                <?php if (!$app['estActif']): ?>
                  <span class="tag deces" style="font-weight: 600;">Abandon</span>
                <?php else: ?>
                  <span class="pill <?php echo $app['estAJour'] ? 'ok' : 'retard'; ?>">
                    <?php echo $app['estAJour'] ? 'à jour' : 'en retard'; ?>
                  </span>
                <?php endif; ?>
              </td>
              <td style="text-align: right;">
                <!-- Marquer abandon (Trello Task) -->
                <?php if ($app['estActif']): ?>
                  <form action="/gerant/apprenants" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir marquer <?php echo htmlspecialchars($app['prenom'] . ' ' . $app['nom']); ?> comme abandon ?');">
                    <input type="hidden" name="action" value="abandonner">
                    <input type="hidden" name="id" value="<?php echo $app['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-danger" style="background-color: var(--red); font-size: 11px;">
                      Marquer abandon
                    </button>
                  </form>
                <?php else: ?>
                  <form action="/gerant/apprenants" method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="reactiver">
                    <input type="hidden" name="id" value="<?php echo $app['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-secondary" style="font-size: 11px;">
                      Réactiver
                    </button>
                  </form>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php
require_once dirname(__DIR__) . '/layouts/gerant/nav.gerant.php';
require_once dirname(__DIR__) . '/layouts/footer.php';
?>
