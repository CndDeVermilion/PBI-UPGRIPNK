<?php
$title = "Informasi & PMB | English Edu UPGRI Pontianak";
$meta_description = "Informasi Pendaftaran Mahasiswa Baru (PMB) S1 PBI, Warta Berita Terkini, Rincian Biaya SPP Studi, Grup Riset JELTL, dan Pelayanan Sekretariat PBI UPGRI Pontianak.";
$page = "informasi";

require_once __DIR__ . '/api/db.php';

$newsStmt = $pdo->query("SELECT news_id as id, slug, judul, kategori, tanggal, ringkasan, gambar FROM berita ORDER BY id DESC LIMIT 6");
$infoBerita = $newsStmt->fetchAll();

include 'components/header.php';
?>

<main id="main-content">
  <section class="section container" id="berita">
    <div class="text-center section-header">
      <h1 class="section-title" style="font-size: 2.2rem;">Berita & Agenda Akademik</h1>
      <p class="section-subtitle">Pengumuman akademis, agenda workshop pengajaran bahasa, seminar internasional, dan prestasi prodi.</p>
    </div>
    
    <div class="grid-3" id="home-berita-list" style="margin-bottom: 2.5rem;">
      <?php foreach ($infoBerita as $b): ?>
        <div class="card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
          <img src="<?php echo htmlspecialchars($b['gambar']); ?>" alt="<?php echo htmlspecialchars($b['judul']); ?>" style="height: 175px; width: 100%; object-fit: cover;">
          <div style="padding: 1.25rem; flex-grow: 1; display: flex; flex-direction: column;">
            <div style="display: flex; gap: 0.5rem; margin-bottom: 0.4rem; align-items: center;">
              <span class="badge badge-purple"><?php echo htmlspecialchars($b['kategori']); ?></span>
              <span style="font-size: 0.76rem; color: var(--slate-500);"><?php echo htmlspecialchars($b['tanggal']); ?></span>
            </div>
            <h3 style="font-size: 1rem; margin-bottom: 0.4rem; line-height: 1.35; color: var(--purple-950);">
              <a href="berita-detail.php?id=<?php echo htmlspecialchars($b['id']); ?>" style="color: inherit; text-decoration: none;"><?php echo htmlspecialchars($b['judul']); ?></a>
            </h3>
            <p style="font-size: 0.84rem; color: var(--slate-600); flex-grow: 1; margin-bottom: 1rem;"><?php echo htmlspecialchars($b['ringkasan']); ?></p>
            <a href="berita-detail.php?id=<?php echo htmlspecialchars($b['id']); ?>" class="btn btn-outline btn-sm" style="text-align: center; text-decoration: none;">Baca Selengkapnya</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div style="text-align: center; margin-bottom: 3.5rem;">
      <a href="berita.php" class="btn btn-purple">Lihat Seluruh Arsip Portal Berita</a>
    </div>
  </section>

  <section class="section" style="background: var(--slate-100);" id="riset">
    <div class="container">
      <div class="text-center section-header">
        <h2 class="section-title">Grup Riset, Jurnal JELTL & Kemitraan</h2>
        <p class="section-subtitle">Fokus penelitian pengajaran bahasa Inggris (TEFL), linguistik terapan, dan kerjasama sekolah mitra.</p>
      </div>

      <h3 style="font-size: 1.35rem; margin-bottom: 1.25rem;">Grup Riset Unggulan</h3>
      <div class="grid-3" id="grup-riset-list" style="margin-bottom: 3rem;">
        <div class="card card-hover">
          <span class="badge badge-purple" style="margin-bottom: 0.5rem;">Bidang Utama</span>
          <h4 style="font-size: 1.1rem; color: var(--purple-950); margin-bottom: 0.5rem; font-weight: 700;">TEFL & EdTech Pedagogy</h4>
          <p style="font-size: 0.86rem; color: var(--slate-600); line-height: 1.55;">
            Pengembangan model pengajaran bahasa Inggris berbasis teknologi digital (CALL/MALL), Gamification in ELT, dan integrasi Artificial Intelligence dalam kelas bahasa.
          </p>
        </div>

        <div class="card card-hover">
          <span class="badge badge-purple" style="margin-bottom: 0.5rem;">Bidang Keahlian</span>
          <h4 style="font-size: 1.1rem; color: var(--purple-950); margin-bottom: 0.5rem; font-weight: 700;">Applied Linguistics & Discourse Analysis</h4>
          <p style="font-size: 0.86rem; color: var(--slate-600); line-height: 1.55;">
            Kajian sosiolinguistik masyarakat multilingual Kalimantan Barat, analisis wacana kritis teks kependidikan, dan sosiologi bahasa.
          </p>
        </div>

        <div class="card card-hover">
          <span class="badge badge-purple" style="margin-bottom: 0.5rem;">Bidang Kebudayaan</span>
          <h4 style="font-size: 1.1rem; color: var(--purple-950); margin-bottom: 0.5rem; font-weight: 700;">Literature & Cultural Studies</h4>
          <p style="font-size: 0.86rem; color: var(--slate-600); line-height: 1.55;">
            Analisis karya sastra Inggris dan pemanfaatan cerita rakyat kearifan lokal Kalimantan Barat sebagai media pengajaran karakter murid.
          </p>
        </div>
      </div>

      <div class="card" style="margin-bottom: 3rem; background: white; border: 1px solid var(--purple-200);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.25rem;">
          <div>
            <h3 style="font-size: 1.35rem; margin-top: 0.35rem;" id="jurnal-nama">Jurnal JELTL (Journal of English Language Teaching and Literature)</h3>
            <p style="color: var(--slate-600); font-size: 0.88rem;" id="jurnal-info">Jurnal Ilmiah Berkala Nasional Terakreditasi SINTA & OAI Indexed (e-ISSN: 2548-7728)</p>
          </div>
          <a href="https://jurnal.upgripontianak.ac.id/index.php/jeltl" target="_blank" class="btn btn-outline">Portal Jurnal JELTL</a>
        </div>
      </div>

      <h3 style="font-size: 1.35rem; margin-bottom: 1.25rem;">Jaringan Kemitraan Sekolah & Institusi Bahasa</h3>
      <div class="grid-4" id="mitra-grid-list">
        <div class="card" style="text-align: center; padding: 1.1rem;">
          <h4 style="font-size: 0.98rem; font-weight: 700; color: var(--purple-950);">Sekolah Mitra PLP/PPL</h4>
          <p style="font-size: 0.82rem; color: var(--slate-500); margin-top: 0.25rem;">35+ SMP/SMA/SMK Kota Pontianak & Kubu Raya</p>
        </div>
        <div class="card" style="text-align: center; padding: 1.1rem;">
          <h4 style="font-size: 0.98rem; font-weight: 700; color: var(--purple-950);">MGMP Bahasa Inggris</h4>
          <p style="font-size: 0.82rem; color: var(--slate-500); margin-top: 0.25rem;">Asosiasi Guru Bahasa Inggris Kalbar</p>
        </div>
        <div class="card" style="text-align: center; padding: 1.1rem;">
          <h4 style="font-size: 0.98rem; font-weight: 700; color: var(--purple-950);">Lembaga Kursus Bahasa</h4>
          <p style="font-size: 0.82rem; color: var(--slate-500); margin-top: 0.25rem;">Mitra Magang & Pelatihan TOEFL/EPT</p>
        </div>
        <div class="card" style="text-align: center; padding: 1.1rem;">
          <h4 style="font-size: 0.98rem; font-weight: 700; color: var(--purple-950);">Konsorsium TEFLIN</h4>
          <p style="font-size: 0.82rem; color: var(--slate-500); margin-top: 0.25rem;">Asosiasi Pengajar Bahasa Inggris Indonesia</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section container" id="pmb">
    <div class="text-center section-header">
      <h2 class="section-title">Penerimaan Mahasiswa Baru TA 2026/2027</h2>
      <p class="section-subtitle">Informasi alur seleksi pendaftaran, beasiswa prestasi, dan rincian biaya studi prodi S1 PBI.</p>
      <div style="margin-top: 1.25rem;">
        <a href="https://spmb.upgripnk.ac.id/" target="_blank" class="btn btn-amber btn-lg">Daftar Sekarang di Portal Resmi SPMB UPGRI</a>
      </div>
    </div>

    <div class="grid-2" style="margin-bottom: 3.5rem;">
      <div class="card">
        <h3 style="font-size: 1.3rem; color: var(--purple-950); margin-bottom: 1rem;">Jalur Seleksi Pendaftaran PMB</h3>
        <div id="pmb-jalur-list" style="display: flex; flex-direction: column; gap: 0.85rem;">
          <div style="background: var(--purple-50); padding: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--purple-200);">
            <h4 style="font-size: 1rem; color: var(--purple-950); margin-bottom: 0.25rem; font-weight: 700;">Jalur Reguler SPMB</h4>
            <p style="font-size: 0.85rem; color: var(--slate-600);">Seleksi tes berbasis komputer (CBT) atau nilai rapor SMA/SMK/MA sederajat.</p>
          </div>
          <div style="background: var(--purple-50); padding: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--purple-200);">
            <h4 style="font-size: 1rem; color: var(--purple-950); margin-bottom: 0.25rem; font-weight: 700;">Jalur Prestasi Akademik & Non-Akademik</h4>
            <p style="font-size: 0.85rem; color: var(--slate-600);">Bebas tes tertulis bagi pemenang lomba debat bahasa Inggris, duta bahasa, atau juara olahraga/seni.</p>
          </div>
          <div style="background: var(--purple-50); padding: 1rem; border-radius: var(--radius-sm); border: 1px solid var(--purple-200);">
            <h4 style="font-size: 1rem; color: var(--purple-950); margin-bottom: 0.25rem; font-weight: 700;">Jalur Beasiswa KIP-Kuliah & Yayasan</h4>
            <p style="font-size: 0.85rem; color: var(--slate-600);">Bantuan biaya pendidikan penuh dari Kemendikbudristek bagi calon mahasiswa berprestasi dari keluarga kurang mampu.</p>
          </div>
        </div>
      </div>

      <div class="card" id="biaya">
        <h3 style="font-size: 1.3rem; color: var(--emerald-700); margin-bottom: 1rem;">Rincian Biaya Studi (Program S1 Reguler)</h3>
        <div class="table-responsive">
          <table class="table-custom">
            <tbody id="biaya-studi-table-body">
              <tr>
                <td style="font-weight: 700; color: var(--purple-950);">Biaya Pendaftaran</td>
                <td style="text-align: right; font-weight: 700; color: var(--emerald-700);">Rp 750.000</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: var(--purple-950);">Biaya Rekognisi/Konversi</td>
                <td style="text-align: right; font-weight: 700; color: var(--emerald-700);">Rp 75.000</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: var(--purple-950);">SPP Kuliah Semester 1</td>
                <td style="text-align: right; font-weight: 700; color: var(--emerald-700);">Rp 5.060.000</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: var(--purple-950);">SPP Kuliah Semester 2 s/d 7</td>
                <td style="text-align: right; font-weight: 700; color: var(--emerald-700);">Rp. 4.660.000 / sem</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: var(--purple-950);">SPP Kuliah Semester 8</td>
                <td style="text-align: right; font-weight: 700; color: var(--emerald-700);">Rp 3.550.000</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: var(--purple-950);">SPP Kuliah Semester 9 s/d 14</td>
                <td style="text-align: right; font-weight: 700; color: var(--emerald-700);">Rp 2.445.000</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="grid-2" style="align-items: start;" id="kontak">
      <div class="card">
        <h3 style="font-size: 1.3rem; margin-bottom: 1rem;">Formulir Pelayanan Informasi PBI</h3>
        <form onsubmit="handleContactFormSubmit(event)">
          <div style="margin-bottom: 0.85rem;">
            <label style="font-size: 0.82rem; font-weight: 600; display: block; margin-bottom: 0.3rem;">Nama Lengkap</label>
            <input type="text" required placeholder="Nama calon mahasiswa / pemohon" class="card"
              style="width: 100%; padding: 0.55rem 0.85rem; font-size: 0.9rem; outline: none;">
          </div>
          <div style="margin-bottom: 0.85rem;">
            <label style="font-size: 0.82rem; font-weight: 600; display: block; margin-bottom: 0.3rem;">Email / No. WhatsApp</label>
            <input type="text" required placeholder="Nomor telepon aktif" class="card"
              style="width: 100%; padding: 0.55rem 0.85rem; font-size: 0.9rem; outline: none;">
          </div>
          <div style="margin-bottom: 1.1rem;">
            <label style="font-size: 0.82rem; font-weight: 600; display: block; margin-bottom: 0.3rem;">Isi Pertanyaan / Keperluan</label>
            <textarea rows="4" required placeholder="Tanyakan seputar pendaftaran PMB PBI atau info prodi..."
              class="card"
              style="width: 100%; padding: 0.55rem 0.85rem; font-size: 0.9rem; outline: none; font-family: inherit;"></textarea>
          </div>
          <button type="submit" class="btn btn-purple" style="width: 100%;">Kirim Pesan ke Sekretariat PBI</button>
        </form>
        <div id="contact-alert-msg" style="display: none; margin-top: 1rem; padding: 0.75rem 1rem; border-radius: var(--radius-sm); background: #d1fae5; color: #065f46; font-size: 0.88rem; font-weight: 600;">
          Pesan Anda telah dikirimkan ke Sekretariat PBI UPGRI Pontianak. Tim kami akan menghubungi Anda segera.
        </div>
      </div>

      <div>
        <div class="card" style="margin-bottom: 1.25rem;">
          <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem;">Sekretariat Program Studi</h3>
          <p style="font-size: 0.88rem; color: var(--slate-600); margin-bottom: 1rem;" id="kontak-alamat-text">
            Gedung FPBS Lantai 2, Kampus Utama Universitas PGRI Pontianak, Jl. Ampera No. 88, Kota Pontianak, Kalimantan Barat 78116.
          </p>
          <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
            <a href="https://wa.me/6281256000000" target="_blank" class="btn btn-sm"
              style="background: #059669; color: white; text-decoration: none;">WhatsApp Center PBI</a>
            <a href="mailto:Prodipbing@gmail.com" class="btn btn-outline btn-sm">Email Resmi</a>
          </div>
        </div>

        <div style="border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border-color);">
          <iframe id="google-maps-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8171052673236!2d109.30948937496464!3d-0.03816789996145326!2m3!1f0!0!f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d5964f434cd4d%3A0x6b9d6a36fa6c581e!2sUniversitas%20PGRI%20Pontianak!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="240" style="border:0;" allowfullscreen=""
            loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
function handleContactFormSubmit(e) {
  e.preventDefault();
  const alertMsg = document.getElementById('contact-alert-msg');
  if (alertMsg) {
    alertMsg.style.display = 'block';
  }
}
</script>

<?php include 'components/footer.php'; ?>

