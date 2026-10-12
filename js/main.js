// Logika Manipulasi DOM Portal Resmi S1 Pendidikan Bahasa Inggris - Universitas PGRI Pontianak

document.addEventListener("DOMContentLoaded", () => {
  // Automatic JS DOM overwriting disabled so content renders directly from PHP/HTML files
  // renderHomepage();
  // renderProfil();
  // renderAkademik();
  // renderFasilitas();
  // renderKemahasiswaan();
  // renderPenelitian();
  // renderKontak();

  // Smooth scroll hash fragment handling on page load
  if (window.location.hash) {
    const hash = window.location.hash.substring(1);
    setTimeout(() => {
      const targetEl = document.getElementById(hash);
      if (targetEl) {
        targetEl.scrollIntoView({ behavior: 'smooth' });
      }
    }, 150);
  }
});

// Helper scroll to sub-section
function scrollToSection(sectionId) {
  setTimeout(() => {
    const el = document.getElementById(sectionId);
    if (el) {
      el.scrollIntoView({ behavior: 'smooth' });
    }
  }, 100);
}

// 1. Render Homepage (Modul 1)
function renderHomepage() {
  const keunggulanContainer = document.getElementById('home-keunggulan-list');
  if (keunggulanContainer) {
    keunggulanContainer.innerHTML = prodiInfo.keunggulan.map(k => `
      <div class="card">
        <h3 style="font-size: 1.05rem; margin-bottom: 0.4rem; color: var(--purple-950);">${k.title}</h3>
        <p style="font-size: 0.85rem; color: var(--slate-600); font-weight: 400; line-height: 1.55;">${k.desc}</p>
      </div>
    `).join('');
  }

  const beritaContainer = document.getElementById('home-berita-list');
  if (beritaContainer) {
    beritaContainer.innerHTML = beritaList.map(b => `
      <div class="card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
        <img src="${b.gambar}" alt="${b.judul}" style="height: 175px; width: 100%; object-fit: cover;">
        <div style="padding: 1.25rem; flex-grow: 1; display: flex; flex-direction: column;">
          <div style="display: flex; gap: 0.5rem; margin-bottom: 0.4rem; align-items: center;">
            <span class="badge badge-purple">${b.kategori}</span>
            <span style="font-size: 0.76rem; color: var(--slate-500);">${b.tanggal}</span>
          </div>
          <h3 style="font-size: 1rem; margin-bottom: 0.4rem; line-height: 1.35; color: var(--purple-950);">
            <a href="berita-detail.php?id=${b.id}" style="color: inherit; text-decoration: none;">${b.judul}</a>
          </h3>
          <p style="font-size: 0.84rem; color: var(--slate-600); flex-grow: 1; margin-bottom: 1rem;">${b.ringkasan}</p>
          <a href="berita-detail.php?id=${b.id}" class="btn btn-outline btn-sm" style="text-align: center; text-decoration: none;">Baca Selengkapnya</a>
        </div>
      </div>
    `).join('');
  }

  const testimoniContainer = document.getElementById('home-testimoni-list');
  if (testimoniContainer) {
    testimoniContainer.innerHTML = testimoniAlumni.map(t => `
      <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
        <p style="font-size: 0.9rem; color: var(--slate-700); margin-bottom: 1.1rem; line-height: 1.6;">"${t.kutipan}"</p>
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <img src="${t.foto}" alt="${t.nama}" style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid var(--purple-200);">
          <div>
            <div style="font-weight: 700; font-size: 0.9rem; color: var(--purple-950);">${t.nama}</div>
            <div style="font-size: 0.76rem; color: var(--purple-700); font-weight: 600;">${t.peran} (${t.angkatan})</div>
          </div>
        </div>
      </div>
    `).join('');
  }
}

// 2. Render Profil & Dosen (Modul 2 - Modular Section Functions)
function renderProfil() {
  renderProfilSejarah();
  renderProfilVisiMisi();
  renderProfilPimpinan();
  renderProfilAkreditasi();
  renderProfilDosen();
}

// Section 1: Sejarah Program Studi
function renderProfilSejarah(targetId = 'sejarah-prodi-text') {
  const sejarahElem = document.getElementById(targetId);
  if (sejarahElem) {
    sejarahElem.innerHTML = prodiInfo.sejarah
      .split('\n\n')
      .map(paragraph => `<p style="margin-bottom: 1rem;">${paragraph}</p>`)
      .join('');
  }
}

