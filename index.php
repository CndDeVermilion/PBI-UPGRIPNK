<?php
$title = "Portal Resmi S1 Pendidikan Bahasa Inggris | UPGRI Pontianak";
$meta_description = "Portal Resmi Program Studi S1 Pendidikan Bahasa Inggris (English Language Education) Fakultas Pendidikan Bahasa dan Seni Universitas PGRI Pontianak.";
$page = "home";
$body_class = "antislop-active";

require_once __DIR__ . '/api/db.php';

// Fetch top 3 latest published news from SQLite database
$newsStmt = $pdo->query("SELECT news_id as id, slug, judul, kategori, tanggal, ringkasan, gambar FROM berita ORDER BY id DESC LIMIT 3");
$homeBerita = $newsStmt->fetchAll();

// Fetch prodi information from database
$prodiStmt = $pdo->query("SELECT val_content FROM prodi_info WHERE key_name = 'prodi_info_json'");
$prodiInfoJson = $prodiStmt->fetchColumn();
$prodiInfo = $prodiInfoJson ? json_decode($prodiInfoJson, true) : [];

$kaprodiNama = !empty($prodiInfo['strukturOrganisasi'][0]['nama']) ? $prodiInfo['strukturOrganisasi'][0]['nama'] : "Dosen 1, M.Pd.";

