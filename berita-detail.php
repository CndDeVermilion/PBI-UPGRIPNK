<?php
require_once __DIR__ . '/api/db.php';

$id = $_GET['id'] ?? '';
$slug = $_GET['slug'] ?? '';

$news = null;
$relatedNews = [];

if (!empty($slug)) {
    $stmt = $pdo->prepare("SELECT * FROM berita WHERE slug = ?");
    $stmt->execute([$slug]);
    $news = $stmt->fetch();
} else if (!empty($id)) {
    $stmt = $pdo->prepare("SELECT * FROM berita WHERE news_id = ? OR id = ?");
    $stmt->execute([$id, $id]);
    $news = $stmt->fetch();
}

if ($news) {
    // Increment view count
    $updateStmt = $pdo->prepare("UPDATE berita SET views = views + 1 WHERE id = ?");
    $updateStmt->execute([$news['id']]);
    $news['views'] = ($news['views'] ?? 0) + 1;

    // Fetch related news
    $relatedStmt = $pdo->prepare("SELECT news_id as id, slug, judul, kategori, tanggal, ringkasan, gambar FROM berita WHERE id != ? ORDER BY id DESC LIMIT 3");
    $relatedStmt->execute([$news['id']]);
    $relatedNews = $relatedStmt->fetchAll();

    $title = htmlspecialchars($news['judul']) . " | PBI UPGRI Pontianak";
    $meta_description = htmlspecialchars($news['ringkasan']);
} else {
    $title = "Warta Berita Tidak Ditemukan | S1 Pendidikan Bahasa Inggris UPGRI Pontianak";
    $meta_description = "Halaman warta berita yang Anda tuju tidak ditemukan atau telah dipindahkan.";
}

include 'components/header.php';
?>