// Section 2: Visi, Misi, Tujuan & Strategi Program Studi
function renderProfilVisiMisi(visiId = 'profil-visi-text', misiId = 'profil-misi-list', tujuanId = 'profil-tujuan-list', strategiId = 'profil-strategi-grid') {
  const visiElem = document.getElementById(visiId);
  if (visiElem) visiElem.innerText = prodiInfo.visi;

  const misiElem = document.getElementById(misiId);
  if (misiElem) {
    misiElem.innerHTML = prodiInfo.misi
      .map(m => `<li style="margin-bottom: 0.5rem;">${m}</li>`)
      .join('');
  }

  const tujuanElem = document.getElementById(tujuanId);
  if (tujuanElem) {
    tujuanElem.innerHTML = prodiInfo.tujuan
      .map(t => `<li style="margin-bottom: 0.5rem;">${t}</li>`)
      .join('');
  }

  const strategiElem = document.getElementById(strategiId);
  if (strategiElem && prodiInfo.strategi) {
    strategiElem.innerHTML = prodiInfo.strategi
      .map(s => `
        <div class="card">
          <h4 style="font-size: 1rem; color: var(--purple-900); margin-bottom: 0.75rem; border-bottom: 2px solid var(--purple-100); padding-bottom: 0.5rem;">${s.kategori}</h4>
          <ul style="padding-left: 1rem; font-size: 0.85rem; color: var(--slate-700); line-height: 1.6;">
            ${s.item.map(item => `<li style="margin-bottom: 0.35rem;">${item}</li>`).join('')}
          </ul>
        </div>
      `)
      .join('');
  }
}

// Section 3: Pimpinan Program Studi
function renderProfilPimpinan(targetId = 'profil-pimpinan-list') {
  const pimpinanContainer = document.getElementById(targetId);
  if (pimpinanContainer) {
    pimpinanContainer.innerHTML = prodiInfo.strukturOrganisasi
      .map(p => `
      <div class="card dosen-card">
        <img src="${p.foto}" alt="${p.nama}" class="dosen-avatar">
        <div class="dosen-role">${p.jabatan}</div>
        <h4 class="dosen-name">${p.nama}</h4>
        <div style="font-size: 0.8rem; color: var(--slate-500); margin-top: 0.2rem;">${p.email}</div>
      </div>
    `)
      .join('');
  }
}

// Section 4: Status Akreditasi Program Studi
function renderProfilAkreditasi(targetId = 'akreditasi-sk-info') {
  const akredElem = document.getElementById(targetId);
  if (akredElem) {
    akredElem.innerText = `${prodiInfo.akreditasi.nomorSK} • Berlaku s/d ${prodiInfo.akreditasi.berlakuHingga}`;
  }
}

// Section 5: Direktori Dosen & Staff Pengajar
function renderProfilDosen(list = dosenList, targetId = 'profil-dosen-grid') {
  renderDosenGrid(list, targetId);
}

// Standalone Section Component Renderers (Untuk memanggil & merender satu section utuh ke container tertentu)
function renderSejarahSection(containerId) {
  const container = document.getElementById(containerId);
  if (!container) return;
  container.innerHTML = `
    <div class="card" style="margin-bottom: 3.5rem; border-left: 5px solid var(--purple-900);" id="sejarah-prodi">
      <h2 style="font-size: 1.5rem; margin-bottom: 1rem; color: var(--purple-950);">Sejarah Program Studi</h2>
      <div style="font-size: 0.95rem; color: var(--slate-700); line-height: 1.75;">
        ${prodiInfo.sejarah.split('\n\n').map(p => `<p style="margin-bottom: 1rem;">${p}</p>`).join('')}
      </div>
    </div>
  `;
}

function renderVisiMisiSection(containerId) {
  const container = document.getElementById(containerId);
  if (!container) return;
  container.innerHTML = `
    <div id="profil-visi" style="margin-bottom: 3.5rem;">
      <div class="card" style="border-left: 6px solid var(--purple-900); background: linear-gradient(135deg, rgba(88, 28, 135, 0.03) 0%, rgba(59, 7, 100, 0.08) 100%); padding: 2rem; margin-bottom: 2rem;">
        <span class="badge badge-purple" style="margin-bottom: 0.5rem;">VISI PRODI 2045</span>
        <h3 style="font-size: 1.4rem; color: var(--purple-950); margin-bottom: 0.75rem;">Visi Program Studi</h3>
        <p style="font-size: 1.05rem; color: var(--slate-800); line-height: 1.7; font-weight: 500;">${prodiInfo.visi}</p>
      </div>

      <div class="grid-2" style="margin-bottom: 2.5rem;">
        <div class="card" style="border-top: 4px solid var(--purple-800);">
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <div style="width: 36px; height: 36px; border-radius: 8px; background: var(--purple-100); color: var(--purple-900); display: flex; align-items: center; justify-content: center; font-weight: 700;">M</div>
            <h3 style="font-size: 1.25rem; color: var(--purple-950); margin: 0;">Misi Program Studi</h3>
          </div>
          <ul style="padding-left: 1.25rem; font-size: 0.92rem; color: var(--slate-700); line-height: 1.7;">
            ${prodiInfo.misi.map(m => `<li style="margin-bottom: 0.5rem;">${m}</li>`).join('')}
          </ul>
        </div>

        <div class="card" style="border-top: 4px solid var(--purple-600);">
          <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <div style="width: 36px; height: 36px; border-radius: 8px; background: var(--purple-100); color: var(--purple-700); display: flex; align-items: center; justify-content: center; font-weight: 700;">T</div>
            <h3 style="font-size: 1.25rem; color: var(--purple-950); margin: 0;">Tujuan Program Studi</h3>
          </div>
          <ul style="padding-left: 1.25rem; font-size: 0.92rem; color: var(--slate-700); line-height: 1.7;">
            ${prodiInfo.tujuan.map(t => `<li style="margin-bottom: 0.5rem;">${t}</li>`).join('')}
          </ul>
        </div>
      </div>

      <div style="margin-top: 3rem;">
        <div style="margin-bottom: 1.5rem;">
          <span class="badge badge-purple">PIJAKAN STRATEGIS</span>
          <h3 style="font-size: 1.4rem; color: var(--purple-950); margin-top: 0.35rem;">Strategi Pencapaian</h3>
        </div>
        <div class="grid-3">
          ${(prodiInfo.strategi || []).map(s => `
            <div class="card">
              <h4 style="font-size: 1rem; color: var(--purple-900); margin-bottom: 0.75rem; border-bottom: 2px solid var(--purple-100); padding-bottom: 0.5rem;">${s.kategori}</h4>
              <ul style="padding-left: 1rem; font-size: 0.85rem; color: var(--slate-700); line-height: 1.6;">
                ${s.item.map(item => `<li style="margin-bottom: 0.35rem;">${item}</li>`).join('')}
              </ul>
            </div>
          `).join('')}
        </div>
      </div>
    </div>
  `;
}

