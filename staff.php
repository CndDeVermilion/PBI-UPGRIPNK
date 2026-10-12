<?php
$title = "Staff & Direktori Dosen | English Edu UPGRI Pontianak";
$meta_description = "Direktori Dosen Pengajar, Pimpinan Program Studi, dan Peneliti Bidang TEFL, Educational Technology & Linguistik PBI UPGRI Pontianak.";
$page = "staff";

require_once __DIR__ . '/api/db.php';

$dosenStmt = $pdo->query("SELECT dosen_id as id, nama, nip, jabatan, bidang_keahlian as bidangKeahlian, email, foto, pendidikan FROM dosen ORDER BY id ASC");
$dosenList = $dosenStmt->fetchAll();

include 'components/header.php';
?>

<main id="main-content">
  <section class="section container">
    <div class="text-center section-header">
      <span class="badge badge-purple">STAFF PENGAJAR</span>
      <h1 class="section-title" style="font-size: 2.2rem;">Direktori Dosen & Pimpinan Prodi</h1>
      <p class="section-subtitle">Para akademisi, peneliti, dan praktisi pengajaran Bahasa Inggris profesional di Fakultas Pendidikan Bahasa dan Seni (FPBS).</p>
    </div>

    <div style="margin-bottom: 4rem;" id="profil-pimpinan">
      <h2 class="text-center section-title" style="font-size: 1.6rem; margin-bottom: 2rem;">Pimpinan Program Studi</h2>
      <div class="grid-3" id="profil-pimpinan-list">
        <div class="card card-hover" style="text-align: center; padding: 1.75rem 1.25rem;">
          <div style="position: relative; width: 100px; height: 100px; margin: 0 auto 1.25rem auto; display: flex; align-items: center; justify-content: center; background: var(--purple-50); border-radius: 50%; border: 2px solid var(--purple-200);">
            <img src="img/Logo_UPGRI.png" alt="Ketua Program Studi" style="width: 56px; height: auto;">
          </div>
          <span class="badge badge-purple" style="margin-bottom: 0.5rem;">Ketua Program Studi</span>
          <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--purple-950); margin-bottom: 0.25rem;">Dosen 1, M.Pd.</h3>
          <p style="font-size: 0.82rem; color: var(--slate-500); margin-bottom: 0.85rem;">Email: kaprodi.pbi@upgripontianak.ac.id</p>
          <p style="font-size: 0.86rem; color: var(--slate-600); line-height: 1.55;">Memimpin tata kelola akademik, kurikulum KKNI, dan pengembangan mutu Program Studi S1 Pendidikan Bahasa Inggris.</p>
        </div>

        <div class="card card-hover" style="text-align: center; padding: 1.75rem 1.25rem;">
          <div style="position: relative; width: 100px; height: 100px; margin: 0 auto 1.25rem auto; display: flex; align-items: center; justify-content: center; background: var(--purple-50); border-radius: 50%; border: 2px solid var(--purple-200);">
            <img src="img/Logo_UPGRI.png" alt="Sekretaris Program Studi" style="width: 56px; height: auto;">
          </div>
          <span class="badge badge-purple" style="margin-bottom: 0.5rem;">Sekretaris Program Studi</span>
          <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--purple-950); margin-bottom: 0.25rem;">Dosen 2, M.Pd.</h3>
          <p style="font-size: 0.82rem; color: var(--slate-500); margin-bottom: 0.85rem;">Email: sekprodi.pbi@upgripontianak.ac.id</p>
          <p style="font-size: 0.86rem; color: var(--slate-600); line-height: 1.55;">Mengelola administrasi akademik, sistem perkuliahan, registrasi mahasiswa, dan operasional sekretariat prodi.</p>
        </div>

        <div class="card card-hover" style="text-align: center; padding: 1.75rem 1.25rem;">
          <div style="position: relative; width: 100px; height: 100px; margin: 0 auto 1.25rem auto; display: flex; align-items: center; justify-content: center; background: var(--purple-50); border-radius: 50%; border: 2px solid var(--purple-200);">
            <img src="img/Logo_UPGRI.png" alt="Kepala Laboratorium Bahasa" style="width: 56px; height: auto;">
          </div>
          <span class="badge badge-purple" style="margin-bottom: 0.5rem;">Kepala Laboratorium Bahasa</span>
          <h3 style="font-size: 1.15rem; font-weight: 700; color: var(--purple-950); margin-bottom: 0.25rem;">Dosen 3, M.Pd.</h3>
          <p style="font-size: 0.82rem; color: var(--slate-500); margin-bottom: 0.85rem;">Email: kalab.pbi@upgripontianak.ac.id</p>
          <p style="font-size: 0.86rem; color: var(--slate-600); line-height: 1.55;">Mengoordinasikan praktikum laboratorium microteaching, CALL, pengujian TOEFL, dan studio multimedia kependidikan.</p>
        </div>
      </div>
    </div>

    <div style="margin-top: 4.5rem;" id="profil-dosen-grid-wrap">
      <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
          <span class="badge badge-purple">HOMEBASE DOSEN</span>
          <h2 class="section-title">Direktori Dosen & Peneliti PBI</h2>
        </div>
        <input type="text" id="dosen-search-input" placeholder="Cari nama dosen / kepakaran TEFL..." class="card"
          style="padding: 0.55rem 1.1rem; font-size: 0.9rem; width: 320px; outline: none;" onkeyup="filterDosenGrid(this.value)">
      </div>

      <div class="grid-3" id="profil-dosen-grid">
        <?php foreach ($dosenList as $d): ?>
          <div class="card card-hover dosen-card-item" data-nama="<?php echo strtolower(htmlspecialchars($d['nama'])); ?>" data-keahlian="<?php echo strtolower(htmlspecialchars($d['bidangKeahlian'])); ?>" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
            <div>
              <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                <img src="<?php echo htmlspecialchars($d['foto']); ?>" alt="<?php echo htmlspecialchars($d['nama']); ?>" style="width: 64px; height: 64px; border-radius: 50%; object-fit: cover; border: 2px solid var(--purple-300); flex-shrink: 0;">
                <div>
                  <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--purple-950); margin-bottom: 0.15rem; line-height: 1.3;"><?php echo htmlspecialchars($d['nama']); ?></h3>
                  <div style="font-size: 0.78rem; color: var(--slate-500); font-weight: 500;"><?php echo !empty($d['nip']) ? 'NIP: ' . htmlspecialchars($d['nip']) : 'Dosen Pengajar PBI'; ?></div>
                  <span class="badge badge-purple" style="margin-top: 0.35rem; display: inline-block; font-size: 0.72rem;"><?php echo htmlspecialchars($d['jabatan']); ?></span>
                </div>
              </div>

              <div style="margin-bottom: 1rem; border-top: 1px solid var(--purple-100); padding-top: 0.85rem;">
                <div style="font-size: 0.78rem; font-weight: 700; color: var(--slate-500); text-transform: uppercase; margin-bottom: 0.25rem;">Bidang Keahlian / Specialization</div>
                <div style="font-size: 0.86rem; color: var(--purple-950); font-weight: 600; line-height: 1.45;"><?php echo htmlspecialchars($d['bidangKeahlian']); ?></div>
              </div>

              <div style="margin-bottom: 1rem;">
                <div style="font-size: 0.78rem; font-weight: 700; color: var(--slate-500); text-transform: uppercase; margin-bottom: 0.25rem;">Riwayat Pendidikan</div>
                <div style="font-size: 0.82rem; color: var(--slate-600); line-height: 1.45;">
                  <?php 
                    $pend = is_array($d['pendidikan']) ? implode('<br>• ', $d['pendidikan']) : str_replace(';', '<br>• ', $d['pendidikan']);
                    echo '• ' . $pend;
                  ?>
                </div>
              </div>
            </div>

            <div style="border-top: 1px solid var(--purple-100); padding-top: 0.75rem; font-size: 0.8rem; color: var(--slate-500); display: flex; justify-content: space-between; align-items: center;">
              <span>Email: <?php echo htmlspecialchars($d['email']); ?></span>
              <span class="badge badge-slate" style="font-size: 0.7rem;">FPBS UPGRI</span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<script>
function filterDosenGrid(query) {
  const q = query.toLowerCase().trim();
  document.querySelectorAll('.dosen-card-item').forEach(card => {
    const nama = card.getAttribute('data-nama') || '';
    const keahlian = card.getAttribute('data-keahlian') || '';
    if (nama.includes(q) || keahlian.includes(q)) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}
</script>

<?php include 'components/footer.php'; ?>