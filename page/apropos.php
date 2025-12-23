<?php
// apropos.php
// Page "À propos" en PHP avec inclusions header/footer (UTF-8).
// Personnalise les valeurs ci-dessous, ou modifie $headerPath/$footerPath
// pour pointer vers tes fichiers d'inclusion existants.

$siteInfo = [
    'title' => "À propos — Restaurant",
    'description' => "Bienvenue sur le site du Restaurant. Nous proposons une cuisine faite maison, avec des produits locaux et de saison.",
    'mission' => "Offrir une expérience culinaire conviviale, respectueuse des saisons et des producteurs locaux.",
    'address' => "12 Rue de la Cuisine, 75000 Paris",
    'phone' => "+33 6 00 00 00 00",
    'email' => "contact@restaurant.example",
    'hours' => [
        'Lundi' => 'Fermé',
        'Mardi' => '12:00–14:30, 19:00–22:00',
        'Mercredi' => '12:00–14:30, 19:00–22:00',
        'Jeudi' => '12:00–14:30, 19:00–22:00',
        'Vendredi' => '12:00–14:30, 19:00–23:00',
        'Samedi' => '12:00–15:00, 19:00–23:00',
        'Dimanche' => '12:00–15:00'
    ],
    'social' => [
        'facebook' => 'https://facebook.com/restaurant',
        'instagram' => 'https://instagram.com/restaurant'
    ],
    'team' => [
        ['role' => 'Gérant', 'name' => 'Jean Dupont'],
        ['role' => 'Chef', 'name' => 'Marie Martin'],
        ['role' => 'Responsable Service', 'name' => 'Luc Durand']
    ],
    'license' => 'MIT'
];

// Chemins d'inclusion (par défaut dans le même dossier que ce fichier).
// Tu peux indiquer un chemin relatif ou absolu vers tes fichiers header/footer.
$headerPath = __DIR__ . '/header.php';
$footerPath = __DIR__ . '/footer.php';

// Helper pour échapper le texte
function e($text) {
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Inclut un fichier s'il existe, sinon affiche du HTML de remplacement.
function include_or_fallback($path, $fallbackHtml) {
    if ($path && file_exists($path)) {
        include $path;
    } else {
        echo $fallbackHtml;
    }
}

// Si tu veux forcer d'autres chemins sans modifier ce fichier,
// définis $headerPath/$footerPath avant d'inclure ce fichier.
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo e($siteInfo['title']); ?></title>
    <style>
        body { font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; line-height:1.6; padding:20px; color:#222; background:#f9f9f9; }
        .container { max-width:900px; margin:0 auto; background:#fff; padding:24px; box-shadow:0 6px 18px rgba(0,0,0,.06); border-radius:8px; }
        header h1 { margin:0 0 8px 0; }
        .meta { color:#555; margin-bottom:18px; }
        .section { margin-top:20px; }
        .team { display:flex; gap:16px; flex-wrap:wrap; }
        .member { background:#fafafa; padding:12px; border-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,.03); min-width:180px; }
        dl dt { font-weight:600; }
        .footer { margin-top:28px; color:#666; font-size:0.9rem; text-align:center; }
        a { color:#0b66c3; text-decoration:none; }
        a:hover { text-decoration:underline; }
    </style>
</head>
<body>
<?php
// Inclusion du header (ou fallback)
include_or_fallback($headerPath, '<header style="background:#fff;padding:12px 24px;border-bottom:1px solid #eee;"><div class="container"><h1>' . e($siteInfo['title']) . '</h1></div></header>');
?>
<div class="container" role="main">
    <section aria-labelledby="apropos-heading">
        <h2 id="apropos-heading">À propos</h2>
        <p class="meta"><?php echo e($siteInfo['description']); ?></p>
    </section>

    <section class="section">
        <h3>Notre mission</h3>
        <p><?php echo e($siteInfo['mission']); ?></p>
    </section>

    <section class="section" aria-labelledby="infos-heading">
        <h3 id="infos-heading">Informations pratiques</h3>
        <dl>
            <dt>Adresse</dt>
            <dd><?php echo e($siteInfo['address']); ?></dd>

            <dt>Téléphone</dt>
            <dd><a href="tel:<?php echo e($siteInfo['phone']); ?>"><?php echo e($siteInfo['phone']); ?></a></dd>

            <dt>Email</dt>
            <dd><a href="mailto:<?php echo e($siteInfo['email']); ?>"><?php echo e($siteInfo['email']); ?></a></dd>

            <dt>Horaires</dt>
            <dd>
                <ul>
                    <?php foreach ($siteInfo['hours'] as $day => $hours): ?>
                        <li><?php echo e($day . ' — ' . $hours); ?></li>
                    <?php endforeach; ?>
                </ul>
            </dd>
        </dl>
    </section>

    <section class="section" aria-labelledby="team-heading">
        <h3 id="team-heading">Équipe</h3>
        <div class="team">
            <?php foreach ($siteInfo['team'] as $m): ?>
                <div class="member">
                    <div><strong><?php echo e($m['name']); ?></strong></div>
                    <div style="color:#666;"><?php echo e($m['role']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section" aria-labelledby="social-heading">
        <h3 id="social-heading">Réseaux</h3>
        <p>
            <?php foreach ($siteInfo['social'] as $key => $link): ?>
                <a href="<?php echo e($link); ?>" target="_blank" rel="noopener noreferrer"><?php echo ucfirst(e($key)); ?></a><?php echo $key === array_key_last($siteInfo['social']) ? '' : ' · '; ?>
            <?php endforeach; ?>
        </p>
    </section>

    <div class="footer" aria-hidden="false">
        <small>Licence: <?php echo e($siteInfo['license']); ?> — Généré automatiquement.</small>
    </div>
</div>

<?php
// Inclusion du footer (ou fallback)
include_or_fallback($footerPath, '<footer style="margin-top:24px;padding:12px 24px;text-align:center;color:#666;"><small>&copy; ' . date('Y') . ' ' . e($siteInfo['title']) . '</small></footer>');
?>
</body>
</html>