function renderPimpinanSection(containerId) {
  const container = document.getElementById(containerId);
  if (!container) return;
  container.innerHTML = `
    <div style="margin-bottom: 4rem;" id="profil-pimpinan">
      <h2 class="text-center section-title" style="font-size: 1.6rem; margin-bottom: 2rem;">Pimpinan Program Studi</h2>
      <div class="grid-3">
        ${prodiInfo.strukturOrganisasi.map(p => `
          <div class="card dosen-card">
            <img src="${p.foto}" alt="${p.nama}" class="dosen-avatar">
            <div class="dosen-role">${p.jabatan}</div>
            <h4 class="dosen-name">${p.nama}</h4>
            <div style="font-size: 0.8rem; color: var(--slate-500); margin-top: 0.2rem;">${p.email}</div>
          </div>
        `).join('')}
      </div>
    </div>
  `;
}

function renderAkreditasiSection(containerId) {
  const container = document.getElementById(containerId);
  if (!container) return;
  container.innerHTML = `
    <div class="card" style="background: var(--amber-100); border: 1px solid #FDE68A; padding: 2.25rem;">
      <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
          <span class="badge badge-unggul" style="margin-bottom: 0.4rem;">STATUS AKREDITASI</span>
          <h3 style="font-size: 1.5rem; color: var(--amber-700); margin-bottom: 0.35rem;">Terakreditasi BAIK SEKALI (LAMDIK)</h3>
          <p style="color: var(--slate-700); font-size: 0.9rem;">${prodiInfo.akreditasi.nomorSK} • Berlaku s/d ${prodiInfo.akreditasi.berlakuHingga}</p>
        </div>
        <button class="btn btn-amber btn-lg" onclick="openAccreditationModal()">Salinan Digital Sertifikat (PDF)</button>
      </div>
    </div>
  `;
}

function renderDosenGrid(list, targetId = 'profil-dosen-grid') {
  const container = document.getElementById(targetId);
  if (container) {
    if (list.length === 0) {
      container.innerHTML = `<p style="grid-column: 1/-1; text-align: center; color: var(--slate-500);">Tidak ada dosen yang sesuai dengan pencarian.</p>`;
      return;
    }
    container.innerHTML = list.map(d => `
      <div class="card dosen-card">
        <img src="${d.foto}" alt="${d.nama}" class="dosen-avatar">
        <h4 class="dosen-name">${d.nama}</h4>
        <div class="dosen-role">${d.jabatan}</div>
        <div class="dosen-expertise">Bidang Keahlian: ${d.bidangKeahlian}</div>
        <div style="margin-top: 0.4rem; display: flex; gap: 0.4rem; flex-wrap: wrap; justify-content: center;">
          <a href="#" onclick="alert('Profil SINTA ${d.nama}')" class="badge badge-purple" style="text-decoration:none;">SINTA ID</a>
          <a href="#" onclick="alert('Profil Google Scholar ${d.nama}')" class="badge badge-slate" style="text-decoration:none;">Google Scholar</a>
        </div>
      </div>
    `).join('');
  }
}

function filterDosen() {
  const input = document.getElementById('dosen-search-input');
  if (!input) return;
  const query = input.value.toLowerCase().trim();
  const filtered = dosenList.filter(d => 
    d.nama.toLowerCase().includes(query) || 
    d.bidangKeahlian.toLowerCase().includes(query)
  );
  renderDosenGrid(filtered);
}

// 3. Render Akademik & Kurikulum (Modul 3)
let currentSelectedSemester = 1;

