<?php
$title = "Profil & Sejarah | S1 Pendidikan Bahasa Inggris UPGRI Pontianak";
$meta_description = "Profil, Sejarah Pendirian (SK 1390/D/T/2009), Visi Misi, Pimpinan, dan Direktori Dosen Program Studi S1 Pendidikan Bahasa Inggris UPGRI Pontianak.";
$page = "profil";

require_once __DIR__ . '/api/db.php';

$dosenStmt = $pdo->query("SELECT dosen_id as id, nama, nip, jabatan, bidang_keahlian as bidangKeahlian, email, foto, pendidikan FROM dosen ORDER BY id ASC");
$dosenProfilList = $dosenStmt->fetchAll();

include 'components/header.php';
?>

<main id="main-content">
  <section class="section container">
    
    <div class="text-center section-header" id="profil-header">
      <h1 class="section-title" style="font-size: 2.2rem;">Profil, Sejarah & Visi Misi</h1>
      <p class="section-subtitle">Arah strategis pengembangan prodi dan kepemimpinan akademik di Fakultas Pendidikan Bahasa dan Seni (FPBS) UPGRI Pontianak.</p>
    </div>

    <div class="card" style="margin-bottom: 3.5rem; padding: 2rem;" id="sejarah-prodi">
      <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem; color: var(--purple-950);">Sejarah Program Studi</h2>
      <div style="font-size: 0.96rem; color: var(--slate-700); line-height: 1.75;">
        <p style="margin-bottom: 1rem;">
          Program Studi Pendidikan Bahasa Inggris Universitas PGRI Pontianak merupakan salah satu dari sebelas program studi di lingkungan Universitas PGRI Pontianak. Program studi ini didirikan pada tanggal 18 Agustus 2009 berdasarkan SK Pendirian Program Studi No. 1390/D/T/2009 yang ditandatangani oleh Menteri Pendidikan Nasional.
        </p>
        <p style="margin-bottom: 1rem;">
          Pendirian Program Studi Pendidikan Bahasa Inggris merupakan wujud komitmen Universitas PGRI Pontianak dalam mendukung kemajuan pendidikan di Kalimantan Barat, sejalan dengan dinamika pembangunan nasional serta perubahan kebutuhan masyarakat.
        </p>
        <p style="margin-bottom: 1rem;">
          Komitmen tersebut tercermin dalam visi dan misi program studi yang berorientasi pada pembangunan dan pemberdayaan masyarakat, khususnya di wilayah Kalimantan Barat.
        </p>
        <p style="margin-bottom: 1rem;">
          Dalam perjalanannya, mahasiswa selalu menjadi elemen penting yang mendorong proses pengembangan program studi. Sebagai program studi yang terus diminati, Pendidikan Bahasa Inggris Universitas PGRI Pontianak secara berkelanjutan melakukan peningkatan mutu lulusan melalui penyempurnaan kurikulum yang mengacu pada Kerangka Kualifikasi Nasional Indonesia (KKNI).
        </p>
        <p>
          Penyesuaian kurikulum tersebut dilakukan untuk memenuhi ketentuan Permendikbud No. 49 Tahun 2014 tentang Standar Nasional Pendidikan Tinggi, sehingga lulusan memiliki kompetensi akademik, profesional, serta kemampuan adaptasi terhadap perkembangan dunia pendidikan dan kebutuhan masyarakat.
        </p>
      </div>
    </div>

    <div id="profil-visi" style="margin-bottom: 3.5rem;">
      <div class="card" style="background: var(--purple-50); border: 1px solid var(--purple-100); padding: 2rem; margin-bottom: 2rem;">
        <h2 style="font-size: 1.4rem; color: var(--purple-950); margin-bottom: 0.75rem;">Visi Program Studi</h2>
        <p style="font-size: 1.05rem; color: var(--slate-800); line-height: 1.7; font-weight: 500;">
          Mengembangkan keilmuan Pendidikan Bahasa Inggris untuk menghasilkan lulusan berkarakter, inovatif, adaptif, berbasis kearifan lokal ekuator dan teknologi, serta berwawasan global pada tahun 2045.
        </p>
      </div>

      <div class="grid-2" style="margin-bottom: 2.5rem;">
        <div class="card" style="padding: 1.75rem;">
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <div style="width: 36px; height: 36px; border-radius: 8px; background: var(--purple-100); color: var(--purple-900); display: flex; align-items: center; justify-content: center; font-weight: 700;">M</div>
            <h3 style="font-size: 1.25rem; color: var(--purple-950); margin: 0;">Misi Program Studi</h3>
          </div>
          <ul style="padding-left: 1.25rem; font-size: 0.92rem; color: var(--slate-700); line-height: 1.7;">
            <li style="margin-bottom: 0.5rem;">Menyelenggarakan pendidikan berorientasi pada keunggulan dan inovasi.</li>
            <li style="margin-bottom: 0.5rem;">Mengembangkan penelitian multidisiplin yang berkualitas tinggi.</li>
            <li style="margin-bottom: 0.5rem;">Melaksanakan pengabdian kepada masyarakat berbasis ilmu pengetahuan.</li>
            <li style="margin-bottom: 0.5rem;">Membangun kemitraan strategis lokal, nasional, dan internasional.</li>
            <li style="margin-bottom: 0.5rem;">Mengoptimalkan penggunaan teknologi informasi.</li>
            <li style="margin-bottom: 0.5rem;">Menyelenggarakan tata kelola fakultas yang kredibel dan transparan.</li>
          </ul>
        </div>

        <div class="card" style="padding: 1.75rem;">
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <div style="width: 36px; height: 36px; border-radius: 8px; background: var(--purple-100); color: var(--purple-700); display: flex; align-items: center; justify-content: center; font-weight: 700;">T</div>
            <h3 style="font-size: 1.25rem; color: var(--purple-950); margin: 0;">Tujuan Program Studi</h3>
          </div>
          <ul style="padding-left: 1.25rem; font-size: 0.92rem; color: var(--slate-700); line-height: 1.7;">
            <li style="margin-bottom: 0.5rem;">Menghasilkan lulusan sebagai <strong>English Educator</strong>, <strong>English Researcher</strong>, <strong>Language Practitioner</strong>, dan <strong>Edutechnopreneur</strong>.</li>
            <li style="margin-bottom: 0.5rem;">Mengembangkan penelitian multidisiplin berkualitas tinggi.</li>
            <li style="margin-bottom: 0.5rem;">Menyelenggarakan pengabdian kepada masyarakat berbasis ilmu pengetahuan.</li>
            <li style="margin-bottom: 0.5rem;">Membangun kemitraan strategis dan kolaboratif.</li>
            <li style="margin-bottom: 0.5rem;">Mengoptimalkan pemanfaatan teknologi informasi.</li>
            <li style="margin-bottom: 0.5rem;">Mewujudkan tata kelola fakultas yang kredibel dan akuntabel.</li>
          </ul>
        </div>
      </div>

      <div style="margin-top: 3rem;">
        <div style="margin-bottom: 1.5rem;">
          <h2 style="font-size: 1.4rem; color: var(--purple-950); margin-bottom: 0.35rem;">Strategi Pencapaian</h2>
          <p style="font-size: 0.9rem; color: var(--slate-600);">Pilar-pilar strategi dalam mewujudkan Visi 2045 dan Misi Program Studi Pendidikan Bahasa Inggris.</p>
        </div>

        <div class="grid-3">
          <div class="card">
            <h3 style="font-size: 1rem; color: var(--purple-900); margin-bottom: 0.75rem; border-bottom: 2px solid var(--purple-100); padding-bottom: 0.5rem;">Strategi Pendidikan & Pembelajaran</h3>
            <ul style="padding-left: 1rem; font-size: 0.85rem; color: var(--slate-700); line-height: 1.6;">
              <li style="margin-bottom: 0.35rem;">Kurikulum berbasis OBE dan MBKM</li>
              <li style="margin-bottom: 0.35rem;">Pembelajaran inovatif berbasis proyek</li>
              <li style="margin-bottom: 0.35rem;">Peningkatan kompetensi dosen</li>
              <li style="margin-bottom: 0.35rem;">Penguatan penjaminan mutu akademik</li>
            </ul>
          </div>

          <div class="card">
            <h3 style="font-size: 1rem; color: var(--purple-900); margin-bottom: 0.75rem; border-bottom: 2px solid var(--purple-100); padding-bottom: 0.5rem;">Strategi Penelitian</h3>
            <ul style="padding-left: 1rem; font-size: 0.85rem; color: var(--slate-700); line-height: 1.6;">
              <li style="margin-bottom: 0.35rem;">Penelitian multidisiplin berbasis kearifan lokal</li>
              <li style="margin-bottom: 0.35rem;">Peningkatan publikasi ilmiah</li>
              <li style="margin-bottom: 0.35rem;">Pengembangan ilmu pengetahuan</li>
            </ul>
          </div>

          <div class="card">
            <h3 style="font-size: 1rem; color: var(--purple-900); margin-bottom: 0.75rem; border-bottom: 2px solid var(--purple-100); padding-bottom: 0.5rem;">Strategi Pengabdian (PkM)</h3>
            <ul style="padding-left: 1rem; font-size: 0.85rem; color: var(--slate-700); line-height: 1.6;">
              <li style="margin-bottom: 0.35rem;">Pengabdian berbasis hasil penelitian</li>
              <li style="margin-bottom: 0.35rem;">Program berbasis kearifan lokal</li>
              <li style="margin-bottom: 0.35rem;">Kerja sama dengan pemerintah daerah</li>
            </ul>
          </div>

          <div class="card">
            <h3 style="font-size: 1rem; color: var(--purple-900); margin-bottom: 0.75rem; border-bottom: 2px solid var(--purple-100); padding-bottom: 0.5rem;">Strategi Kemitraan</h3>
            <ul style="padding-left: 1rem; font-size: 0.85rem; color: var(--slate-700); line-height: 1.6;">
              <li style="margin-bottom: 0.35rem;">Kemitraan lokal, nasional, internasional</li>
              <li style="margin-bottom: 0.35rem;">Joint research dan guest lecture</li>
              <li style="margin-bottom: 0.35rem;">Mobilitas dosen dan mahasiswa</li>
            </ul>
          </div>

          <div class="card">
            <h3 style="font-size: 1rem; color: var(--purple-900); margin-bottom: 0.75rem; border-bottom: 2px solid var(--purple-100); padding-bottom: 0.5rem;">Strategi Teknologi Informasi</h3>
            <ul style="padding-left: 1rem; font-size: 0.85rem; color: var(--slate-700); line-height: 1.6;">
              <li style="margin-bottom: 0.35rem;">Manajemen akademik digital</li>
              <li style="margin-bottom: 0.35rem;">Infrastruktur pembelajaran digital</li>
              <li style="margin-bottom: 0.35rem;">Literasi digital civitas akademika</li>
            </ul>
          </div>

          <div class="card">
            <h3 style="font-size: 1rem; color: var(--purple-900); margin-bottom: 0.75rem; border-bottom: 2px solid var(--purple-100); padding-bottom: 0.5rem;">Strategi Tata Kelola</h3>
            <ul style="padding-left: 1rem; font-size: 0.85rem; color: var(--slate-700); line-height: 1.6;">
              <li style="margin-bottom: 0.35rem;">Tata kelola fakultas transparan</li>
              <li style="margin-bottom: 0.35rem;">Implementasi SPMI</li>
              <li style="margin-bottom: 0.35rem;">Peningkatan kapasitas pimpinan</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="card" style="background: var(--amber-100); border: 1px solid #FDE68A; padding: 2.25rem; margin-bottom: 3.5rem;">
      <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
          <span class="badge badge-unggul" style="margin-bottom: 0.4rem;">STATUS AKREDITASI</span>
          <h2 style="font-size: 1.5rem; color: var(--amber-700); margin-bottom: 0.35rem;">Terakreditasi BAIK SEKALI (LAMDIK)</h2>
          <p style="color: var(--slate-700); font-size: 0.9rem;">
            SK No. 742/SK/LAMDIK/Ak/S/VIII/2024 (Berlaku hingga 20 Agustus 2029) | Lembaga Akreditasi Mandiri Kependidikan (LAMDIK)
          </p>
        </div>
        <button class="btn btn-amber btn-lg" onclick="openAccreditationModal()">Salinan Digital Sertifikat (PDF)</button>
      </div>
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

    <div style="margin-top: 4.5rem;" id="dosen-section">
      <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
          <h2 class="section-title">Direktori Dosen & Pengajar PBI</h2>
          <p style="font-size: 0.9rem; color: var(--slate-600); margin-top: 0.2rem;">Tenaga pendidik profesional spesialis TEFL, Linguistik Terapan, dan Sastra.</p>
        </div>
        <input type="text" id="dosen-search-input" placeholder="Cari nama dosen / kepakaran..." class="card"
          style="padding: 0.55rem 1.1rem; font-size: 0.9rem; width: 300px; outline: none;" onkeyup="filterDosenGridProfil(this.value)">
      </div>
      
      <div class="grid-3" id="profil-dosen-grid">
        <?php foreach ($dosenProfilList as $d): ?>
          <article class="card dosen-card-profil-item" data-nama="<?php echo strtolower(htmlspecialchars($d['nama'])); ?>" data-keahlian="<?php echo strtolower(htmlspecialchars($d['bidangKeahlian'])); ?>" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
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

            <div style="border-top: 1px solid var(--purple-100); padding-top: 0.75rem; font-size: 0.8rem; color: var(--slate-600); display: flex; justify-content: space-between; align-items: center;">
              <span>Email: <?php echo htmlspecialchars($d['email']); ?></span>
              <span class="badge badge-slate" style="font-size: 0.7rem;">FPBS UPGRI</span>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>

  </section>
</main>

<script>
function filterDosenGridProfil(query) {
  const q = query.toLowerCase().trim();
  document.querySelectorAll('.dosen-card-profil-item').forEach(card => {
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