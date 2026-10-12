<?php
http_response_code(404);
$title = "404 Halaman Tidak Ditemukan | English Edu UPGRI Pontianak";
$meta_description = "Halaman yang Anda cari tidak ditemukan pada Portal Resmi S1 Pendidikan Bahasa Inggris UPGRI Pontianak.";
$page = "404";
include 'components/header.php';
?>

  <main id="main-content">
    <section class="section container" style="min-height: calc(100vh - 300px); display: flex; align-items: center; padding: 4.5rem 1.5rem;">
      <div class="grid-2" style="align-items: center; gap: 3.5rem; width: 100%;">
        
        <div>
          <span class="badge badge-purple" style="margin-bottom: 1rem; font-size: 0.85rem;">ERROR CODE 404</span>
          <h1 style="font-size: 4.5rem; font-weight: 800; color: var(--purple-950); line-height: 1; margin-bottom: 0.4rem; letter-spacing: -0.03em;">
            404
          </h1>
          <h2 style="font-size: 1.8rem; color: var(--purple-900); margin-bottom: 1rem;" data-i18n="title_404">
            Halaman Tidak Ditemukan
          </h2>
          <p style="font-size: 1.05rem; color: var(--slate-600); line-height: 1.65; margin-bottom: 2rem; max-width: 500px;" data-i18n="desc_404">
            Maaf, halaman yang Anda cari tidak dapat ditemukan, alamat URL salah, atau telah dipindahkan.
          </p>
          
          <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center; margin-bottom: 2rem;">
            <a href="index.php" class="btn btn-purple btn-lg" data-i18n="btn_home_404">
              Kembali ke Beranda
            </a>  
          </div>

          <div style="border-top: 1px solid var(--border-color); padding-top: 1.25rem;">
            <p style="font-size: 0.85rem; font-weight: 600; color: var(--slate-700); margin-bottom: 0.5rem;">Tautan Populer Portal:</p>
            <div style="display: flex; gap: 0.85rem; flex-wrap: wrap; font-size: 0.85rem;">
              <a href="profil.php">Profil Prodi</a> •
              <a href="akademik.php">Kurikulum SKS</a> •
              <a href="staff.php">Direktori Dosen</a> •
              <a href="informasi.php#berita">Warta Berita</a>
            </div>
          </div>
        </div>

        <div style="text-align: center;">
          <div style="background: var(--purple-50); border: 1px solid var(--purple-200); border-radius: var(--radius-lg); padding: 3rem 2rem; display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <img src="img/Logo_UPGRI.png" alt="Logo Universitas PGRI Pontianak" style="width: 80px; height: auto; margin-bottom: 1.25rem;">
            <h3 style="font-size: 1.15rem; color: var(--purple-950); margin-bottom: 0.5rem; font-weight: 700;">Sekretariat PBI UPGRI Pontianak</h3>
            <p style="font-size: 0.88rem; color: var(--slate-600); line-height: 1.6; max-width: 340px; margin-bottom: 1.25rem;">
              Butuh bantuan menemukan informasi kurikulum, berkas akademik, atau pendaftaran PMB? Hubungi meja layanan sekretariat kami.
            </p>
            <a href="informasi.php#kontak" class="btn btn-outline btn-sm">Hubungi Meja Layanan</a>
          </div>
        </div>

      </div>
    </section>
  </main>

<?php include 'components/footer.php'; ?>