function renderAkademik() {
  const tabsContainer = document.getElementById('semester-tabs-container');
  if (tabsContainer) {
    tabsContainer.innerHTML = kurikulumData.semesters.map(s => `
      <button 
        class="btn btn-sm ${s.semester === currentSelectedSemester ? 'btn-primary' : 'btn-outline'}" 
        onclick="switchSemesterTab(${s.semester})"
        id="sem-btn-${s.semester}"
      >
        Semester ${s.semester} (${s.totalSKS} SKS)
      </button>
    `).join('');
  }

  renderSemesterTable(currentSelectedSemester);

  const profilContainer = document.getElementById('profil-lulusan-list');
  if (profilContainer) {
    profilContainer.innerHTML = kurikulumData.profilLulusan.map(p => `
      <div class="card" style="border-top: 3px solid var(--purple-900);">
        <h4 style="font-size: 1.05rem; color: var(--purple-950); margin-bottom: 0.4rem;">${p.peran}</h4>
        <p style="font-size: 0.85rem; color: var(--slate-600); margin-bottom: 0.65rem;">${p.deskripsi}</p>
        <div style="font-size: 0.78rem; font-weight: 600; color: var(--purple-700);">Prospek Karir: ${p.karir}</div>
      </div>
    `).join('');
  }

  const skripsiContainer = document.getElementById('alur-skripsi-list');
  if (skripsiContainer) {
    skripsiContainer.innerHTML = kurikulumData.alurSkripsi.map(a => `
      <div style="text-align: center;">
        <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--purple-900); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; margin: 0 auto 0.6rem auto;">${a.langkah}</div>
        <h4 style="font-size: 0.9rem; margin-bottom: 0.2rem; color: var(--purple-950);">${a.judul}</h4>
        <p style="font-size: 0.78rem; color: var(--slate-600);">${a.desc}</p>
      </div>
    `).join('');
  }
}

function switchSemesterTab(semNum) {
  currentSelectedSemester = semNum;
  kurikulumData.semesters.forEach(s => {
    const btn = document.getElementById(`sem-btn-${s.semester}`);
    if (btn) {
      if (s.semester === semNum) {
        btn.className = "btn btn-sm btn-primary";
      } else {
        btn.className = "btn btn-sm btn-outline";
      }
    }
  });
  renderSemesterTable(semNum);
}

function renderSemesterTable(semNum) {
  const tbody = document.getElementById('kurikulum-table-body');
  const semData = kurikulumData.semesters.find(s => s.semester === semNum);
  if (tbody && semData) {
    tbody.innerHTML = semData.mk.map(m => `
      <tr>
        <td style="font-weight: 700; color: var(--purple-950);">${m.kode}</td>
        <td style="font-weight: 600; color: var(--slate-800);">${m.nama}</td>
        <td style="text-align: center;"><span class="badge badge-purple">${m.sks} SKS</span></td>
        <td><span class="badge ${m.sifat.includes('Wajib') ? 'badge-slate' : 'badge-unggul'}">${m.sifat}</span></td>
        <td style="color: var(--slate-600); font-size: 0.85rem;">${m.desc}</td>
      </tr>
    `).join('');
  }
}

// 4. Render Fasilitas & Lab (Modul 4)
function renderFasilitas() {
  const labContainer = document.getElementById('fasilitas-lab-list');
  if (labContainer) {
    labContainer.innerHTML = fasilitasData.laboratorium.map(l => `
      <div class="card" style="padding: 0; overflow: hidden; display: flex; flex-direction: column;">
        <img src="${l.gambar}" alt="${l.nama}" style="height: 190px; width: 100%; object-fit: cover;">
        <div style="padding: 1.35rem; flex-grow: 1;">
          <h4 style="font-size: 1.05rem; color: var(--purple-950); margin-bottom: 0.4rem;">${l.nama}</h4>
          <p style="font-size: 0.85rem; color: var(--slate-600); margin-bottom: 0.65rem;">${l.desc}</p>
          <div style="background: var(--purple-50); padding: 0.55rem 0.75rem; border-radius: var(--radius-sm); font-size: 0.78rem; color: var(--purple-950); font-family: monospace;">
            Spesifikasi: ${l.spesifikasi}
          </div>
        </div>
      </div>
    `).join('');
  }

  const tbody = document.getElementById('inventaris-table-body');
  if (tbody) {
    tbody.innerHTML = fasilitasData.inventaris.map(i => `
      <tr>
        <td style="font-weight: 600; color: var(--slate-800);">${i.nama}</td>
        <td><span class="badge badge-purple">${i.jumlah}</span></td>
        <td><span class="badge badge-slate">${i.kondisi}</span></td>
        <td style="color: var(--slate-600); font-size: 0.85rem;">${i.kegunaan}</td>
      </tr>
    `).join('');
  }
}

// 5. Render Kemahasiswaan & Prestasi (Modul 5)
function renderKemahasiswaan() {
  const prestasiContainer = document.getElementById('prestasi-mahasiswa-list');
  if (prestasiContainer) {
    const list = [
      { juara: "Juara I Nasional", lomba: "National English Debate Competition (EDC) 2026", tim: "Tim Debat EDSA PBI UPGRI Pontianak" },
      { juara: "Gold Medal & Best Presenter", lomba: "Borneo Youth Language & Cultural Studies Forum 2025", tim: "Nabila & Rian Saputra" },
      { juara: "Juara II National Storytelling Competition", lomba: "Pekan Seni & Bahasa Mahasiswa Kemendikbud 2025", tim: "Tim Storytelling PBI" }
    ];
    prestasiContainer.innerHTML = list.map(p => `
      <div class="card" style="border-top: 3px solid var(--amber-600);">
        <span class="badge badge-unggul" style="margin-bottom: 0.5rem;">${p.juara}</span>
        <h4 style="font-size: 0.98rem; margin-bottom: 0.25rem; color: var(--purple-950);">${p.lomba}</h4>
        <p style="font-size: 0.82rem; color: var(--slate-600);">Peraih: <strong>${p.tim}</strong></p>
      </div>
    `).join('');
  }
}