include 'components/header.php';
?>

  <main id="main-content">
    
    <!-- Hero Section -->
    <section class="hero-section hero-fullpage">
      <div class="hero-bg-slider">
        <div class="hero-bg-slide active" style="background-image: linear-gradient(180deg, rgba(59, 7, 100, 0.88) 0%, rgba(30, 27, 75, 0.94) 100%), url('img/Background.jpg');"></div>
        <div class="hero-bg-slide" style="background-image: linear-gradient(180deg, rgba(59, 7, 100, 0.82) 0%, rgba(30, 27, 75, 0.90) 100%), url('img/Background.jpg');"></div>
      </div>

      <div class="container hero-grid">
        <div>
          <div class="hero-seal-badge">
            Akreditasi LAMDIK: <?php echo htmlspecialchars($prodiInfo['akreditasi']['peringkat'] ?? 'BAIK SEKALI'); ?>
          </div>
          <h1 class="hero-heading">
            Program Studi S1 Pendidikan Bahasa Inggris
          </h1>
          <p class="hero-sub">
            Mewujudkan pendidik bahasa Inggris profesional, berkarakter unggul, adaptif terhadap teknologi pembelajaran digital, serta berdaya saing global di Fakultas Pendidikan Bahasa dan Seni UPGRI Pontianak.
          </p>
          <div class="hero-actions">
            <a href="akademik.php" class="btn btn-purple">Pelajari Kurikulum SKS</a>
            <a href="https://spmb.upgripnk.ac.id/" target="_blank" class="btn btn-outline" style="color: white; border-color: rgba(255,255,255,0.4);">Pendaftaran Mahasiswa Baru</a>
          </div>
        </div>

        <div class="hero-frame">
          <img src="img/Background.jpg" alt="Gedung Kampus Fakultas Pendidikan Bahasa dan Seni Universitas PGRI Pontianak" style="width: 100%; height: 260px; object-fit: cover; border-radius: var(--radius-md) var(--radius-md) 0 0;">
          <div class="hero-stats-bar">
            <div class="hero-stat">
              <h3>144 SKS</h3>
              <p>Total Beban Studi</p>
            </div>
            <div class="hero-stat">
              <h3>S.Pd.</h3>
              <p>Gelar Lulusan Resmi</p>
            </div>
            <div class="hero-stat">
              <h3>LAMDIK</h3>
              <p>No. 742 (s.d. 2029)</p>
            </div>
          </div>
        </div>
      </div>

      <div class="hero-slider-dots">
        <button type="button" class="slider-dot active" onclick="setHeroSlide(0)" aria-label="Slide latar 1"></button>
        <button type="button" class="slider-dot" onclick="setHeroSlide(1)" aria-label="Slide latar 2"></button>
      </div>
    </section>

    <!-- Sambutan Pimpinan Program Studi -->
    <section class="section section-white" id="welcome">
      <div class="container">
        <div class="welcome-banner-card grid-2" style="align-items: center; gap: 3rem; border-left: 6px solid var(--purple-800);">
          <div style="text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; background: var(--purple-50); border-radius: var(--radius-md); border: 1px solid var(--purple-200);">
            <img src="img/Logo_UPGRI.png" alt="Lambang Universitas PGRI Pontianak" style="width: 90px; height: auto; margin-bottom: 1rem;">
            <div style="font-weight: 800; color: var(--purple-950); font-size: 1.1rem; line-height: 1.3;">Pimpinan Program Studi</div>
            <div style="font-size: 0.82rem; color: var(--purple-700); font-weight: 600; margin-top: 0.25rem;">FPBS UPGRI Pontianak</div>
          </div>
          <div>
            <h2 style="font-size: 1.75rem; color: var(--purple-950); margin-bottom: 1rem; line-height: 1.35;">
              Selamat Datang di Portal Resmi S1 Pendidikan Bahasa Inggris
            </h2>
            <p style="font-size: 0.98rem; color: var(--slate-700); line-height: 1.75; margin-bottom: 1.5rem;">
              Kami berkomitmen menyelenggarakan pendidikan tinggi berkualitas yang memadukan keahlian pedagogi bahasa Inggris, penguasaan linguistik terapan, dan pemanfaatan teknologi digital pembelajaran. Lulusan dipersiapkan menjadi pendidik yang berintegritas, adaptif terhadap kearifan lokal ekuator, dan siap bersaing di panggung nasional maupun global.
            </p>
            <div style="display: flex; align-items: center; gap: 1rem;">
              <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--purple-900); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.1rem;">
                KP
              </div>
              <div>
                <h3 style="font-size: 1.05rem; color: var(--purple-950); margin: 0; font-weight: 700;"><?php echo htmlspecialchars($kaprodiNama); ?></h3>
                <p style="font-size: 0.84rem; color: var(--slate-600); margin: 0;">Ketua Program Studi S1 Pendidikan Bahasa Inggris</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Keunggulan Program Studi -->
    <section class="section section-muted" id="home-keunggulan">
      <div class="container">
        <div class="text-center section-header">
          <h2 class="section-title">Keunggulan Akademik & Fasilitas Pembelajaran</h2>
          <p class="section-subtitle">Kurikulum pengajaran bahasa Inggris modern berbasis teknologi digital dengan laboratorium bahasa dan studio microteaching mutakhir.</p>
        </div>
        <div class="grid-4" id="home-keunggulan-list">
          <div class="card" style="background: #FFFFFF;">
            <h3 style="font-size: 1.05rem; margin-bottom: 0.4rem; color: var(--purple-950);">Kurikulum Berbasis STEAM & EdTech</h3>
            <p style="font-size: 0.85rem; color: var(--slate-600); font-weight: 400; line-height: 1.55;">Disusun mengacu pada standar kurikulum kependidikan nasional yang terintegrasi dengan teknologi pembelajaran digital (Computer-Assisted Language Learning).</p>
          </div>
          <div class="card" style="background: #FFFFFF;">
            <h3 style="font-size: 1.05rem; margin-bottom: 0.4rem; color: var(--purple-950);">Fasilitas Microteaching & Lab Bahasa Digital</h3>
            <p style="font-size: 0.85rem; color: var(--slate-600); font-weight: 400; line-height: 1.55;">Dilengkapi Laboratorium Microteaching berstandar studio recording dan Lab Phonetics & Language Testing modern.</p>
          </div>
          <div class="card" style="background: #FFFFFF;">
            <h3 style="font-size: 1.05rem; margin-bottom: 0.4rem; color: var(--purple-950);">Dosen Berkualifikasi Magister & Doktor</h3>
            <p style="font-size: 0.85rem; color: var(--slate-600); font-weight: 400; line-height: 1.55;">Tenaga pengajar berpengalaman dengan spesialisasi bidang TEFL, Applied Linguistics, Literature, dan Educational Technology.</p>
          </div>
          <div class="card" style="background: #FFFFFF;">
            <h3 style="font-size: 1.05rem; margin-bottom: 0.4rem; color: var(--purple-950);">Program Kemitraan & Magang PLP</h3>
            <p style="font-size: 0.85rem; color: var(--slate-600); font-weight: 400; line-height: 1.55;">Kerjasama pengajaran dan magang kependidikan dengan sekolah mitra di Kalimantan Barat, lembaga bahasa, serta kegiatan akademik kolaboratif.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Layanan Utama & Akses Portal (Clean SVG Icons, Real Destinations) -->
    <section class="section section-white" id="home-layanan">
      <div class="container">
        <div class="text-center section-header">
          <h2 class="section-title">Layanan Utama & Akses Informasi</h2>
          <p class="section-subtitle">Layanan informasi publik, struktur kurikulum akademik, publikasi ilmiah, dan administrasi kemahasiswaan terpadu.</p>
        </div>

        <div class="grid-4">
          <!-- Layanan Akademik -->
          <div class="service-tile-card">
            <div style="padding: 1.25rem 0; text-align: center;">
              <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="var(--purple-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="margin: 0 auto; display: block;">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
              </svg>
            </div>
            <div>
              <h3 class="service-tile-title">Layanan Akademik</h3>
              <p class="service-tile-desc">Akses struktur 144 SKS mata kuliah, tahapan perkuliahan, dan panduan tugas akhir skripsi.</p>
            </div>
            <a href="akademik.php" class="btn btn-outline btn-sm" style="width: 100%;">Buka Kurikulum SKS</a>
          </div>

          <!-- PMB & Beasiswa -->
          <div class="service-tile-card" style="border-color: var(--purple-600); background: var(--purple-50);">
            <div style="padding: 1.25rem 0; text-align: center;">
              <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="var(--purple-800)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="margin: 0 auto; display: block;">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
              </svg>
            </div>
            <div>
              <h3 class="service-tile-title">PMB & Beasiswa</h3>
              <p class="service-tile-desc">Informasi pendaftaran mahasiswa baru, jalur seleksi mandiri/prestasi, dan rincian SPP studi.</p>
            </div>
            <a href="https://spmb.upgripnk.ac.id/" target="_blank" class="btn btn-purple btn-sm" style="width: 100%;">Portal Pendaftaran SPMB</a>
          </div>

          <!-- Jurnal & Repositori Riset -->
          <div class="service-tile-card">
            <div style="padding: 1.25rem 0; text-align: center;">
              <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="var(--purple-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="margin: 0 auto; display: block;">
                <line x1="8" y1="6" x2="21" y2="6"></line>
                <line x1="8" y1="12" x2="21" y2="12"></line>
                <line x1="8" y1="18" x2="21" y2="18"></line>
                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                <line x1="3" y1="18" x2="3.01" y2="18"></line>
              </svg>
            </div>
            <div>
              <h3 class="service-tile-title">Jurnal & E-Library</h3>
              <p class="service-tile-desc">Repositori publikasi ilmiah dosen dan mahasiswa serta portal jurnal penelitian kependidikan.</p>
            </div>
            <a href="https://journal.upgripnk.ac.id/" target="_blank" class="btn btn-outline btn-sm" style="width: 100%;">Buka Portal Jurnal</a>
          </div>

          <!-- Pusat Informasi & Kontak -->
          <div class="service-tile-card">
            <div style="padding: 1.25rem 0; text-align: center;">
              <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="var(--purple-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="margin: 0 auto; display: block;">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
              </svg>
            </div>
            <div>
              <h3 class="service-tile-title">Pusat Informasi</h3>
              <p class="service-tile-desc">Layanan administrasi, konsultasi akademik, direktori dosen, dan lokasi sekretariat prodi.</p>
            </div>
            <a href="informasi.php#kontak" class="btn btn-outline btn-sm" style="width: 100%;">Hubungi Sekretariat</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Warta Berita & Agenda Terkini -->
    <section class="section section-muted" id="home-berita-wrap">
      <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
          <div>
            <h2 class="section-title">Warta Berita & Agenda Terkini</h2>
            <p class="section-subtitle" style="margin-bottom: 0;">Liputan kegiatan akademik, pengumuman perkuliahan, dan agenda program studi.</p>
          </div>
          <a href="berita.php" class="btn btn-outline btn-sm">Arsip Berita & Agenda</a>
        </div>
        
        <div class="grid-3" id="home-berita-list">
          <?php foreach ($homeBerita as $b): ?>
            <div class="card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column; background: #FFFFFF;">
              <img src="<?php echo htmlspecialchars($b['gambar']); ?>" alt="<?php echo htmlspecialchars($b['judul']); ?>" style="height: 180px; width: 100%; object-fit: cover;">
              <div style="padding: 1.35rem; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="display: flex; gap: 0.5rem; margin-bottom: 0.45rem; align-items: center;">
                  <span class="badge badge-purple"><?php echo htmlspecialchars($b['kategori']); ?></span>
                  <span style="font-size: 0.78rem; color: var(--slate-500);"><?php echo htmlspecialchars($b['tanggal']); ?></span>
                </div>
                <h3 style="font-size: 1.05rem; margin-bottom: 0.5rem; line-height: 1.35; color: var(--purple-950);">
                  <a href="berita-detail.php?id=<?php echo htmlspecialchars($b['id']); ?>" style="color: inherit; text-decoration: none;"><?php echo htmlspecialchars($b['judul']); ?></a>
                </h3>
                <p style="font-size: 0.85rem; color: var(--slate-600); flex-grow: 1; margin-bottom: 1.25rem; line-height: 1.55;"><?php echo htmlspecialchars($b['ringkasan']); ?></p>
                <a href="berita-detail.php?id=<?php echo htmlspecialchars($b['id']); ?>" class="btn btn-outline btn-sm" style="text-align: center; text-decoration: none;">Baca Selengkapnya</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Profil Lulusan & Capaian Karir (Replacing AI fake testimonials R-18, R-38 with real curriculum outcomes) -->
    <section class="section section-white" id="home-profil-lulusan">
      <div class="container">
        <div class="text-center section-header">
          <h2 class="section-title">Profil Lulusan & Prospek Karir</h2>
          <p class="section-subtitle">Arah kompetensi dan profil capaian lulusan S1 Pendidikan Bahasa Inggris FPBS UPGRI Pontianak yang siap berkiprah di dunia kerja.</p>
        </div>
        <div class="grid-4">
          <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <div style="font-size: 0.76rem; font-weight: 700; color: var(--purple-700); text-transform: uppercase; margin-bottom: 0.35rem;">Profil Utama</div>
              <h3 style="font-size: 1.1rem; color: var(--purple-950); margin-bottom: 0.5rem;">English Educator</h3>
              <p style="font-size: 0.85rem; color: var(--slate-600); line-height: 1.55;">Pendidik bahasa Inggris profesional di jenjang pendidikan menengah (SMP/SMA/SMK) dan lembaga kursus dengan penguasaan metodologi TEFL serta teknologi CALL.</p>
            </div>
          </div>

          <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <div style="font-size: 0.76rem; font-weight: 700; color: var(--purple-700); text-transform: uppercase; margin-bottom: 0.35rem;">Profil Peneliti</div>
              <h3 style="font-size: 1.1rem; color: var(--purple-950); margin-bottom: 0.5rem;">English Researcher</h3>
              <p style="font-size: 0.85rem; color: var(--slate-600); line-height: 1.55;">Peneliti pemula bidang pengajaran bahasa Inggris, linguistik terapan, analisis wacana, dan evaluasi pembelajaran yang berintegritas akademik.</p>
            </div>
          </div>

          <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <div style="font-size: 0.76rem; font-weight: 700; color: var(--purple-700); text-transform: uppercase; margin-bottom: 0.35rem;">Profil Praktisi</div>
              <h3 style="font-size: 1.1rem; color: var(--purple-950); margin-bottom: 0.5rem;">Language Practitioner</h3>
              <p style="font-size: 0.85rem; color: var(--slate-600); line-height: 1.55;">Praktisi komunikasi bahasa Inggris, penerjemah dokumen (translator), juru bahasa (interpreter), serta pemandu acara dan public speaker profesional.</p>
            </div>
          </div>

          <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <div style="font-size: 0.76rem; font-weight: 700; color: var(--purple-700); text-transform: uppercase; margin-bottom: 0.35rem;">Profil Wirausaha</div>
              <h3 style="font-size: 1.1rem; color: var(--purple-950); margin-bottom: 0.5rem;">Edutechnopreneur</h3>
              <p style="font-size: 0.85rem; color: var(--slate-600); line-height: 1.55;">Pengembang usaha mandiri bidang jasa pelatihan bahasa, bimbingan belajar, penyedia konten edukasi digital, dan media pembelajaran bahasa Inggris.</p>
            </div>
          </div>
        </div>
        <div style="text-align: center; margin-top: 2.25rem;">
          <a href="akademik.php#profil-lulusan-list-wrap" class="btn btn-purple">Lihat Rincian Kurikulum & Capaian Pembelajaran</a>
        </div>
      </div>
    </section>
  </main>

<?php include 'components/footer.php'; ?>
