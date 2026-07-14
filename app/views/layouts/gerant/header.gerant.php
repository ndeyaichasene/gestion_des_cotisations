<div class="shell">
  <!-- Sidebar (desktop) -->
  <aside class="sidebar">
    <div>
      <div class="logo"><span class="mark">CC</span> Carnet de Cohorte</div>
      <nav>
        <a href="/gerant/dashboard" class="<?php echo ($activePage === 'dashboard') ? 'active' : ''; ?>"><span class="ic">▦</span> Dashboard</a>
        <a href="/gerant/apprenants" class="<?php echo ($activePage === 'apprenants') ? 'active' : ''; ?>"><span class="ic">◔</span> Cotisants</a>
        <a href="#"><span class="ic">◈</span> Campagnes</a>
        <a href="#"><span class="ic">✒</span> Historique</a>
      </nav>
    </div>
    
    <div style="margin-top: auto; padding-top: 15px;">
      <div class="foot" style="border-top: 1px solid rgba(247,243,231,.15); padding-top: 10px; margin-bottom: 10px;">
        Rôle : Gérant<br>
        <?php echo htmlspecialchars(($currentUser['prenom'] ?? '') . ' ' . ($currentUser['nom'] ?? '')); ?>
      </div>
      <a href="/logout" class="btn btn-logout" style="width: 100%; justify-content: center;">
        ⎋ Déconnexion
      </a>
    </div>
  </aside>

  <div style="flex:1;display:flex;flex-direction:column;min-width:0;">
    <!-- Topbar -->
    <header class="topbar">
      <div class="search"><input type="text" placeholder="Rechercher un apprenant..."></div>
      <div class="actions">
        <div class="bell">🔔<span class="dot"></span></div>
        <div class="avatar-chip">
          <div class="avatar"><?php 
            $initials = strtoupper(substr($currentUser['prenom'] ?? '', 0, 1) . substr($currentUser['nom'] ?? '', 0, 1));
            echo htmlspecialchars($initials);
          ?></div>
          <div class="who">
            <div class="name"><?php echo htmlspecialchars(($currentUser['prenom'] ?? '') . ' ' . ($currentUser['nom'] ?? '')); ?></div>
            <div class="role">Gérant</div>
          </div>
        </div>
      </div>
    </header>

    <main class="main">