// 6. Render Penelitian & Mitra (Modul 6)
function renderPenelitian() {
  const grupContainer = document.getElementById('grup-riset-list');
  if (grupContainer) {
    grupContainer.innerHTML = risetData.grupRiset.map(g => `
      <div class="card" style="border-top: 3px solid var(--purple-600);">
        <h4 style="font-size: 1.05rem; color: var(--purple-950); margin-bottom: 0.25rem;">${g.nama}</h4>
        <div style="font-size: 0.8rem; font-weight: 600; color: var(--purple-700); margin-bottom: 0.4rem;">Ketua Riset: ${g.ketua}</div>
        <p style="font-size: 0.82rem; color: var(--slate-600);">${g.fokus}</p>
      </div>
    `).join('');
  }

  const jNama = document.getElementById('jurnal-nama');
  if (jNama) jNama.innerText = risetData.jurnal.nama;

  const jInfo = document.getElementById('jurnal-info');
  if (jInfo) jInfo.innerText = `${risetData.jurnal.akreditasi} • ${risetData.jurnal.issn}`;

  const mitraContainer = document.getElementById('mitra-grid-list');
  if (mitraContainer) {
    mitraContainer.innerHTML = risetData.mitra.map(m => `
      <div class="card text-center" style="padding: 1.25rem;">
        <h4 style="font-size: 0.95rem; color: var(--purple-950); margin-bottom: 0.2rem;">${m.nama}</h4>
        <span class="badge badge-purple" style="margin-bottom: 0.4rem;">${m.jenis}</span>
        <p style="font-size: 0.78rem; color: var(--slate-600);">${m.program}</p>
      </div>
    `).join('');
  }
}

// 7. Render Kontak & PMB (Modul 7)
function renderKontak() {
  const pmbContainer = document.getElementById('pmb-jalur-list');
  if (pmbContainer) {
    pmbContainer.innerHTML = prodiInfo.pmbInfo.jalurMasuk.map(j => `
      <div style="background: var(--purple-50); padding: 0.85rem 1rem; border-radius: var(--radius-sm); border-left: 3px solid var(--purple-900);">
        <h4 style="font-size: 0.95rem; color: var(--purple-950); margin-bottom: 0.2rem;">${j.nama}</h4>
        <p style="font-size: 0.82rem; color: var(--slate-600); margin-bottom: 0.3rem;">${j.deskripsi}</p>
        <span class="badge badge-unggul">${j.diskon}</span>
      </div>
    `).join('') + `
      <div style="margin-top: 1rem;">
        <a href="https://spmb.upgripnk.ac.id/" target="_blank" class="btn btn-purple btn-sm" style="width: 100%; text-align: center;">Daftar PMB Online (Portal SPMB UPGRI)</a>
      </div>
    `;
  }

  const biayaBody = document.getElementById('biaya-studi-table-body');
  if (biayaBody) {
    biayaBody.innerHTML = prodiInfo.pmbInfo.biayaStudi.map(b => `
      <tr>
        <td style="font-weight: 600; color: var(--slate-800);">${b.komponen}</td>
        <td style="text-align: right; font-weight: 700; color: var(--emerald-700);">${b.jumlah}</td>
      </tr>
    `).join('');
  }

  const alamatText = document.getElementById('kontak-alamat-text');
  if (alamatText) alamatText.innerText = prodiInfo.kontak.alamat;

  const footerAlamat = document.getElementById('footer-alamat');
  if (footerAlamat) footerAlamat.innerText = prodiInfo.kontak.alamat;

  const mapIframe = document.getElementById('google-maps-iframe');
  if (mapIframe) mapIframe.src = prodiInfo.kontak.googleMapsEmbed;
}

// Modal Handlers
function openSearchModal() {
  const modal = document.getElementById('search-modal');
  if (modal) {
    modal.classList.add('active');
    const input = document.getElementById('global-search-input');
    if (input) input.focus();
  }
}

function closeSearchModal() {
  const modal = document.getElementById('search-modal');
  if (modal) modal.classList.remove('active');
}

