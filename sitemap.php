<?php
/**
 * NK9 Wise Academy - Dynamic XML Sitemap for Google Search Console
 * Generates standards-compliant XML sitemap dynamically based on server protocol and host,
 * with automatic lastmod timestamp detection from local files.
 */

// Set proper XML and charset headers
header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex'); // Do not index the sitemap itself

// Determine scheme (HTTPS / HTTP)
$is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
    || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
$scheme = $is_https ? 'https' : 'http';

// Determine host with fallback to default production domain
$host = !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'nk9academy.gr';
$base_url = $scheme . '://' . rtrim($host, '/');

// Last modified dates
$index_file = __DIR__ . '/index.html';
$lastmod_index = file_exists($index_file) ? date('Y-m-d\TH:i:sP', filemtime($index_file)) : date('c');

$logo_file = __DIR__ . '/k9wise academy logo.png';
$logo_url = $base_url . '/k9wise%20academy%20logo.png';

// Service images for Google Image Sitemap integration
$images = [
    [
        'loc' => $logo_url,
        'title' => 'NK9 Wise Academy - Εκπαίδευση Σκύλων',
        'caption' => 'Λογότυπο NK9 Wise Academy'
    ],
    [
        'loc' => $base_url . '/assets/images/basiki-ipakoi.jpg',
        'title' => 'Βασική Υπακοή Σκύλου - NK9 Wise Academy',
        'caption' => 'Μαθήματα βασικής υπακοής κατ\' οίκον και σε πραγματικές συνθήκες'
    ],
    [
        'loc' => $base_url . '/assets/images/puppy.jpg',
        'title' => 'Προεκπαίδευση Κουταβιού - NK9 Wise Academy',
        'caption' => 'Σωστή κοινωνικοποίηση και προεκπαίδευση κουταβιού'
    ],
    [
        'loc' => $base_url . '/assets/images/diorthosi-simperiforas.jpg',
        'title' => 'Διόρθωση Συμπεριφοράς Σκύλου - NK9 Wise Academy',
        'caption' => 'Επίλυση προβλημάτων επιθετικότητας, φοβιών και άγχους αποχωρισμού'
    ],
    [
        'loc' => $base_url . '/assets/images/proxorimeni-ipakoi.jpg',
        'title' => 'Προχωρημένη Υπακοή - NK9 Wise Academy',
        'caption' => 'Απόλυτος έλεγχος χωρίς λουρί σε περιβάλλον υψηλών ερεθισμάτων'
    ],
    [
        'loc' => $base_url . '/assets/images/somatofilakas.jpg',
        'title' => 'Σωματοφύλακας & Προστασία - NK9 Wise Academy',
        'caption' => 'Ειδική εκπαίδευση σκύλου προστασίας και συνοδείας'
    ],
    [
        'loc' => $base_url . '/assets/images/filaksi-xorou.jpg',
        'title' => 'Φύλαξη Χώρου & Περιουσίας - NK9 Wise Academy',
        'caption' => 'Εκπαίδευση φύλαξης οικιών, επιχειρήσεων και επαγγελματικών χώρων'
    ]
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
  <url>
    <loc><?php echo htmlspecialchars($base_url . '/', ENT_XML1, 'UTF-8'); ?></loc>
    <lastmod><?php echo htmlspecialchars($lastmod_index, ENT_XML1, 'UTF-8'); ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
<?php foreach ($images as $img): ?>
    <image:image>
      <image:loc><?php echo htmlspecialchars($img['loc'], ENT_XML1, 'UTF-8'); ?></image:loc>
      <image:title><?php echo htmlspecialchars($img['title'], ENT_XML1, 'UTF-8'); ?></image:title>
      <image:caption><?php echo htmlspecialchars($img['caption'], ENT_XML1, 'UTF-8'); ?></image:caption>
    </image:image>
<?php endforeach; ?>
  </url>
</urlset>