<main class="page-content" style="background: var(--slate-100); padding-bottom: 4rem;">
  <div class="container" style="max-width: 900px; padding-top: 2rem;">
    
    <nav style="font-size: 0.85rem; color: var(--slate-600); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap;" aria-label="Breadcrumb">
      <a href="index.php" style="color: var(--purple-800); text-decoration: none;">Beranda</a>
      <span>/</span>
      <a href="berita.php" style="color: var(--purple-800); text-decoration: none;">Warta Berita</a>
      <span>/</span>
      <span style="color: var(--slate-700); max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
        <?php echo $news ? htmlspecialchars($news['judul']) : 'Detail Warta'; ?>
      </span>
    </nav>

    <?php if ($news): ?>
      <article class="card" style="padding: 2.25rem 2rem; margin-bottom: 2.5rem; background: #FFFFFF;">
        <header style="margin-bottom: 1.75rem;">
          <div style="display: flex; gap: 0.85rem; align-items: center; margin-bottom: 1rem; flex-wrap: wrap;">
            <span class="badge badge-purple"><?php echo htmlspecialchars($news['kategori']); ?></span>
            <span style="font-size: 0.84rem; color: var(--slate-600);">
              Dipublikasikan: <?php echo htmlspecialchars($news['tanggal']); ?>
            </span>
            <span style="font-size: 0.84rem; color: var(--slate-600);">
              Dibaca: <?php echo (int)$news['views']; ?> kali
            </span>
          </div>

          <h1 style="font-size: 2.1rem; font-weight: 800; color: var(--purple-950); line-height: 1.3; margin-bottom: 1.1rem;">
            <?php echo htmlspecialchars($news['judul']); ?>
          </h1>

          <p style="font-size: 1.05rem; color: var(--slate-700); line-height: 1.65; font-weight: 500; margin-bottom: 0;">
            <?php echo htmlspecialchars($news['ringkasan']); ?>
          </p>
        </header>

        <?php if (!empty($news['gambar'])): ?>
          <div style="margin-bottom: 2rem; border-radius: var(--radius-md); overflow: hidden; max-height: 440px; background: var(--slate-100);">
            <img src="<?php echo htmlspecialchars($news['gambar']); ?>" alt="<?php echo htmlspecialchars($news['judul']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
        <?php endif; ?>

        <div style="font-size: 1.02rem; color: var(--slate-800); line-height: 1.8; margin-bottom: 2.5rem; word-break: break-word;">
          <?php 
            $fullContent = !empty($news['konten']) ? $news['konten'] : $news['ringkasan'];
            $paragraphs = array_filter(array_map('trim', explode("\n\n", $fullContent)));
            foreach ($paragraphs as $paragraph):
              $cleanP = strip_tags($paragraph, '<b><i><u><strong><em><a><h3><ul><ol><li><br>');
          ?>
            <div style="margin-bottom: 1.25rem;"><?php echo nl2br($cleanP); ?></div>
          <?php endforeach; ?>
        </div>

        <footer style="background: var(--slate-100); border-radius: var(--radius-sm); padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
          <div style="display: flex; align-items: center; gap: 0.85rem;">
            <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--purple-900); color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem;">
              PBI
            </div>
            <div>
              <div style="font-size: 0.9rem; font-weight: 700; color: var(--purple-950);">Humas & Redaksi PBI UPGRI</div>
              <div style="font-size: 0.8rem; color: var(--slate-600);">Program Studi S1 Pendidikan Bahasa Inggris</div>
            </div>
          </div>
          
          <div style="display: flex; gap: 0.5rem; align-items: center;">
            <span style="font-size: 0.82rem; font-weight: 600; color: var(--slate-600); margin-right: 0.25rem;">Bagikan Artikel:</span>
            <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($news['judul'] . ' - ' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-outline btn-sm" style="text-decoration: none;">WhatsApp</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-outline btn-sm" style="text-decoration: none;">Facebook</a>
            <button onclick="copyArticleLink()" class="btn btn-purple btn-sm" id="btn-copy-link">Salin Link</button>
          </div>
        </footer>
      </article>

      <?php if (!empty($relatedNews)): ?>
        <section style="margin-top: 3rem;">
          <h2 style="font-size: 1.4rem; font-weight: 800; color: var(--purple-950); margin-bottom: 1.25rem;">
            Warta Berita Terkait
          </h2>
          <div class="grid-3">
            <?php foreach ($relatedNews as $rel): ?>
              <article class="card" style="display: flex; flex-direction: column; padding: 0; overflow: hidden; height: 100%;">
                <div style="position: relative; height: 150px; overflow: hidden; background: var(--slate-100);">
                  <img src="<?php echo htmlspecialchars($rel['gambar']); ?>" alt="<?php echo htmlspecialchars($rel['judul']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 1.1rem; display: flex; flex-direction: column; flex-grow: 1;">
                  <span class="badge badge-purple" style="font-size: 0.72rem; align-self: flex-start; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($rel['kategori']); ?></span>
                  <h3 style="font-size: 0.98rem; font-weight: 700; color: var(--purple-950); margin-bottom: 0.5rem; line-height: 1.35;">
                    <a href="berita-detail.php?id=<?php echo htmlspecialchars($rel['id']); ?>" style="color: inherit; text-decoration: none;"><?php echo htmlspecialchars($rel['judul']); ?></a>
                  </h3>
                  <div style="margin-top: auto; font-size: 0.78rem; color: var(--slate-600);">Dipublikasikan: <?php echo htmlspecialchars($rel['tanggal']); ?></div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </section>
      <?php endif; ?>

    <?php else: ?>
      <div class="card text-center" style="padding: 4rem 2rem;">
        <h1 style="font-size: 1.5rem; color: var(--purple-950); margin-bottom: 0.5rem;">Warta Berita Tidak Ditemukan</h1>
        <p style="color: var(--slate-600); margin-bottom: 1.5rem;">Maaf, artikel atau warta berita yang Anda cari tidak tersedia atau URL yang Anda tuju salah.</p>
        <div>
          <a href="berita.php" class="btn btn-purple">Kembali ke Portal Berita</a>
        </div>
      </div>
    <?php endif; ?>

  </div>
</main>

<script>
function copyArticleLink() {
  navigator.clipboard.writeText(window.location.href).then(function() {
    var btn = document.getElementById('btn-copy-link');
    if (btn) {
      btn.innerText = '✓ Tersalin!';
      setTimeout(function() { btn.innerText = 'Salin Link'; }, 2500);
    }
  });
}
</script>

<?php include 'components/footer.php'; ?>