function handleGlobalSearch() {
  const input = document.getElementById('global-search-input');
  if (!input) return;
  const query = input.value.toLowerCase().trim();
  const container = document.getElementById('search-results-container');
  if (!container) return;

  if (!query) {
    container.innerHTML = `<p class="text-center" style="color: var(--slate-500); font-size: 0.9rem;">Ketik kata kunci untuk mulai mencari di portal PBI UPGRI Pontianak.</p>`;
    return;
  }

  const matchedDosen = dosenList.filter(d => d.nama.toLowerCase().includes(query) || d.bidangKeahlian.toLowerCase().includes(query));
  const matchedMK = kurikulumData.semesters.flatMap(s => s.mk).filter(m => m.nama.toLowerCase().includes(query) || m.kode.toLowerCase().includes(query));
  const matchedBerita = beritaList.filter(b => b.judul.toLowerCase().includes(query));

  let html = '';
  if (matchedDosen.length > 0) {
    html += `<h4 style="color: var(--purple-950); font-size: 0.9rem; margin-bottom: 0.4rem;">Dosen & Pengajar PBI (${matchedDosen.length})</h4>`;
    html += matchedDosen.map(d => `
      <a href="staff.php#profil-dosen-grid" class="card" style="display:block; text-decoration:none; color:inherit; padding: 0.65rem 0.85rem; margin-bottom: 0.4rem;" onclick="closeSearchModal();">
        <strong>${d.nama}</strong> - ${d.bidangKeahlian}
      </a>
    `).join('');
  }

  if (matchedMK.length > 0) {
    html += `<h4 style="color: var(--purple-700); font-size: 0.9rem; margin: 0.85rem 0 0.4rem 0;">Mata Kuliah (${matchedMK.length})</h4>`;
    html += matchedMK.map(m => `
      <a href="akademik.php#kurikulum" class="card" style="display:block; text-decoration:none; color:inherit; padding: 0.65rem 0.85rem; margin-bottom: 0.4rem;" onclick="closeSearchModal();">
        <strong>[${m.kode}] ${m.nama}</strong> (${m.sks} SKS) - ${m.desc}
      </a>
    `).join('');
  }

  if (matchedBerita.length > 0) {
    html += `<h4 style="color: var(--amber-700); font-size: 0.9rem; margin: 0.85rem 0 0.4rem 0;">Warta & Agenda (${matchedBerita.length})</h4>`;
    html += matchedBerita.map(b => `
      <a href="informasi.php#berita" class="card" style="display:block; text-decoration:none; color:inherit; padding: 0.65rem 0.85rem; margin-bottom: 0.4rem;" onclick="closeSearchModal();">
        <strong>${b.judul}</strong> (${b.tanggal})
      </a>
    `).join('');
  }

  if (!html) {
    html = `<p class="text-center" style="color: var(--slate-500); font-size: 0.88rem;">Tidak ditemukan hasil untuk "${query}"</p>`;
  }

  container.innerHTML = html;
}

function openAccreditationModal() {
  const details = document.getElementById('modal-accreditation-details');
  if (details) {
    details.innerText = `${prodiInfo.akreditasi.nomorSK} • Berlaku hingga ${prodiInfo.akreditasi.berlakuHingga}`;
  }
  const modal = document.getElementById('accreditation-modal');
  if (modal) modal.classList.add('active');
}

function closeAccreditationModal() {
  const modal = document.getElementById('accreditation-modal');
  if (modal) modal.classList.remove('active');
}

// Quality Assurance Modal Handlers
function openQualityModal() {
  const qa = prodiInfo.qualityAssurance;
  const title = document.getElementById('qa-modal-title');
  if (title) title.innerText = qa.nama;

  const standar = document.getElementById('qa-modal-standar');
  if (standar) standar.innerText = `Standar Acuan: ${qa.standar}`;

  const tugas = document.getElementById('qa-modal-tugas');
  if (tugas) tugas.innerText = `${qa.siklus}\n\n${qa.tugas}`;

  const modal = document.getElementById('qa-modal');
  if (modal) modal.classList.add('active');
}

function closeQualityModal() {
  const modal = document.getElementById('qa-modal');
  if (modal) modal.classList.remove('active');
}

function handleContactSubmit(e) {
  e.preventDefault();
  alert("Pesan Anda telah berhasil dikirim ke Sekretariat Program Studi S1 Pendidikan Bahasa Inggris Universitas PGRI Pontianak.");
}

// 8. Sistem Switch Multibahasa (EN | ID)
let currentLang = localStorage.getItem('site_lang') || 'id';

