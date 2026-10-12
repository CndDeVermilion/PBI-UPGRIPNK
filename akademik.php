<?php
$title = "Akademik & Kurikulum | English Edu UPGRI Pontianak";
$meta_description = "Struktur Kurikulum 144 SKS KKNI, Distribusi Mata Kuliah Semester 1-8, Profil Lulusan (Graduate Profiles), dan Tahapan Skripsi PBI UPGRI Pontianak.";
$page = "akademik";

require_once __DIR__ . '/api/db.php';

$kurikulumStmt = $pdo->query("SELECT semester, kode, nama, sks, sifat, desc FROM kurikulum ORDER BY semester ASC, id ASC");
$allMK = $kurikulumStmt->fetchAll();

$semestersData = [];
for ($i = 1; $i <= 8; $i++) {
    $semMK = array_values(array_filter($allMK, function($m) use ($i) {
        return (int)$m['semester'] === $i;
    }));
    $totalSKS = array_reduce($semMK, function($sum, $m) { return $sum + (int)$m['sks']; }, 0);
    $semestersData[$i] = [
        'totalSKS' => $totalSKS,
        'mk' => $semMK
    ];
}

include 'components/header.php';
?>

<main id="main-content">
  <section class="section container" id="kurikulum">
    
    <div class="text-center section-header">
      <h1 class="section-title" style="font-size: 2.2rem;">Kurikulum & Distribusi Mata Kuliah</h1>
      <p class="section-subtitle">Total 144 SKS terdistribusi dalam 8 semester mengacu pada standar Kurikulum Merdeka Kependidikan dan Kerangka Kualifikasi Nasional Indonesia (KKNI).</p>
    </div>

    <div class="semester-tabs-wrapper" style="background: var(--slate-100); border: 1px solid var(--slate-200); padding: 0.4rem; border-radius: var(--radius-md); display: flex; gap: 0.35rem; overflow-x: auto; margin-bottom: 2rem; scrollbar-width: thin;" id="semester-tabs-container">
      <?php for ($s = 1; $s <= 8; $s++): ?>
        <button class="sem-btn" onclick="selectSemester(<?php echo $s; ?>, this)" style="flex: 1; min-width: 120px; text-align: center; padding: 0.6rem 0.85rem; border-radius: var(--radius-sm); font-weight: 700; font-size: 0.84rem; transition: all 0.2s; background: <?php echo ($s === 1) ? 'var(--purple-900)' : 'transparent'; ?>; color: <?php echo ($s === 1) ? '#FFFFFF' : 'var(--slate-700)'; ?>; border: none;">
          Semester <?php echo $s; ?>
          <span style="display: block; font-size: 0.74rem; font-weight: 500; opacity: 0.85; margin-top: 2px;"><?php echo $semestersData[$s]['totalSKS']; ?> SKS</span>
        </button>
      <?php endfor; ?>
    </div>

    <?php for ($s = 1; $s <= 8; $s++): ?>
      <div class="table-responsive semester-table-wrapper" id="sem-table-<?php echo $s; ?>" style="margin-bottom: 3.5rem; <?php echo ($s !== 1) ? 'display: none;' : ''; ?>">
        <table class="table-custom">
          <thead>
            <tr>
              <th style="width: 110px;">Kode MK</th>
              <th>Nama Mata Kuliah</th>
              <th style="width: 100px; text-align: center;">Bobot</th>
              <th style="width: 120px;">Sifat</th>
              <th>Deskripsi & Capaian Pembelajaran</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($semestersData[$s]['mk'])): ?>
              <?php foreach ($semestersData[$s]['mk'] as $mk): ?>
                <tr>
                  <td style="font-weight: 700; color: var(--purple-950); font-family: monospace; font-size: 0.9rem;"><?php echo htmlspecialchars($mk['kode']); ?></td>
                  <td style="font-weight: 600; color: var(--slate-900);"><?php echo htmlspecialchars($mk['nama']); ?></td>
                  <td style="text-align: center; font-weight: 700; color: var(--purple-900);"><?php echo htmlspecialchars($mk['sks']); ?> SKS</td>
                  <td style="font-size: 0.84rem; font-weight: 600; color: <?php echo strpos($mk['sifat'], 'Wajib') !== false ? 'var(--slate-700)' : 'var(--emerald-700)'; ?>;"><?php echo htmlspecialchars($mk['sifat']); ?></td>
                  <td style="color: var(--slate-600); font-size: 0.88rem; line-height: 1.55;"><?php echo htmlspecialchars($mk['desc']); ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" style="text-align: center; color: var(--slate-500); padding: 2.5rem;">Belum ada data mata kuliah untuk Semester <?php echo $s; ?>.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    <?php endfor; ?>

    <div style="margin-top: 4rem;" id="profil-lulusan-list-wrap">
      <div style="margin-bottom: 2rem;">
        <h2 style="font-size: 1.6rem; color: var(--purple-950); margin-bottom: 0.4rem;">Profil Lulusan (Graduate Profiles)</h2>
        <p style="font-size: 0.95rem; color: var(--slate-600); margin: 0;">Lulusan S1 Pendidikan Bahasa Inggris dibekali kompetensi pedagogik, keahlian berbahasa, serta literasi teknologi pembelajaran.</p>
      </div>

      <div class="grid-2" id="profil-lulusan-list">
        
        <div class="card" style="padding: 1.75rem; border: 1px solid var(--border-color); background: var(--white); display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <h3 style="font-size: 1.2rem; color: var(--purple-950); margin-bottom: 0.6rem; line-height: 1.3;">Guru & Pendidik Bahasa Inggris</h3>
            <p style="font-size: 0.9rem; color: var(--slate-600); line-height: 1.65; margin-bottom: 1.25rem;">
              Tenaga pendidik profesional di jenjang SMP, SMA/SMK, MA, serta lembaga kursus bahasa skala nasional & internasional dengan kualifikasi pengajaran modern.
            </p>
          </div>
          <div style="border-top: 1px solid var(--slate-200); padding-top: 0.85rem; margin-top: 0.5rem;">
            <span style="display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; color: var(--purple-900); margin-bottom: 0.35rem;">Prospek Karir Utama:</span>
            <p style="font-size: 0.84rem; color: var(--slate-700); font-weight: 600; margin: 0; line-height: 1.4;">
              Guru Bahasa Inggris • Instruktur Lembaga Kursus • Pengembang Kurikulum Language Center
            </p>
          </div>
        </div>

        <div class="card" style="padding: 1.75rem; border: 1px solid var(--border-color); background: var(--white); display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <h3 style="font-size: 1.2rem; color: var(--purple-950); margin-bottom: 0.6rem; line-height: 1.3;">Penerjemah & Juru Bahasa (Translator & Interpreter)</h3>
            <p style="font-size: 0.9rem; color: var(--slate-600); line-height: 1.65; margin-bottom: 1.25rem;">
              Praktisi komunikasi lintas bahasa yang menguasai teknik penerjemahan dokumen ilmiah, sastra, legal, serta lokalisasi media interaktif.
            </p>
          </div>
          <div style="border-top: 1px solid var(--slate-200); padding-top: 0.85rem; margin-top: 0.5rem;">
            <span style="display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; color: var(--purple-900); margin-bottom: 0.35rem;">Prospek Karir Utama:</span>
            <p style="font-size: 0.84rem; color: var(--slate-700); font-weight: 600; margin: 0; line-height: 1.4;">
              Penerjemah Tersumpah (Sworn Translator) • Conference Interpreter • Specialist Localizer
            </p>
          </div>
        </div>

        <div class="card" style="padding: 1.75rem; border: 1px solid var(--border-color); background: var(--white); display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <h3 style="font-size: 1.2rem; color: var(--purple-950); margin-bottom: 0.6rem; line-height: 1.3;">Peneliti & Pengembang Media Pembelajaran (EdTech Developer)</h3>
            <p style="font-size: 0.9rem; color: var(--slate-600); line-height: 1.65; margin-bottom: 1.25rem;">
              Peneliti bidang pengajaran bahasa Inggris dan pengembang konten media pembelajaran digital (Computer-Assisted Language Learning).
            </p>
          </div>
          <div style="border-top: 1px solid var(--slate-200); padding-top: 0.85rem; margin-top: 0.5rem;">
            <span style="display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; color: var(--purple-900); margin-bottom: 0.35rem;">Prospek Karir Utama:</span>
            <p style="font-size: 0.84rem; color: var(--slate-700); font-weight: 600; margin: 0; line-height: 1.4;">
              Peneliti ELT • Instructional Designer • Educational Content Creator
            </p>
          </div>
        </div>

        <div class="card" style="padding: 1.75rem; border: 1px solid var(--border-color); background: var(--white); display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <h3 style="font-size: 1.2rem; color: var(--purple-950); margin-bottom: 0.6rem; line-height: 1.3;">Praktisi Bahasa & EdUpreneur</h3>
            <p style="font-size: 0.9rem; color: var(--slate-600); line-height: 1.65; margin-bottom: 1.25rem;">
              Wirausahawan mandiri di bidang jasa konsultan pendidikan bahasa, penerbitan materi edukasi, dan jurnalisme bahasa Inggris.
            </p>
          </div>
          <div style="border-top: 1px solid var(--slate-200); padding-top: 0.85rem; margin-top: 0.5rem;">
            <span style="display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; color: var(--purple-900); margin-bottom: 0.35rem;">Prospek Karir Utama:</span>
            <p style="font-size: 0.84rem; color: var(--slate-700); font-weight: 600; margin: 0; line-height: 1.4;">
              Direktur Pusat Bahasa • Academic Editor & Proofreader • Konsultan Edukasi
            </p>
          </div>
        </div>

      </div>
    </div>

    <div style="margin-top: 4rem; background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 2.25rem;" id="alur-skripsi-list-wrap">
      <div style="margin-bottom: 2rem;">
        <h2 style="font-size: 1.5rem; color: var(--purple-950); margin-bottom: 0.4rem;">Tahapan Skripsi & Penulisan Karya Ilmiah</h2>
        <p style="font-size: 0.92rem; color: var(--slate-600); margin: 0;">Prosedur penyelesaian tugas akhir mahasiswa S1 Pendidikan Bahasa Inggris UPGRI Pontianak.</p>
      </div>

      <div style="display: flex; flex-direction: column; gap: 1.25rem;" id="alur-skripsi-list">
        
        <div style="display: flex; gap: 1.25rem; align-items: flex-start; padding-bottom: 1.25rem; border-bottom: 1px solid var(--slate-200);">
          <div style="flex-shrink: 0; width: 42px; height: 42px; border-radius: 50%; background: var(--purple-100); color: var(--purple-900); font-weight: 800; display: flex; align-items: center; justify-content: center; font-size: 0.95rem;">
            1
          </div>
          <div style="flex-grow: 1;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.35rem;">
              <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--purple-950); margin: 0;">Pengajuan Judul & Proposal Skripsi</h4>
              <span style="font-size: 0.78rem; font-weight: 600; color: var(--purple-800); background: var(--purple-50); padding: 0.2rem 0.6rem; border-radius: var(--radius-sm); border: 1px solid var(--purple-200);">Syarat: Menempuh Min. 110 SKS</span>
            </div>
            <p style="font-size: 0.88rem; color: var(--slate-600); line-height: 1.6; margin: 0;">
              Pengajuan topik penelitian bidang pengajaran bahasa (ELT), linguistik terapan, atau sastra ke Ketua Program Studi untuk penetapan Dosen Pembimbing I & II.
            </p>
          </div>
        </div>

        <div style="display: flex; gap: 1.25rem; align-items: flex-start; padding-bottom: 1.25rem; border-bottom: 1px solid var(--slate-200);">
          <div style="flex-shrink: 0; width: 42px; height: 42px; border-radius: 50%; background: var(--purple-100); color: var(--purple-900); font-weight: 800; display: flex; align-items: center; justify-content: center; font-size: 0.95rem;">
            2
          </div>
          <div style="flex-grow: 1;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.35rem;">
              <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--purple-950); margin: 0;">Seminar Proposal (Sempro)</h4>
              <span style="font-size: 0.78rem; font-weight: 600; color: var(--purple-800); background: var(--purple-50); padding: 0.2rem 0.6rem; border-radius: var(--radius-sm); border: 1px solid var(--purple-200);">Tahap Pengujian Instrumen</span>
            </div>
            <p style="font-size: 0.88rem; color: var(--slate-600); line-height: 1.6; margin: 0;">
              Presentasi desain dan kelayakan instrumen penelitian di hadapan tim penguji seminar proposal prodi sebelum pengambilan data ke lapangan.
            </p>
          </div>
        </div>

        <div style="display: flex; gap: 1.25rem; align-items: flex-start; padding-bottom: 1.25rem; border-bottom: 1px solid var(--slate-200);">
          <div style="flex-shrink: 0; width: 42px; height: 42px; border-radius: 50%; background: var(--purple-100); color: var(--purple-900); font-weight: 800; display: flex; align-items: center; justify-content: center; font-size: 0.95rem;">
            3
          </div>
          <div style="flex-grow: 1;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.35rem;">
              <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--purple-950); margin: 0;">Pengambilan Data Lapangan & Bimbingan Intensif</h4>
              <span style="font-size: 0.78rem; font-weight: 600; color: var(--purple-800); background: var(--purple-50); padding: 0.2rem 0.6rem; border-radius: var(--radius-sm); border: 1px solid var(--purple-200);">Terintegrasi PPL / PLP Sekolah</span>
            </div>
            <p style="font-size: 0.88rem; color: var(--slate-600); line-height: 1.6; margin: 0;">
              Pelaksanaan pengumpulan data penelitian di lokasi sampel (sekolah mitra/instansi) dan penyusunan draf Bab IV dan V bersama pembimbing.
            </p>
          </div>
        </div>

        <div style="display: flex; gap: 1.25rem; align-items: flex-start;">
          <div style="flex-shrink: 0; width: 42px; height: 42px; border-radius: 50%; background: var(--purple-900); color: #FFFFFF; font-weight: 800; display: flex; align-items: center; justify-content: center; font-size: 0.95rem;">
            4
          </div>
          <div style="flex-grow: 1;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.35rem;">
              <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--purple-950); margin: 0;">Sidang Munaqasyah (Ujian Skripsi Utama)</h4>
              <span style="font-size: 0.78rem; font-weight: 600; color: var(--emerald-700); background: #ECFDF5; padding: 0.2rem 0.6rem; border-radius: var(--radius-sm); border: 1px solid #A7F3D0;">Gelar S.Pd.</span>
            </div>
            <p style="font-size: 0.88rem; color: var(--slate-600); line-height: 1.6; margin: 0;">
              Ujian pertanggungjawaban karya ilmiah di hadapan dewan penguji skripsi untuk kelulusan dan pemenuhan syarat Gelar Sarjana Pendidikan.
            </p>
          </div>
        </div>

      </div>
    </div>

  </section>
</main>

<script>
function selectSemester(semNum, btnElement) {
  document.querySelectorAll('.semester-table-wrapper').forEach(tbl => {
    tbl.style.display = 'none';
  });
  document.querySelectorAll('.sem-btn').forEach(btn => {
    btn.style.background = 'transparent';
    btn.style.color = 'var(--slate-700)';
  });
  
  const targetTbl = document.getElementById('sem-table-' + semNum);
  if (targetTbl) targetTbl.style.display = 'block';
  if (btnElement) {
    btnElement.style.background = 'var(--purple-900)';
    btnElement.style.color = '#FFFFFF';
  }
}
</script>

<?php include 'components/footer.php'; ?>