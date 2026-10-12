<?php
require_once 'auth.php';
$title = "Panel Admin | S1 Pendidikan Bahasa Inggris";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link rel="icon" type="image/png" href="../img/Logo_UPGRI.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin.css">
</head>
<body>

  <header class="admin-header">
    <a href="index.php" class="admin-brand">
      <img src="../img/Logo_UPGRI.png" alt="Logo Universitas PGRI Pontianak">
      <div>
        <div class="admin-brand-title">Panel Admin</div>
        <div class="admin-brand-sub">S1 Pendidikan Bahasa Inggris | UPGRI Pontianak</div>
      </div>
    </a>
    <div class="header-actions">
      <a href="../index.php" target="_blank" class="btn-header-link">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
          <polyline points="15 3 21 3 21 9"></polyline>
          <line x1="10" y1="14" x2="21" y2="3"></line>
        </svg>
        <span>Lihat Website Utama</span>
      </a>
      <button type="button" onclick="logoutAdmin()" class="btn-logout">Logout</button>
    </div>
  </header>

  <nav class="admin-subnav" aria-label="Navigasi Panel Admin">
    <div class="subnav-container">
      <button type="button" class="nav-tab-btn active" onclick="switchAdminTab('tab-dashboard', this)">Ringkasan</button>
      <button type="button" class="nav-tab-btn" onclick="switchAdminTab('tab-berita', this)">Warta & Berita</button>
      <button type="button" class="nav-tab-btn" onclick="switchAdminTab('tab-dosen', this)">Direktori Dosen</button>
      <button type="button" class="nav-tab-btn" onclick="switchAdminTab('tab-kurikulum', this)">Kurikulum SKS</button>
      <button type="button" class="nav-tab-btn" onclick="switchAdminTab('tab-profil', this)">Profil & Pimpinan</button>
    </div>
  </nav>

  <main class="admin-container">

    <!-- Tab 1: Ringkasan Dashboard -->
    <section id="tab-dashboard" class="tab-module active">
      <div class="page-header-row">
        <div>
          <h1 class="page-title">Ringkasan Pengelolaan Portal</h1>
          <p class="page-subtitle">Status data publikasi, statistik konten aktif, dan pintasan pembaruan portal program studi.</p>
        </div>
      </div>

      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-card-label">Berita Terbit</div>
          <div class="stat-card-value" id="stat-total-berita">0</div>
          <div class="stat-card-sub">Warta & agenda aktif di portal</div>
        </div>
        <div class="stat-card">
          <div class="stat-card-label">Dosen & Staf</div>
          <div class="stat-card-value" id="stat-total-dosen">0</div>
          <div class="stat-card-sub">Tenaga pendidik terdaftar</div>
        </div>
        <div class="stat-card">
          <div class="stat-card-label">Mata Kuliah</div>
          <div class="stat-card-value" id="stat-total-mk">0</div>
          <div class="stat-card-sub">Total 144 SKS (Semester 1 - 8)</div>
        </div>
        <div class="stat-card">
          <div class="stat-card-label">Status Akreditasi</div>
          <div class="stat-card-value" style="font-size: 1.35rem; color: #4C1D95;" id="stat-akreditasi">BAIK SEKALI</div>
          <div class="stat-card-sub" id="stat-akreditasi-sub">LAMDIK No. 742 (s.d. 2029)</div>
        </div>
      </div>

      <div class="dashboard-grid">
        <!-- Berita Terkini -->
        <div class="card-box" style="margin-bottom: 0;">
          <div class="card-box-header">
            <div>
              <h2 class="card-box-title">Warta Berita Terbaru yang Tayang</h2>
              <p class="page-subtitle" style="margin-top: 0.15rem;">Daftar berita terkini yang tampil di halaman beranda portal.</p>
            </div>
            <button type="button" class="btn-action btn-secondary btn-sm" onclick="switchAdminTab('tab-berita', document.querySelectorAll('.nav-tab-btn')[1])">
              Buka Semua Berita
            </button>
          </div>
          <div class="table-responsive">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Judul Berita</th>
                  <th>Kategori</th>
                  <th>Tanggal</th>
                  <th style="text-align: center; width: 110px;">Aksi</th>
                </tr>
              </thead>
              <tbody id="dashboard-recent-news">
                <tr>
                  <td colspan="4" style="text-align: center; color: var(--admin-text-subtle);">Memuat data warta...</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pintasan Operasional & Sinkronisasi -->
        <div>
          <div class="card-box" style="margin-bottom: 1.5rem;">
            <div class="card-box-header">
              <h2 class="card-box-title">Aksi Cepat Konten</h2>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
              <button type="button" class="btn-action btn-primary" style="justify-content: flex-start;" onclick="switchAdminTab('tab-berita', document.querySelectorAll('.nav-tab-btn')[1]); openBeritaModal();">
                Tulis Berita / Agenda Baru
              </button>
              <button type="button" class="btn-action btn-secondary" style="justify-content: flex-start;" onclick="switchAdminTab('tab-dosen', document.querySelectorAll('.nav-tab-btn')[2]); openDosenModal();">
                Tambah Dosen Baru
              </button>
              <button type="button" class="btn-action btn-secondary" style="justify-content: flex-start;" onclick="switchAdminTab('tab-kurikulum', document.querySelectorAll('.nav-tab-btn')[3]);">
                Kelola Kurikulum SKS
              </button>
              <button type="button" class="btn-action btn-secondary" style="justify-content: flex-start;" onclick="switchAdminTab('tab-profil', document.querySelectorAll('.nav-tab-btn')[4]);">
                Perbarui Profil & SK Akreditasi
              </button>
            </div>
          </div>

          <div class="card-box" style="margin-bottom: 0;">
            <div class="card-box-header">
              <h2 class="card-box-title">Status Database</h2>
            </div>
            <div style="font-size: 0.84rem; color: var(--admin-text-muted); line-height: 1.6;">
              <p style="margin-bottom: 0.5rem;">Penyimpanan utama: <strong>SQLite (api/db.php)</strong></p>
              <p style="margin-bottom: 0.5rem;">Cadangan berkas: <strong>data/db.json</strong></p>
              <p style="margin-bottom: 0.75rem;">Status koneksi: <span class="status-badge badge-green">Tersambung & Sinkron</span></p>
              <button type="button" class="btn-action btn-secondary btn-sm" style="width: 100%;" onclick="fetchDB(true)">
                Muat Ulang Sinkronisasi
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Tab 2: Kelola Berita -->
    <section id="tab-berita" class="tab-module">
      <div class="page-header-row">
        <div>
          <h1 class="page-title">Warta Berita & Agenda Program Studi</h1>
          <p class="page-subtitle">Publikasi artikel berita, agenda kegiatan akademik, pengumuman perkuliahan, dan liputan prestasi.</p>
        </div>
        <button type="button" class="btn-action btn-primary" onclick="openBeritaModal()">
          Tambah Berita Baru
        </button>
      </div>

      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 44px;">No</th>
              <th style="width: 76px;">Sampul</th>
              <th>Judul Berita</th>
              <th style="width: 110px;">Kategori</th>
              <th style="width: 130px;">Tanggal</th>
              <th>Ringkasan</th>
              <th style="width: 140px; text-align: center;">Tindakan</th>
            </tr>
          </thead>
          <tbody id="berita-table-body">
            <tr>
              <td colspan="7" style="text-align: center; color: var(--admin-text-subtle);">Memuat data berita...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Tab 3: Direktori Dosen -->
    <section id="tab-dosen" class="tab-module">
      <div class="page-header-row">
        <div>
          <h1 class="page-title">Direktori Dosen & Staf Pengajar</h1>
          <p class="page-subtitle">Kelola daftar profil dosen tetap, Nomor Induk Pegawai (NIP), jabatan akademik, dan bidang keahlian pengajaran.</p>
        </div>
        <button type="button" class="btn-action btn-primary" onclick="openDosenModal()">
          Tambah Dosen Baru
        </button>
      </div>

      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 44px;">No</th>
              <th>Nama & NIP Dosen</th>
              <th>Jabatan Akademik</th>
              <th>Bidang Keahlian</th>
              <th>Email Resmi</th>
              <th style="width: 140px; text-align: center;">Tindakan</th>
            </tr>
          </thead>
          <tbody id="dosen-table-body">
            <tr>
              <td colspan="6" style="text-align: center; color: var(--admin-text-subtle);">Memuat direktori dosen...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Tab 4: Kurikulum SKS -->
    <section id="tab-kurikulum" class="tab-module">
      <div class="page-header-row">
        <div>
          <h1 class="page-title">Struktur Kurikulum SKS</h1>
          <p class="page-subtitle">Kelola sebaran mata kuliah program studi per semester (Semester 1 sampai 8) dengan total 144 SKS.</p>
        </div>
        <button type="button" class="btn-action btn-primary" onclick="openMKModal()">
          Tambah Mata Kuliah
        </button>
      </div>

      <div style="display: flex; gap: 0.45rem; margin-bottom: 1.25rem; flex-wrap: wrap;">
        <button type="button" class="btn-action btn-primary btn-sm sem-tab-btn" onclick="selectAdminSemester(1)">Semester 1</button>
        <button type="button" class="btn-action btn-secondary btn-sm sem-tab-btn" onclick="selectAdminSemester(2)">Semester 2</button>
        <button type="button" class="btn-action btn-secondary btn-sm sem-tab-btn" onclick="selectAdminSemester(3)">Semester 3</button>
        <button type="button" class="btn-action btn-secondary btn-sm sem-tab-btn" onclick="selectAdminSemester(4)">Semester 4</button>
        <button type="button" class="btn-action btn-secondary btn-sm sem-tab-btn" onclick="selectAdminSemester(5)">Semester 5</button>
        <button type="button" class="btn-action btn-secondary btn-sm sem-tab-btn" onclick="selectAdminSemester(6)">Semester 6</button>
        <button type="button" class="btn-action btn-secondary btn-sm sem-tab-btn" onclick="selectAdminSemester(7)">Semester 7</button>
        <button type="button" class="btn-action btn-secondary btn-sm sem-tab-btn" onclick="selectAdminSemester(8)">Semester 8</button>
      </div>

      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 100px;">Kode MK</th>
              <th>Nama Mata Kuliah</th>
              <th style="width: 80px;">SKS</th>
              <th style="width: 120px;">Sifat</th>
              <th>Deskripsi Capaian Pembelajaran</th>
              <th style="width: 140px; text-align: center;">Tindakan</th>
            </tr>
          </thead>
          <tbody id="kurikulum-table-body">
            <tr>
              <td colspan="6" style="text-align: center; color: var(--admin-text-subtle);">Memuat kurikulum semester...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Tab 5: Profil & Pimpinan -->
    <section id="tab-profil" class="tab-module">
      <div class="card-box">
        <div class="card-box-header">
          <div>
            <h1 class="page-title" style="font-size: 1.35rem;">Pengaturan Profil & Pimpinan Program Studi</h1>
            <p class="page-subtitle">Perbarui Visi, Misi, SK Akreditasi LAMDIK, serta data pimpinan program studi.</p>
          </div>
        </div>

        <form id="form-profil" onsubmit="saveProfilForm(event)">
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <div class="form-group">
              <label class="form-label" for="profil-visi">Visi Program Studi</label>
              <textarea id="profil-visi" class="form-textarea" required></textarea>
            </div>
            <div class="form-group">
              <label class="form-label" for="profil-misi">Misi Program Studi (1 baris per butir misi)</label>
              <textarea id="profil-misi" class="form-textarea" required></textarea>
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem;">
            <div class="form-group">
              <label class="form-label" for="profil-sk">Nomor SK Akreditasi LAMDIK</label>
              <input type="text" id="profil-sk" class="form-input" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="profil-berlaku">Masa Berlaku Akreditasi</label>
              <input type="text" id="profil-berlaku" class="form-input" required>
            </div>
          </div>

          <hr style="border: none; border-top: 1px solid var(--admin-border); margin: 1.5rem 0;">

          <h2 style="font-size: 1.05rem; font-weight: 700; color: var(--admin-text-main); margin-bottom: 1rem;">Susunan Pimpinan Program Studi</h2>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.5rem;">
            <div class="form-group">
              <label class="form-label" for="kaprodi-nama">Ketua Program Studi (Ka. Prodi)</label>
              <input type="text" id="kaprodi-nama" class="form-input" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="sekprodi-nama">Sekretaris Program Studi (Sek. Prodi)</label>
              <input type="text" id="sekprodi-nama" class="form-input" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="kalab-nama">Kepala Laboratorium Bahasa</label>
              <input type="text" id="kalab-nama" class="form-input" required>
            </div>
          </div>

          <button type="submit" class="btn-action btn-primary">
            Simpan Perubahan Profil & Pimpinan
          </button>
        </form>
      </div>
    </section>

  </main>

  <!-- Modal Dosen -->
  <div id="modal-dosen" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modal-dosen-title">
    <div class="modal-box">
      <div class="modal-header">
        <h3 id="modal-dosen-title">Tambah Dosen Baru</h3>
        <button type="button" onclick="closeDosenModal()" class="modal-close" aria-label="Tutup modal">&times;</button>
      </div>
      <form id="form-dosen" onsubmit="saveDosenForm(event)">
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label" for="dosen-nama">Nama Lengkap & Gelar Dosen</label>
            <input type="text" id="dosen-nama" class="form-input" placeholder="Contoh: Dr. Rian Prasetyo, M.Pd." required>
          </div>
          <div class="form-group">
            <label class="form-label" for="dosen-nip">Nomor Induk Pegawai (NIP)</label>
            <input type="text" id="dosen-nip" class="form-input" placeholder="Contoh: 19810515 200801 1 005">
          </div>
          <div class="form-group">
            <label class="form-label" for="dosen-jabatan">Jabatan Akademik / Peran</label>
            <input type="text" id="dosen-jabatan" class="form-input" placeholder="Contoh: Lektor Kepala / Ka. Prodi" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="dosen-keahlian">Bidang Keahlian / Spesialisasi</label>
            <input type="text" id="dosen-keahlian" class="form-input" placeholder="Contoh: TEFL, Applied Linguistics, CALL" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="dosen-email">Email Resmi Dosen</label>
            <input type="email" id="dosen-email" class="form-input" placeholder="dosen@upgripontianak.ac.id">
          </div>
          <div class="form-group">
            <label class="form-label" for="dosen-file-upload">Foto Profil Dosen</label>
            <input type="file" id="dosen-file-upload" accept="image/*" class="form-input" style="padding: 0.4rem; margin-bottom: 0.5rem;" onchange="uploadImageFile(this, 'dosen-foto', 'dosen-img-preview')">
            <input type="text" id="dosen-foto" class="form-input" placeholder="Tuliskan jalur foto relatif (contoh: img/uploads/...)" required onchange="updateImgPreview('dosen-img-preview', this.value)">
            <div style="margin-top: 0.5rem;">
              <img id="dosen-img-preview" src="" style="max-height: 80px; border-radius: var(--radius-sm); border: 1px solid var(--admin-border); display: none;" alt="Pratinjau Foto Dosen">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-action btn-secondary btn-sm" onclick="closeDosenModal()">Batal</button>
          <button type="submit" class="btn-action btn-primary btn-sm">Simpan Data Dosen</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Berita -->
  <div id="modal-berita" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modal-berita-title">
    <div class="modal-box" style="max-width: 700px;">
      <div class="modal-header">
        <h3 id="modal-berita-title">Buat Warta Berita Baru</h3>
        <button type="button" onclick="closeBeritaModal()" class="modal-close" aria-label="Tutup modal">&times;</button>
      </div>
      <form id="form-berita" onsubmit="saveBeritaForm(event)">
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label" for="berita-judul">Judul Warta / Berita</label>
            <input type="text" id="berita-judul" class="form-input" placeholder="Tuliskan judul berita atau agenda..." required>
          </div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
              <label class="form-label" for="berita-kategori">Kategori Berita</label>
              <select id="berita-kategori" class="form-select" required>
                <option value="Prestasi">Prestasi</option>
                <option value="Agenda">Agenda</option>
                <option value="Pengumuman">Pengumuman</option>
                <option value="Pengabdian">Pengabdian</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label" for="berita-tanggal">Tanggal Publikasi</label>
              <input type="text" id="berita-tanggal" class="form-input" placeholder="Contoh: 10 Oktober 2026" required>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="berita-ringkasan">Ringkasan Berita (Tampil di Beranda)</label>
            <textarea id="berita-ringkasan" class="form-textarea" style="min-height: 60px;" placeholder="Tuliskan 1-2 kalimat ringkasan warta..." required></textarea>
          </div>
          <div class="form-group">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem; flex-wrap: wrap; gap: 0.5rem;">
              <label class="form-label" for="berita-konten" style="margin-bottom: 0;">Isi Lengkap Berita</label>
              <div style="display: flex; gap: 0.3rem;">
                <button type="button" class="btn-action btn-secondary btn-sm" onclick="formatTextarea('berita-konten', 'bold')" title="Tebal">Tebal</button>
                <button type="button" class="btn-action btn-secondary btn-sm" onclick="formatTextarea('berita-konten', 'italic')" title="Miring">Miring</button>
                <button type="button" class="btn-action btn-secondary btn-sm" onclick="formatTextarea('berita-konten', 'underline')" title="Garis Bawah">Garis Bawah</button>
                <button type="button" class="btn-action btn-secondary btn-sm" onclick="formatTextarea('berita-konten', 'h3')" title="Sub-Judul">Subjudul</button>
                <button type="button" class="btn-action btn-secondary btn-sm" onclick="formatTextarea('berita-konten', 'list')" title="Daftar Poin">Daftar Poin</button>
              </div>
            </div>
            <textarea id="berita-konten" class="form-textarea" style="min-height: 160px;" placeholder="Tuliskan isi warta atau artikel selengkapnya di sini..."></textarea>
            <div class="form-hint">
              Shortcut editor teks: Blok teks lalu tekan Ctrl + B (Tebal), Ctrl + I (Miring), Ctrl + U (Garis Bawah).
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="berita-file-upload">Gambar Sampul Berita</label>
            <input type="file" id="berita-file-upload" accept="image/*" class="form-input" style="padding: 0.4rem; margin-bottom: 0.5rem;" onchange="uploadImageFile(this, 'berita-gambar', 'berita-img-preview')">
            <input type="text" id="berita-gambar" class="form-input" placeholder="Tuliskan jalur gambar (contoh: img/uploads/...)" required onchange="updateImgPreview('berita-img-preview', this.value)">
            <div style="margin-top: 0.5rem;">
              <img id="berita-img-preview" src="" style="max-height: 90px; border-radius: var(--radius-sm); border: 1px solid var(--admin-border); display: none;" alt="Pratinjau Sampul Berita">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-action btn-secondary btn-sm" onclick="closeBeritaModal()">Batal</button>
          <button type="submit" class="btn-action btn-primary btn-sm">Simpan Berita</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Mata Kuliah -->
  <div id="modal-mk" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modal-mk-title">
    <div class="modal-box">
      <div class="modal-header">
        <h3 id="modal-mk-title">Tambah Mata Kuliah</h3>
        <button type="button" onclick="closeMKModal()" class="modal-close" aria-label="Tutup modal">&times;</button>
      </div>
      <form id="form-mk" onsubmit="saveMKForm(event)">
        <div class="modal-body">
          <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1rem;">
            <div class="form-group">
              <label class="form-label" for="mk-kode">Kode MK</label>
              <input type="text" id="mk-kode" class="form-input" placeholder="Contoh: PBI101" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="mk-nama">Nama Mata Kuliah</label>
              <input type="text" id="mk-nama" class="form-input" placeholder="Nama mata kuliah kurikulum" required>
            </div>
          </div>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
              <label class="form-label" for="mk-sks">Bobot SKS</label>
              <input type="number" id="mk-sks" class="form-input" min="1" max="12" value="3" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="mk-sifat">Sifat Mata Kuliah</label>
              <select id="mk-sifat" class="form-select" required>
                <option value="Wajib">Wajib</option>
                <option value="Wajib Umum">Wajib Umum</option>
                <option value="Wajib MBKM">Wajib MBKM</option>
                <option value="Pilihan">Pilihan</option>
                <option value="Peminatan">Peminatan</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="mk-desc">Deskripsi Capaian Pembelajaran</label>
            <textarea id="mk-desc" class="form-textarea" placeholder="Ringkasan capaian mata kuliah..." required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-action btn-secondary btn-sm" onclick="closeMKModal()">Batal</button>
          <button type="submit" class="btn-action btn-primary btn-sm">Simpan Mata Kuliah</button>
        </div>
      </form>
    </div>
  </div>

  <footer style="border-top: 1px solid var(--admin-border); padding: 1.5rem 0; text-align: center; color: var(--admin-text-subtle); font-size: 0.82rem; background: var(--admin-surface); margin-top: 3rem;">
    Panel Admin Program Studi S1 Pendidikan Bahasa Inggris &bull; Universitas PGRI Pontianak
  </footer>

  <script src="admin.js"></script>
</body>
</html>