const translations = {
  id: {
    brand_title: "Pendidikan Bahasa Inggris",
    brand_univ: "Universitas PGRI Pontianak",
    nav_home: "BERANDA",
    nav_profil: "PROFIL",
    nav_akademik: "AKADEMIK",
    nav_mahasiswa: "MAHASISWA",
    nav_staff: "STAFF",
    nav_informasi: "INFORMASI",
    nav_fasilitas: "FASILITAS",
    nav_admin: "PANEL ADMIN",
    search: "Pencarian",
    pmb_btn: "Pendaftaran PMB",
    hero_badge: "AKREDITASI UNGGUL | LAMDIK No. 993/SK/LAMDIK/Ak/S/VI/2026",
    hero_heading: "Portal Resmi S1 Pendidikan Bahasa Inggris",
    hero_sub: "Mewujudkan pendidik Bahasa Inggris yang profesional, berkarakter unggul, inovatif dalam teknologi pembelajaran digital, serta berdaya saing global di Fakultas Pendidikan Bahasa dan Seni UPGRI Pontianak.",
    hero_btn_pmb: "Pendaftaran PMB TA 2026/2027",
    hero_btn_sks: "Struktur Kurikulum SKS",
    stat_alumni: "Alumni Pendidik",
    stat_work: "Serapan Kerja",
    stat_partners: "Sekolah Mitra",
    services_title: "Layanan Utama & Akses Portal",
    services_sub: "Layanan informasi publik, akademik, dan administrasi kemahasiswaan terpadu berbasis teknologi digital.",
    service_1_title: "Layanan Akademik",
    service_1_desc: "Akses struktur 144 SKS mata kuliah, jadwal perkuliahan, dan panduan skripsi.",
    service_1_btn: "Buka Kurikulum SKS",
    service_2_title: "PMB & Beasiswa",
    service_2_desc: "Informasi pendaftaran mahasiswa baru, syarat penerimaan, dan rincian SPP studi.",
    service_2_btn: "Portal Pendaftaran SPMB",
    service_3_title: "Jurnal & E-Library",
    service_3_desc: "Publikasi ilmiah internasional JELTL, koleksi skripsi digital, dan repositori riset.",
    service_3_btn: "Buka Jurnal JELTL",
    service_4_title: "Pusat Informasi",
    service_4_desc: "Konsultasi akademik, direktori dosen, layanan pengaduan, dan kontak lokasi prodi.",
    service_4_btn: "Hubungi Sekretariat",
    welcome_quote: '"Selamat Datang di Portal Resmi S1 Pendidikan Bahasa Inggris UPGRI Pontianak"',
    welcome_body: "Kami berkomitmen untuk menyelenggarakan pendidikan berkualitas tinggi yang memadukan keahlian berbahasa Inggris, pedagogi modern berbasis ICT, serta pembentukan karakter pendidik yang berintegritas dan siap bersaing di era global.",
    welcome_role: "Ketua Program Studi PBI",
    advantages_title: "Mengapa Memilih PBI UPGRI Pontianak?",
    advantages_sub: "Fasilitas laboratorium bahasa canggih, staf pengajar berkualitas, dan kurikulum pengajaran bahasa Inggris modern berbasis teknologi digital.",
    news_title: "Berita & Agenda Terkini",
    news_archive_btn: "Arsip Berita & Agenda",
    tracer_title: "Testimoni Alumni PBI",
    tracer_sub: "Kesan para lulusan S1 Pendidikan Bahasa Inggris yang telah sukses menjadi guru profesional, peneliti, awardee beasiswa luar negeri, dan wirausahawan.",
    tracer_all_btn: "Lihat Semua Profil Alumni & Prestasi Mahasiswa",
    rights: "Seluruh hak cipta dilindungi.",
    title_404: "Halaman Tidak Ditemukan",
    desc_404: "Maaf, halaman yang Anda tuju tidak tersedia, alamat URL salah, atau konten telah dipindahkan.",
    btn_home_404: "Kembali ke Beranda",
    btn_contact_404: "Hubungi Sekretariat"
  },
  en: {
    brand_title: "English Language Education",
    brand_univ: "PGRI Pontianak University",
    nav_home: "HOME",
    nav_profil: "PROFILE",
    nav_akademik: "ACADEMICS",
    nav_mahasiswa: "STUDENTS",
    nav_staff: "FACULTY & STAFF",
    nav_informasi: "INFORMATION",
    nav_fasilitas: "FACILITIES",
    nav_admin: "ADMIN PANEL",
    search: "Search",
    pmb_btn: "PMB Admission",
    hero_badge: "EXCELLENT ACCREDITATION | LAMDIK No. 993/SK/LAMDIK/Ak/S/VI/2026",
    hero_heading: "Official Portal of English Education B.Ed Program",
    hero_sub: "Fostering professional, high-character English educators equipped with ICT learning technologies and global competitiveness at FPBS UPGRI Pontianak.",
    hero_btn_pmb: "PMB Admission 2026/2027",
    hero_btn_sks: "SKS Curriculum Structure",
    stat_alumni: "Educator Alumni",
    stat_work: "Graduate Employment",
    stat_partners: "Partner Schools",
    services_title: "Core Services & Portal Access",
    services_sub: "Integrated public information, academic services, and digital student administration.",
    service_1_title: "Academic Services",
    service_1_desc: "Access 144 SKS course structures, lecture schedules, and thesis guidelines.",
    service_1_btn: "Open Curriculum",
    service_2_title: "Admission & Scholarships",
    service_2_desc: "New student registration info, entry requirements, and tuition fee details.",
    service_2_btn: "SPMB Admission Portal",
    service_3_title: "Journals & E-Library",
    service_3_desc: "JELTL international scientific publication, digital thesis archive, and research repository.",
    service_3_btn: "Open JELTL Journal",
    service_4_title: "Information Center",
    service_4_desc: "Academic counseling, faculty directory, complaint desk, and department contact.",
    service_4_btn: "Contact Secretariat",
    welcome_quote: '"Welcome to the Official Portal of English Language Education UPGRI Pontianak"',
    welcome_body: "We are committed to delivering high-quality education combining English language mastery, modern ICT pedagogy, and character building to produce global-ready educators.",
    welcome_role: "Head of English Education Department",
    advantages_title: "Why Choose English Education UPGRI Pontianak?",
    advantages_sub: "State-of-the-art CALL language laboratories, highly qualified faculty, and digital ICT curriculum.",
    news_title: "Latest News & Events",
    news_archive_btn: "News & Agenda Archives",
    tracer_title: "Alumni Testimonials",
    tracer_sub: "Testimonials from graduates working as professional teachers, researchers, overseas scholarship awardees, and entrepreneurs.",
    tracer_all_btn: "View All Alumni Profiles & Student Achievements",
    rights: "All rights reserved.",
    title_404: "Page Not Found",
    desc_404: "Sorry, the page you are looking for does not exist, has been moved, or the URL is incorrect.",
    btn_home_404: "Back to Home",
    btn_contact_404: "Contact Secretariat"
  }
};

