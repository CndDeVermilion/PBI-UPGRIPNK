  <div id="search-modal" class="modal-overlay" onclick="closeSearchModal()">
    <div class="modal-card" onclick="event.stopPropagation()">
      <div class="search-header">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8" />
          <path d="m21 21-4.3-4.3" />
        </svg>
        <input type="text" id="global-search-input" class="search-input"
          placeholder="Cari dosen, mata kuliah TEFL/Linguistik, lab microteaching, atau riset..."
          onkeyup="handleGlobalSearch()">
        <button onclick="closeSearchModal()" style="font-size: 1.1rem; color: var(--slate-500);">✕</button>
      </div>
      <div id="search-results-container" style="max-height: 55vh; overflow-y: auto; padding: 1.1rem;">
        <p class="text-center" style="color: var(--slate-500); font-size: 0.9rem;">Ketik kata kunci untuk mulai mencari
          di portal PBI UPGRI Pontianak.</p>
      </div>
    </div>
  </div>

  <div id="accreditation-modal" class="modal-overlay" onclick="closeAccreditationModal()">
    <div class="modal-card" style="max-width: 580px; padding: 2rem; text-align: center;"
      onclick="event.stopPropagation()">
      <h2 style="margin-bottom: 0.5rem; color: var(--amber-700);">Sertifikat Akreditasi Digital</h2>
      <p style="color: var(--slate-600); font-size: 0.9rem; margin-bottom: 1.25rem;" id="modal-accreditation-details">
      </p>
      <div
        style="background: var(--slate-100); padding: 1.25rem; border-radius: var(--radius-md); border: 1px dashed var(--amber-600); margin-bottom: 1.5rem;">
        <h4 style="color: var(--purple-950); font-size: 0.95rem;">SALINAN RESMI DIGITAL LAMDIK</h4>
        <p style="font-size: 0.82rem; color: var(--slate-500); margin-top: 0.35rem;">Nomor SK:
          742/SK/LAMDIK/Ak/S/VIII/2024</p>
      </div>
      <div style="display: flex; gap: 0.85rem; justify-content: center;">
        <button class="btn btn-amber" onclick="closeAccreditationModal()">Tutup Informasi</button>
      </div>
    </div>
  </div>

  <div id="qa-modal" class="modal-overlay" onclick="closeQualityModal()">
    <div class="modal-card" style="max-width: 620px; padding: 2.25rem; text-align: left;"
      onclick="event.stopPropagation()">
      <span class="badge badge-purple" style="margin-bottom: 0.5rem;">PENJAMINAN MUTU INTERNAL</span>
      <h2 style="margin-bottom: 0.5rem; color: var(--purple-950);" id="qa-modal-title">Gugus Penjaminan Mutu Internal
        (GPMI)</h2>
      <p style="color: var(--slate-600); font-size: 0.9rem; margin-bottom: 1.25rem;" id="qa-modal-standar"></p>

      <div
        style="background: var(--purple-50); padding: 1.25rem; border-radius: var(--radius-md); border-left: 4px solid var(--purple-700); margin-bottom: 1.5rem;">
        <h4 style="color: var(--purple-950); font-size: 0.95rem; margin-bottom: 0.35rem;">Siklus Penjaminan Mutu (PPEPP)
        </h4>
        <p style="font-size: 0.85rem; color: var(--slate-700);" id="qa-modal-tugas"></p>
      </div>

      <div style="display: flex; gap: 0.85rem; justify-content: flex-end;">
        <button class="btn btn-purple" onclick="closeQualityModal()">Tutup Window</button>
      </div>
    </div>
  </div>

  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="brand-logo" style="color: white;">
            <img src="img/Logo_UPGRI.png" alt="Logo Universitas PGRI Pontianak">
            <div class="brand-text">
              <span class="brand-title" style="color: white;">Pendidikan Bahasa Inggris</span>
              <span class="brand-univ" style="color: var(--purple-200);">Universitas PGRI Pontianak</span>
            </div>
          </div>
          <p>Mencetak Pendidik Bahasa Inggris yang Profesional, Inovatif, Berkarakter, dan Berdaya Saing Global di
            Kalimantan Barat.</p>
        </div>

        <div class="footer-col">
          <h4>Navigasi Portal</h4>
          <ul class="footer-links">
            <li><a href="profil.php">Profil & Sejarah</a></li>
            <li><a href="akademik.php">Struktur Kurikulum SKS</a></li>
            <li><a href="fasilitas.php">Microteaching & Lab Bahasa</a></li>
            <li><a href="mahasiswa.php">HIMA & Prestasi</a></li>
            <li><a href="informasi.php">Informasi & Warta Prodi</a></li>
            <li><a href="https://spmb.upgripnk.ac.id/" target="_blank">Pendaftaran PMB</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Sistem Informasi Kampus</h4>
          <ul class="footer-links">
            <li><a href="https://siakad.upgripnk.ac.id" target="_blank">SIAKAD Online</a></li>
            <li><a href="akademik.php">Kurikulum & E-Learning</a></li>
            <li><a href="fasilitas.php#lab-bahasa">Laboratorium Bahasa CALL</a></li>
            <li><a href="https://journal.upgripnk.ac.id/" target="_blank">Jurnal Ilmiah (JELTL)</a></li>
            <li><a href="admin/login.php">Panel Admin</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Sekretariat PBI</h4>
          <p style="font-size: 0.85rem; color: var(--purple-200);" id="footer-alamat"></p>
        </div>
      </div>

      <div class="footer-bottom">
        <div>© 2026 Program Studi S1 Pendidikan Bahasa Inggris - Universitas PGRI Pontianak. All rights reserved.</div>
        <div style="display: flex; gap: 1.25rem; align-items: center;">
          <a href="javascript:void(0)" onclick="openAccreditationModal()" style="color: var(--purple-200);">Akreditasi LAMDIK</a>
          <button class="lang-switch-btn" onclick="toggleLanguage()" title="Switch Language / Ganti Bahasa">
            <span class="lang-opt" id="footer-lang-btn-en">EN</span>
            <span class="lang-opt active" id="footer-lang-btn-id">ID</span>
          </button>
        </div>
      </div>
    </div>
  </footer>

  <script src="js/data.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
