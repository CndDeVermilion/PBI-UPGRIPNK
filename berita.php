<?php
$title = "Portal Berita & Warta Akademik | S1 Pendidikan Bahasa Inggris UPGRI Pontianak";
$meta_description = "Pusat informasi warta berita, prestasi mahasiswa, agenda kegiatan, pengumuman resmi, dan kegiatan pengabdian masyarakat Program Studi S1 Pendidikan Bahasa Inggris Universitas PGRI Pontianak.";

require_once __DIR__ . '/api/db.php';

$beritaStmt = $pdo->query("SELECT news_id as id, slug, judul, kategori, tanggal, ringkasan, gambar FROM berita ORDER BY id DESC");
$beritaList = $beritaStmt->fetchAll();

include 'components/header.php';
?>

<main class="page-content">
  <div class="header-hero-section">
    <div class="container">
      <div class="badge badge-purple" style="margin-bottom: 0.75rem;">Portal Informasi Resmi</div>
      <h1 style="font-size: 2.2rem; font-weight: 800; color: var(--purple-950); margin-bottom: 0.5rem;">Warta & Berita Program Studi</h1>
      <p style="color: var(--slate-600); max-width: 680px; font-size: 1rem;">
        Liputan kegiatan akademis, pencapaian prestasi mahasiswa & dosen, pengumuman magang PLP II, serta agenda ilmiah terkini.
      </p>
    </div>
  </div>

  <section class="section" style="padding: 2.5rem 0 4rem;">
    <div class="container">
      
      <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; background: #FFFFFF; padding: 1rem 1.25rem; border-radius: var(--radius-md); border: 1px solid var(--purple-100);">
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;" id="category-filter">
          <button class="btn btn-purple btn-sm cat-btn" onclick="filterBerita('semua', this)">Semua Warta</button>
          <button class="btn btn-outline btn-sm cat-btn" onclick="filterBerita('Prestasi', this)">Prestasi</button>
          <button class="btn btn-outline btn-sm cat-btn" onclick="filterBerita('Agenda', this)">Agenda</button>
          <button class="btn btn-outline btn-sm cat-btn" onclick="filterBerita('Pengumuman', this)">Pengumuman</button>
          <button class="btn btn-outline btn-sm cat-btn" onclick="filterBerita('Pengabdian', this)">Pengabdian</button>
        </div>
        <div style="min-width: 240px; flex-grow: 1; max-width: 340px;">
          <input type="text" id="search-berita" class="form-input" placeholder="Cari warta berita..." onkeyup="searchBerita(this.value)" style="width: 100%; padding: 0.5rem 0.85rem; font-size: 0.88rem; border-radius: var(--radius-sm); border: 1px solid var(--slate-300); outline: none;">
        </div>
      </div>

      <div class="grid-3" id="berita-grid-container">
        <?php foreach ($beritaList as $b): ?>
          <article class="card news-card-item" data-kategori="<?php echo htmlspecialchars($b['kategori']); ?>" data-judul="<?php echo strtolower(htmlspecialchars($b['judul'])); ?>" data-ringkasan="<?php echo strtolower(htmlspecialchars($b['ringkasan'])); ?>" style="display: flex; flex-direction: column; height: 100%; overflow: hidden; padding: 0;">
            <div style="position: relative; height: 200px; overflow: hidden; background: var(--slate-100);">
              <img src="<?php echo htmlspecialchars($b['gambar']); ?>" alt="<?php echo htmlspecialchars($b['judul']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
              <span class="badge badge-purple" style="position: absolute; top: 0.85rem; left: 0.85rem; box-shadow: var(--shadow-sm);"><?php echo htmlspecialchars($b['kategori']); ?></span>
            </div>
            <div class="card-body" style="display: flex; flex-direction: column; flex-grow: 1; padding: 1.35rem;">
              <div style="font-size: 0.8rem; color: var(--slate-500); margin-bottom: 0.5rem;">
                Dipublikasikan: <?php echo htmlspecialchars($b['tanggal']); ?>
              </div>
              <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--purple-950); margin-bottom: 0.65rem; line-height: 1.35;">
                <a href="berita-detail.php?id=<?php echo htmlspecialchars($b['id']); ?>" style="color: inherit; text-decoration: none;"><?php echo htmlspecialchars($b['judul']); ?></a>
              </h3>
              <p style="font-size: 0.88rem; color: var(--slate-600); line-height: 1.5; margin-bottom: 1.25rem; flex-grow: 1;">
                <?php echo htmlspecialchars($b['ringkasan']); ?>
              </p>
              <div style="margin-top: auto; border-top: 1px solid var(--purple-100); padding-top: 0.85rem;">
                <a href="berita-detail.php?id=<?php echo htmlspecialchars($b['id']); ?>" class="btn btn-outline btn-sm" style="width: 100%; text-align: center; text-decoration: none;">Baca Selengkapnya</a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <div id="berita-empty-state" style="display: none; text-align: center; padding: 3rem 1rem; background: #FFFFFF; border-radius: var(--radius-md); border: 1px dashed var(--slate-300);">
        <h3 style="font-size: 1.1rem; color: var(--slate-700); margin-bottom: 0.35rem;">Tidak ada warta berita yang ditemukan</h3>
        <p style="color: var(--slate-500); font-size: 0.88rem;">Coba gunakan kata kunci pencarian lain atau pilih kategori yang berbeda.</p>
      </div>

    </div>
  </section>
</main>

<script>
let activeCategory = 'semua';

function filterBerita(category, btnEl) {
  activeCategory = category;
  document.querySelectorAll('.cat-btn').forEach(btn => {
    btn.className = 'btn btn-outline btn-sm cat-btn';
  });
  btnEl.className = 'btn btn-purple btn-sm cat-btn';
  applyFilterAndSearch();
}

function searchBerita() {
  applyFilterAndSearch();
}

function applyFilterAndSearch() {
  const query = (document.getElementById('search-berita').value || '').toLowerCase().trim();
  const items = document.querySelectorAll('.news-card-item');
  let visibleCount = 0;

  items.forEach(item => {
    const kat = item.getAttribute('data-kategori');
    const judul = item.getAttribute('data-judul');
    const ringkasan = item.getAttribute('data-ringkasan');

    const matchCategory = (activeCategory === 'semua' || kat === activeCategory);
    const matchSearch = (!query || judul.includes(query) || ringkasan.includes(query) || kat.toLowerCase().includes(query));

    if (matchCategory && matchSearch) {
      item.style.display = 'flex';
      visibleCount++;
    } else {
      item.style.display = 'none';
    }
  });

  const emptyState = document.getElementById('berita-empty-state');
  if (emptyState) {
    emptyState.style.display = (visibleCount === 0) ? 'block' : 'none';
  }
}
</script>

<?php include 'components/footer.php'; ?>