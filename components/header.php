<?php
if (!isset($page)) $page = '';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($title) ? $title : 'English Edu UPGRI Pontianak'; ?></title>
  <link rel="icon" type="image/png" href="img/Logo_UPGRI.png">
  <link rel="shortcut icon" type="image/png" href="img/Logo_UPGRI.png">
  <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : 'Portal Resmi Program Studi S1 Pendidikan Bahasa Inggris UPGRI Pontianak.'; ?>">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>

<body>

  <header class="header-brand-strip">
    <div class="container header-container">
      <a href="index.php" class="brand-logo">
        <img src="img/Logo_UPGRI.png" alt="Logo Universitas PGRI Pontianak">
        <div class="brand-text">
          <span class="brand-title">Pendidikan Bahasa Inggris</span>
          <span class="brand-univ">Universitas PGRI Pontianak</span>
        </div>
      </a>

      <nav class="desktop-nav">
        <ul class="nav-menu">
          <li>
            <a href="index.php" class="nav-item-btn <?php echo ($page === 'home') ? 'active' : ''; ?>" id="nav-home">BERANDA</a>
          </li>

          <li class="nav-dropdown" id="nav-group-profil">
            <a href="profil.php" class="nav-item-btn <?php echo ($page === 'profil') ? 'active' : ''; ?>" id="nav-profil">
              PROFIL
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </a>
            <div class="nav-dropdown-menu">
              <a href="profil.php#sejarah-prodi" class="dropdown-item-btn">Sejarah Program Studi</a>
              <a href="profil.php#profil-visi" class="dropdown-item-btn">Visi, Misi & Tujuan</a>
              <a href="profil.php#profil-pimpinan" class="dropdown-item-btn">Struktur Organisasi</a>
              <a href="javascript:void(0)" onclick="openAccreditationModal()" class="dropdown-item-btn">Sertifikat Akreditasi LAMDIK</a>
            </div>
          </li>

          <li class="nav-dropdown" id="nav-group-akademik">
            <a href="akademik.php" class="nav-item-btn <?php echo ($page === 'akademik') ? 'active' : ''; ?>" id="nav-akademik">
              AKADEMIK
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </a>
            <div class="nav-dropdown-menu">
              <a href="akademik.php#kurikulum" class="dropdown-item-btn">Struktur Kurikulum SKS</a>
              <a href="akademik.php#profil-lulusan-list-wrap" class="dropdown-item-btn">Profil Lulusan (Graduate Profiles)</a>
              <a href="akademik.php#alur-skripsi-list-wrap" class="dropdown-item-btn">Tahapan Riset & Skripsi</a>
            </div>
          </li>

          <li class="nav-dropdown" id="nav-group-kemahasiswaan">
            <a href="mahasiswa.php" class="nav-item-btn <?php echo ($page === 'mahasiswa') ? 'active' : ''; ?>" id="nav-kemahasiswaan">
              MAHASISWA
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </a>
            <div class="nav-dropdown-menu">
              <a href="mahasiswa.php#sesco" class="dropdown-item-btn">Smart English Student Community (SESCo)</a>
              <a href="mahasiswa.php#prestasi-mahasiswa-list" class="dropdown-item-btn">Pencapaian Prestasi</a>
              <a href="mahasiswa.php#alumni-tracer" class="dropdown-item-btn">Tracer Study & Alumni</a>
            </div>
          </li>

          <li class="nav-dropdown" id="nav-group-staff">
            <a href="staff.php" class="nav-item-btn <?php echo ($page === 'staff') ? 'active' : ''; ?>" id="nav-staff">
              STAFF
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </a>
            <div class="nav-dropdown-menu">
              <a href="staff.php#profil-pimpinan" class="dropdown-item-btn">Pimpinan Program Studi</a>
              <a href="staff.php#profil-dosen-grid" class="dropdown-item-btn">Direktori Dosen & Peneliti</a>
            </div>
          </li>

          <li class="nav-dropdown" id="nav-group-informasi">
            <a href="berita.php" class="nav-item-btn <?php echo ($page === 'berita') ? 'active' : ''; ?>" id="nav-informasi">
              INFORMASI
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </a>
            <div class="nav-dropdown-menu">
              <a href="berita.php" class="dropdown-item-btn">Portal Warta Berita</a>
              <a href="https://spmb.upgripnk.ac.id/" target="_blank" class="dropdown-item-btn">Pendaftaran PMB (SPMB)</a>
              <a href="informasi.php#biaya" class="dropdown-item-btn">Rincian Biaya SPP Studi</a>
              <a href="javascript:void(0)" onclick="openSearchModal()" class="dropdown-item-btn">Pencarian Data Portal</a>
            </div>
          </li>

          <li class="nav-dropdown" id="nav-group-fasilitas">
            <a href="fasilitas.php" class="nav-item-btn <?php echo ($page === 'fasilitas') ? 'active' : ''; ?>" id="nav-fasilitas">
              FASILITAS
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </a>
            <div class="nav-dropdown-menu">
              <a href="fasilitas.php#microteaching" class="dropdown-item-btn">Studio Microteaching</a>
              <a href="fasilitas.php#lab-bahasa" class="dropdown-item-btn">Laboratorium Bahasa CALL</a>
              <a href="fasilitas.php#inventaris-table-body" class="dropdown-item-btn">Inventaris Perangkat Lab</a>
            </div>
          </li>
        </ul>
      </nav>

      <div class="header-right-actions">
        <button class="lang-switch-btn" onclick="toggleLanguage()" title="Switch Language / Ganti Bahasa">
          <span class="lang-opt" id="lang-btn-en">EN</span>
          <span class="lang-opt active" id="lang-btn-id">ID</span>
        </button>
        <button class="mobile-hamburger-btn" onclick="toggleMobileNav()" title="Toggle Navigation Menu" aria-label="Toggle Menu">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round">
            <line x1="3" y1="6" x2="21" y2="6" />
            <line x1="3" y1="12" x2="21" y2="12" />
            <line x1="3" y1="18" x2="21" y2="18" />
          </svg>
        </button>
      </div>
    </div>

    <div class="mobile-nav-drawer" id="mobile-nav-drawer">
      <div class="container mobile-nav-content">
        <ul class="mobile-nav-menu">
          <li>
            <a href="index.php" class="mobile-nav-link <?php echo ($page === 'home') ? 'active' : ''; ?>">BERANDA</a>
          </li>
          <li class="mobile-dropdown-group">
            <div class="mobile-nav-link" onclick="toggleMobileSubmenu('sub-profil')">
              PROFIL <span>▾</span>
            </div>
            <div class="mobile-submenu" id="sub-profil">
              <a href="profil.php#sejarah-prodi">Sejarah Program Studi</a>
              <a href="profil.php#profil-visi">Visi, Misi & Tujuan</a>
              <a href="profil.php#profil-pimpinan">Struktur Organisasi</a>
              <a href="javascript:void(0)" onclick="openAccreditationModal()">Sertifikat Akreditasi LAMDIK</a>
            </div>
          </li>
          <li class="mobile-dropdown-group">
            <div class="mobile-nav-link" onclick="toggleMobileSubmenu('sub-akademik')">
              AKADEMIK <span>▾</span>
            </div>
            <div class="mobile-submenu" id="sub-akademik">
              <a href="akademik.php#kurikulum">Struktur Kurikulum SKS</a>
              <a href="akademik.php#profil-lulusan-list-wrap">Profil Lulusan</a>
              <a href="akademik.php#alur-skripsi-list-wrap">Tahapan Riset & Skripsi</a>
            </div>
          </li>
          <li class="mobile-dropdown-group">
            <div class="mobile-nav-link" onclick="toggleMobileSubmenu('sub-mahasiswa')">
              MAHASISWA <span>▾</span>
            </div>
            <div class="mobile-submenu" id="sub-mahasiswa">
              <a href="mahasiswa.php#sesco">Komunitas Mahasiswa (SESCo)</a>
              <a href="mahasiswa.php#prestasi-mahasiswa-list">Pencapaian Prestasi</a>
              <a href="mahasiswa.php#alumni-tracer">Tracer Study & Alumni</a>
            </div>
          </li>
          <li class="mobile-dropdown-group">
            <div class="mobile-nav-link" onclick="toggleMobileSubmenu('sub-staff')">
              STAFF <span>▾</span>
            </div>
            <div class="mobile-submenu" id="sub-staff">
              <a href="staff.php#profil-pimpinan">Pimpinan Program Studi</a>
              <a href="staff.php#profil-dosen-grid">Direktori Dosen & Peneliti</a>
            </div>
          </li>
          <li class="mobile-dropdown-group">
            <div class="mobile-nav-link" onclick="toggleMobileSubmenu('sub-informasi')">
              INFORMASI <span>▾</span>
            </div>
            <div class="mobile-submenu" id="sub-informasi">
              <a href="berita.php">Portal Warta Berita</a>
              <a href="https://spmb.upgripnk.ac.id/" target="_blank">Pendaftaran PMB</a>
              <a href="informasi.php#biaya">Rincian Biaya SPP Studi</a>
            </div>
          </li>
          <li class="mobile-dropdown-group">
            <div class="mobile-nav-link" onclick="toggleMobileSubmenu('sub-fasilitas')">
              FASILITAS <span>▾</span>
            </div>
            <div class="mobile-submenu" id="sub-fasilitas">
              <a href="fasilitas.php#microteaching">Studio Microteaching</a>
              <a href="fasilitas.php#lab-bahasa">Laboratorium Bahasa CALL</a>
              <a href="fasilitas.php#inventaris-table-body">Inventaris Perangkat Lab</a>
            </div>
          </li>
          <li style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border-color);">
            <a href="https://spmb.upgripnk.ac.id/" target="_blank" class="btn btn-purple" style="width: 100%; text-align: center;">Pendaftaran PMB TA 2026/2027</a>
          </li>
        </ul>
      </div>
    </div>
  </header>