function toggleLanguage() {
  currentLang = currentLang === 'id' ? 'en' : 'id';
  localStorage.setItem('site_lang', currentLang);
  updateLanguageUI();
}

function updateLanguageUI() {
  const btnEnHeader = document.getElementById('lang-btn-en');
  const btnIdHeader = document.getElementById('lang-btn-id');
  const btnEnFooter = document.getElementById('footer-lang-btn-en');
  const btnIdFooter = document.getElementById('footer-lang-btn-id');

  if (currentLang === 'en') {
    if (btnEnHeader) btnEnHeader.classList.add('active');
    if (btnIdHeader) btnIdHeader.classList.remove('active');
    if (btnEnFooter) btnEnFooter.classList.add('active');
    if (btnIdFooter) btnIdFooter.classList.remove('active');
  } else {
    if (btnEnHeader) btnEnHeader.classList.remove('active');
    if (btnIdHeader) btnIdHeader.classList.add('active');
    if (btnEnFooter) btnEnFooter.classList.remove('active');
    if (btnIdFooter) btnIdFooter.classList.add('active');
  }

  const navHome = document.getElementById('nav-home');
  if (navHome && navHome.childNodes[0]) navHome.childNodes[0].nodeValue = translations[currentLang].nav_home;

  const navProfil = document.getElementById('nav-profil');
  if (navProfil && navProfil.childNodes[0]) navProfil.childNodes[0].nodeValue = translations[currentLang].nav_profil + ' ';

  const navAkademik = document.getElementById('nav-akademik');
  if (navAkademik && navAkademik.childNodes[0]) navAkademik.childNodes[0].nodeValue = translations[currentLang].nav_akademik + ' ';

  const navMahasiswa = document.getElementById('nav-kemahasiswaan');
  if (navMahasiswa && navMahasiswa.childNodes[0]) navMahasiswa.childNodes[0].nodeValue = translations[currentLang].nav_mahasiswa + ' ';

  const navStaff = document.getElementById('nav-staff');
  if (navStaff && navStaff.childNodes[0]) navStaff.childNodes[0].nodeValue = translations[currentLang].nav_staff + ' ';

  const navInformasi = document.getElementById('nav-informasi');
  if (navInformasi && navInformasi.childNodes[0]) navInformasi.childNodes[0].nodeValue = translations[currentLang].nav_informasi + ' ';

  const navFasilitas = document.getElementById('nav-fasilitas');
  if (navFasilitas && navFasilitas.childNodes[0]) navFasilitas.childNodes[0].nodeValue = translations[currentLang].nav_fasilitas + ' ';

  document.querySelectorAll('[data-i18n]').forEach(el => {
    const key = el.getAttribute('data-i18n');
    if (translations[currentLang] && translations[currentLang][key]) {
      el.innerText = translations[currentLang][key];
    }
  });
}

document.addEventListener("DOMContentLoaded", () => {
  // updateLanguageUI();
});

// Mobile Navigation Toggle Functions
function toggleMobileNav() {
  const drawer = document.getElementById('mobile-nav-drawer');
  if (drawer) {
    drawer.classList.toggle('active');
  }
}

function toggleMobileSubmenu(id) {
  const sub = document.getElementById(id);
  if (sub) {
    sub.classList.toggle('active');
  }
}

// Background Slider Logic for Hero Section
let currentHeroSlide = 0;
let heroSlideTimer = null;

function initHeroSlider() {
  const slides = document.querySelectorAll('.hero-bg-slide');
  const dots = document.querySelectorAll('.slider-dot');
  if (!slides || slides.length === 0) return;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      if (i === index) {
        slide.classList.add('active');
      } else {
        slide.classList.remove('active');
      }
    });

    dots.forEach((dot, i) => {
      if (i === index) {
        dot.classList.add('active');
      } else {
        dot.classList.remove('active');
      }
    });

    currentHeroSlide = index;
  }

  window.setHeroSlide = function(index) {
    showSlide(index);
    resetHeroSlideTimer();
  };

  function nextSlide() {
    let next = (currentHeroSlide + 1) % slides.length;
    showSlide(next);
  }

  function resetHeroSlideTimer() {
    if (heroSlideTimer) clearInterval(heroSlideTimer);
    heroSlideTimer = setInterval(nextSlide, 5000);
  }

  showSlide(0);
  resetHeroSlideTimer();
}

document.addEventListener("DOMContentLoaded", () => {
  initHeroSlider();
});

