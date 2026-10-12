// CMS admin controller for S1 Pendidikan Bahasa Inggris UPGRI Pontianak

let dbData = null;
let currentAdminSemester = 1;
let editingDosenIndex = -1;
let editingBeritaIndex = -1;
let editingMKIndex = -1;

document.addEventListener("DOMContentLoaded", () => {
  fetchDB();
});

// Fetch full dataset from API
async function fetchDB(showNotification = false) {
  try {
    const res = await fetch('../api/api.php?action=get');
    if (res.ok) {
      dbData = await res.json();
      renderDashboard();
      renderDosenTable();
      renderBeritaTable();
      renderKurikulumTable(currentAdminSemester);
      loadProfilForm();
      if (showNotification) {
        showToast('Sinkronisasi data database berhasil.');
      }
    } else {
      showToast('Gagal memuat data dari database.', true);
    }
  } catch (err) {
    showToast('Terjadi gangguan jaringan saat memuat data.', true);
  }
}

// Persist modified dataset to database
async function saveDB(successMessage = "Perubahan berhasil disimpan.") {
  if (!dbData) return;
  try {
    const res = await fetch('../api/api.php?action=save', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(dbData)
    });
    const result = await res.json();
    if (res.ok && result.success) {
      showToast(successMessage);
      renderDashboard();
    } else {
      showToast(result.message || 'Gagal menyimpan perubahan ke database.', true);
    }
  } catch (err) {
    showToast('Koneksi server terputus saat menyimpan data.', true);
  }
}

// Handle image upload through API
async function uploadImageFile(inputEl, targetInputId, previewImgId) {
  if (!inputEl.files || !inputEl.files[0]) return;
  const file = inputEl.files[0];
  const formData = new FormData();
  formData.append('file', file);

  try {
    showToast('Mengunggah gambar ke server...');
    const res = await fetch('../api/api.php?action=upload', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    if (res.ok && data.success) {
      document.getElementById(targetInputId).value = data.url;
      updateImgPreview(previewImgId, data.url);
      showToast('Berkas gambar berhasil diunggah.');
    } else {
      showToast(data.message || 'Gagal mengunggah berkas gambar.', true);
    }
  } catch (err) {
    showToast('Gagal mengunggah gambar karena kesalahan jaringan.', true);
  }
}

function updateImgPreview(previewImgId, url) {
  const prev = document.getElementById(previewImgId);
  if (!prev) return;
  if (!url) {
    prev.style.display = 'none';
    prev.src = '';
    return;
  }
  const cleanUrl = url.startsWith('http') || url.startsWith('/') ? url : '../' + url;
  prev.src = cleanUrl;
  prev.style.display = 'block';
}

function showToast(msg, isError = false) {
  let toast = document.getElementById('toast-notification');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'toast-notification';
    toast.className = 'toast-msg';
    document.body.appendChild(toast);
  }
  toast.innerText = msg;
  toast.style.borderLeftColor = isError ? '#EF4444' : '#10B981';
  toast.classList.add('show');
  setTimeout(() => {
    toast.classList.remove('show');
  }, 3500);
}

async function logoutAdmin() {
  await fetch('../api/api.php?action=logout');
  window.location.href = 'login.php';
}

function switchAdminTab(tabId, btnElement) {
  document.querySelectorAll('.tab-module').forEach(m => m.classList.remove('active'));
  document.querySelectorAll('.nav-tab-btn').forEach(btn => btn.classList.remove('active'));
  
  const target = document.getElementById(tabId);
  if (target) target.classList.add('active');
  if (btnElement) btnElement.classList.add('active');
}

// Render summary metrics and latest news on dashboard
function renderDashboard() {
  if (!dbData) return;
  const countDosen = dbData.dosenList ? dbData.dosenList.length : 0;
  const countBerita = dbData.beritaList ? dbData.beritaList.length : 0;

  let totalMK = 0;
  if (dbData.kurikulumData && dbData.kurikulumData.semesters) {
    dbData.kurikulumData.semesters.forEach(s => totalMK += s.mk ? s.mk.length : 0);
  }

  const elDosen = document.getElementById('stat-total-dosen');
  if (elDosen) elDosen.innerText = countDosen;

  const elBerita = document.getElementById('stat-total-berita');
  if (elBerita) elBerita.innerText = countBerita;

  const elMK = document.getElementById('stat-total-mk');
  if (elMK) elMK.innerText = totalMK;

  const elAkred = document.getElementById('stat-akreditasi');
  const elAkredSub = document.getElementById('stat-akreditasi-sub');
  if (elAkred && dbData.prodiInfo && dbData.prodiInfo.akreditasi) {
    elAkred.innerText = dbData.prodiInfo.akreditasi.peringkat || 'BAIK SEKALI';
    if (elAkredSub) {
      elAkredSub.innerText = `${dbData.prodiInfo.akreditasi.nomorSK || 'SK LAMDIK'} (s.d. ${dbData.prodiInfo.akreditasi.berlakuHingga || '2029'})`;
    }
  }

  // Render recent 3 news articles on dashboard table
  const recentTable = document.getElementById('dashboard-recent-news');
  if (recentTable && dbData.beritaList) {
    const recents = dbData.beritaList.slice(0, 3);
    if (recents.length === 0) {
      recentTable.innerHTML = `<tr><td colspan="4" style="text-align: center; color: var(--admin-text-subtle);">Belum ada warta berita yang diterbitkan.</td></tr>`;
    } else {
      recentTable.innerHTML = recents.map((b, idx) => `
        <tr>
          <td>
            <div style="font-weight: 600; color: var(--admin-brand-dark); line-height: 1.3;">${escapeHtml(b.judul)}</div>
          </td>
          <td><span class="status-badge badge-purple">${escapeHtml(b.kategori)}</span></td>
          <td style="color: var(--admin-text-subtle); font-size: 0.82rem;">${escapeHtml(b.tanggal)}</td>
          <td style="text-align: center;">
            <button type="button" class="btn-action btn-secondary btn-sm" onclick="switchAdminTab('tab-berita', document.querySelectorAll('.nav-tab-btn')[1]); editBerita(${idx});">
              Edit
            </button>
          </td>
        </tr>
      `).join('');
    }
  }
}

// Lecturer directory operations
function renderDosenTable() {
  const tbody = document.getElementById('dosen-table-body');
  if (!tbody || !dbData || !dbData.dosenList) return;

  if (dbData.dosenList.length === 0) {
    tbody.innerHTML = `<tr><td colspan="6" style="text-align: center; color: var(--admin-text-subtle);">Belum ada data dosen tersimpan.</td></tr>`;
    return;
  }

  tbody.innerHTML = dbData.dosenList.map((d, index) => {
    const fotoUrl = d.foto ? (d.foto.startsWith('http') || d.foto.startsWith('/') ? d.foto : '../' + d.foto) : '../img/undraw_pic-profile_nr49.svg';
    return `
      <tr>
        <td style="font-weight: 700; color: var(--admin-text-subtle);">${index + 1}</td>
        <td>
          <div style="display: flex; align-items: center; gap: 0.75rem;">
            <img src="${escapeHtml(fotoUrl)}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid var(--admin-border);" alt="${escapeHtml(d.nama)}">
            <div>
              <div style="font-weight: 700; color: var(--admin-brand-dark);">${escapeHtml(d.nama)}</div>
              <div style="font-size: 0.78rem; color: var(--admin-text-subtle);">${d.nip ? 'NIP: ' + escapeHtml(d.nip) : 'NIP: -'}</div>
            </div>
          </div>
        </td>
        <td><span class="status-badge badge-purple">${escapeHtml(d.jabatan)}</span></td>
        <td style="color: var(--admin-text-muted); font-size: 0.85rem;">${escapeHtml(d.bidangKeahlian || '-')}</td>
        <td style="color: var(--admin-brand-purple); font-size: 0.84rem;">${escapeHtml(d.email || '-')}</td>
        <td style="text-align: center;">
          <div style="display: inline-flex; gap: 0.35rem;">
            <button type="button" class="btn-action btn-secondary btn-sm" onclick="editDosen(${index})">Edit</button>
            <button type="button" class="btn-action btn-danger btn-sm" onclick="deleteDosen(${index})">Hapus</button>
          </div>
        </td>
      </tr>
    `;
  }).join('');
}

function openDosenModal(index = -1) {
  editingDosenIndex = index;
  const modalTitle = document.getElementById('modal-dosen-title');
  const form = document.getElementById('form-dosen');
  form.reset();

  if (index >= 0) {
    modalTitle.innerText = "Edit Data Dosen";
    const d = dbData.dosenList[index];
    document.getElementById('dosen-nama').value = d.nama || '';
    document.getElementById('dosen-nip').value = d.nip || '';
    document.getElementById('dosen-jabatan').value = d.jabatan || '';
    document.getElementById('dosen-keahlian').value = d.bidangKeahlian || '';
    document.getElementById('dosen-email').value = d.email || '';
    document.getElementById('dosen-foto').value = d.foto || '';
    updateImgPreview('dosen-img-preview', d.foto || '');
  } else {
    modalTitle.innerText = "Tambah Dosen Baru";
    document.getElementById('dosen-foto').value = "img/undraw_pic-profile_nr49.svg";
    updateImgPreview('dosen-img-preview', "img/undraw_pic-profile_nr49.svg");
  }
  document.getElementById('modal-dosen').classList.add('active');
}

function closeDosenModal() {
  document.getElementById('modal-dosen').classList.remove('active');
}

function saveDosenForm(e) {
  e.preventDefault();
  const nama = document.getElementById('dosen-nama').value.trim();
  const nip = document.getElementById('dosen-nip').value.trim();
  const jabatan = document.getElementById('dosen-jabatan').value.trim();
  const bidangKeahlian = document.getElementById('dosen-keahlian').value.trim();
  const email = document.getElementById('dosen-email').value.trim();
  const foto = document.getElementById('dosen-foto').value.trim() || 'img/undraw_pic-profile_nr49.svg';

  const newItem = {
    id: editingDosenIndex >= 0 ? dbData.dosenList[editingDosenIndex].id : 'ds-' + String(dbData.dosenList.length + 1).padStart(2, '0'),
    nama, nip, jabatan, bidangKeahlian, email, foto,
    pendidikan: editingDosenIndex >= 0 ? dbData.dosenList[editingDosenIndex].pendidikan : ["S1 Pendidikan Bahasa Inggris"]
  };

  if (editingDosenIndex >= 0) {
    dbData.dosenList[editingDosenIndex] = newItem;
  } else {
    dbData.dosenList.push(newItem);
  }

  closeDosenModal();
  renderDosenTable();
  saveDB("Data dosen berhasil diperbarui.");
}

function editDosen(index) {
  openDosenModal(index);
}

function deleteDosen(index) {
  const dosen = dbData.dosenList[index];
  if (!dosen) return;
  if (confirm(`Apakah Anda yakin ingin menghapus "${dosen.nama}" dari direktori dosen?`)) {
    dbData.dosenList.splice(index, 1);
    renderDosenTable();
    saveDB("Data dosen berhasil dihapus.");
  }
}

// News management operations
function renderBeritaTable() {
  const tbody = document.getElementById('berita-table-body');
  if (!tbody || !dbData || !dbData.beritaList) return;

  if (dbData.beritaList.length === 0) {
    tbody.innerHTML = `<tr><td colspan="7" style="text-align: center; color: var(--admin-text-subtle);">Belum ada warta berita yang terdaftar.</td></tr>`;
    return;
  }

  tbody.innerHTML = dbData.beritaList.map((b, index) => {
    const gambarUrl = b.gambar ? (b.gambar.startsWith('http') || b.gambar.startsWith('/') ? b.gambar : '../' + b.gambar) : '../img/Background.jpg';
    return `
      <tr>
        <td style="font-weight: 700; color: var(--admin-text-subtle);">${index + 1}</td>
        <td>
          <img src="${escapeHtml(gambarUrl)}" style="width: 58px; height: 38px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--admin-border);" alt="${escapeHtml(b.judul)}">
        </td>
        <td style="font-weight: 700; color: var(--admin-brand-dark); max-width: 260px;">
          ${escapeHtml(b.judul)}
        </td>
        <td><span class="status-badge badge-purple">${escapeHtml(b.kategori)}</span></td>
        <td style="color: var(--admin-text-subtle); font-size: 0.82rem;">${escapeHtml(b.tanggal)}</td>
        <td style="color: var(--admin-text-muted); font-size: 0.84rem; max-width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
          ${escapeHtml(b.ringkasan || '')}
        </td>
        <td style="text-align: center;">
          <div style="display: inline-flex; gap: 0.35rem;">
            <a class="btn-action btn-secondary btn-sm" href="../berita-detail.php?id=${encodeURIComponent(b.id)}" target="_blank">Lihat</a>
            <button type="button" class="btn-action btn-secondary btn-sm" onclick="editBerita(${index})">Edit</button>
            <button type="button" class="btn-action btn-danger btn-sm" onclick="deleteBerita(${index})">Hapus</button>
          </div>
        </td>
      </tr>
    `;
  }).join('');
}

function openBeritaModal(index = -1) {
  editingBeritaIndex = index;
  const modalTitle = document.getElementById('modal-berita-title');
  const form = document.getElementById('form-berita');
  form.reset();

  if (index >= 0) {
    modalTitle.innerText = "Edit Warta Berita";
    const b = dbData.beritaList[index];
    document.getElementById('berita-judul').value = b.judul || '';
    document.getElementById('berita-kategori').value = b.kategori || 'Pengumuman';
    document.getElementById('berita-tanggal').value = b.tanggal || '';
    document.getElementById('berita-ringkasan').value = b.ringkasan || '';
    document.getElementById('berita-konten').value = b.konten || b.ringkasan || '';
    document.getElementById('berita-gambar').value = b.gambar || '';
    updateImgPreview('berita-img-preview', b.gambar || '');
  } else {
    modalTitle.innerText = "Tambah Warta Berita Baru";
    const today = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    document.getElementById('berita-tanggal').value = today;
    document.getElementById('berita-gambar').value = "img/Background.jpg";
    updateImgPreview('berita-img-preview', "img/Background.jpg");
  }
  document.getElementById('modal-berita').classList.add('active');
}

function closeBeritaModal() {
  document.getElementById('modal-berita').classList.remove('active');
}

function saveBeritaForm(e) {
  e.preventDefault();
  const judul = document.getElementById('berita-judul').value.trim();
  const kategori = document.getElementById('berita-kategori').value;
  const tanggal = document.getElementById('berita-tanggal').value.trim();
  const ringkasan = document.getElementById('berita-ringkasan').value.trim();
  const konten = document.getElementById('berita-konten').value.trim();
  const gambar = document.getElementById('berita-gambar').value.trim() || 'img/Background.jpg';

  const newItem = {
    id: editingBeritaIndex >= 0 ? dbData.beritaList[editingBeritaIndex].id : 'news-' + String(dbData.beritaList.length + 1).padStart(2, '0'),
    judul, kategori, tanggal, ringkasan, konten, gambar
  };

  if (editingBeritaIndex >= 0) {
    dbData.beritaList[editingBeritaIndex] = newItem;
  } else {
    dbData.beritaList.unshift(newItem);
  }

  closeBeritaModal();
  renderBeritaTable();
  saveDB("Warta berita berhasil diperbarui.");
}

function editBerita(index) {
  openBeritaModal(index);
}

function deleteBerita(index) {
  const berita = dbData.beritaList[index];
  if (!berita) return;
  if (confirm(`Apakah Anda yakin ingin menghapus warta "${berita.judul}"?`)) {
    dbData.beritaList.splice(index, 1);
    renderBeritaTable();
    saveDB("Warta berita berhasil dihapus.");
  }
}

// Curriculum semester operations
function selectAdminSemester(semNum) {
  currentAdminSemester = semNum;
  document.querySelectorAll('.sem-tab-btn').forEach((btn, idx) => {
    if (idx + 1 === semNum) {
      btn.className = "btn-action btn-primary btn-sm sem-tab-btn";
    } else {
      btn.className = "btn-action btn-secondary btn-sm sem-tab-btn";
    }
  });
  renderKurikulumTable(semNum);
}

function renderKurikulumTable(semNum = currentAdminSemester) {
  const tbody = document.getElementById('kurikulum-table-body');
  if (!tbody || !dbData || !dbData.kurikulumData) return;

  const semData = dbData.kurikulumData.semesters.find(s => s.semester === semNum);
  if (!semData || !semData.mk || semData.mk.length === 0) {
    tbody.innerHTML = `<tr><td colspan="6" style="text-align: center; color: var(--admin-text-subtle);">Belum ada mata kuliah untuk Semester ${semNum}.</td></tr>`;
    return;
  }

  tbody.innerHTML = semData.mk.map((m, index) => `
    <tr>
      <td style="font-weight: 700; color: var(--admin-brand-purple);">${escapeHtml(m.kode)}</td>
      <td style="font-weight: 600; color: var(--admin-text-main);">${escapeHtml(m.nama)}</td>
      <td><span class="status-badge badge-purple">${m.sks} SKS</span></td>
      <td><span class="status-badge ${m.sifat.includes('Wajib') ? 'badge-slate' : 'badge-amber'}">${escapeHtml(m.sifat)}</span></td>
      <td style="color: var(--admin-text-muted); font-size: 0.85rem;">${escapeHtml(m.desc || '-')}</td>
      <td style="text-align: center;">
        <div style="display: inline-flex; gap: 0.35rem;">
          <button type="button" class="btn-action btn-secondary btn-sm" onclick="editMK(${index})">Edit</button>
          <button type="button" class="btn-action btn-danger btn-sm" onclick="deleteMK(${index})">Hapus</button>
        </div>
      </td>
    </tr>
  `).join('');
}

function openMKModal(index = -1) {
  editingMKIndex = index;
  const modalTitle = document.getElementById('modal-mk-title');
  const form = document.getElementById('form-mk');
  form.reset();

  const semData = dbData.kurikulumData.semesters.find(s => s.semester === currentAdminSemester);

  if (index >= 0 && semData && semData.mk[index]) {
    modalTitle.innerText = `Edit Mata Kuliah (Semester ${currentAdminSemester})`;
    const m = semData.mk[index];
    document.getElementById('mk-kode').value = m.kode || '';
    document.getElementById('mk-nama').value = m.nama || '';
    document.getElementById('mk-sks').value = m.sks || 3;
    document.getElementById('mk-sifat').value = m.sifat || 'Wajib';
    document.getElementById('mk-desc').value = m.desc || '';
  } else {
    modalTitle.innerText = `Tambah Mata Kuliah (Semester ${currentAdminSemester})`;
    const nextNum = semData && semData.mk ? semData.mk.length + 1 : 1;
    document.getElementById('mk-kode').value = `PBI${currentAdminSemester}0${nextNum}`;
    document.getElementById('mk-sks').value = 3;
  }
  document.getElementById('modal-mk').classList.add('active');
}

function closeMKModal() {
  document.getElementById('modal-mk').classList.remove('active');
}

function saveMKForm(e) {
  e.preventDefault();
  const kode = document.getElementById('mk-kode').value.trim();
  const nama = document.getElementById('mk-nama').value.trim();
  const sks = parseInt(document.getElementById('mk-sks').value) || 2;
  const sifat = document.getElementById('mk-sifat').value;
  const desc = document.getElementById('mk-desc').value.trim();

  const semData = dbData.kurikulumData.semesters.find(s => s.semester === currentAdminSemester);
  if (!semData) return;

  const newItem = { kode, nama, sks, sifat, desc };

  if (editingMKIndex >= 0) {
    semData.mk[editingMKIndex] = newItem;
  } else {
    semData.mk.push(newItem);
  }

  semData.totalSKS = semData.mk.reduce((sum, item) => sum + item.sks, 0);

  closeMKModal();
  renderKurikulumTable(currentAdminSemester);
  saveDB(`Kurikulum Semester ${currentAdminSemester} berhasil diperbarui.`);
}

function editMK(index) {
  openMKModal(index);
}

function deleteMK(index) {
  const semData = dbData.kurikulumData.semesters.find(s => s.semester === currentAdminSemester);
  if (!semData || !semData.mk[index]) return;

  if (confirm(`Apakah Anda yakin ingin menghapus mata kuliah "${semData.mk[index].nama}"?`)) {
    semData.mk.splice(index, 1);
    semData.totalSKS = semData.mk.reduce((sum, item) => sum + item.sks, 0);
    renderKurikulumTable(currentAdminSemester);
    saveDB("Mata kuliah berhasil dihapus.");
  }
}

// Program profile & leadership operations
function loadProfilForm() {
  if (!dbData || !dbData.prodiInfo) return;

  const info = dbData.prodiInfo;
  document.getElementById('profil-visi').value = info.visi || '';
  document.getElementById('profil-misi').value = Array.isArray(info.misi) ? info.misi.join('\n') : '';
  document.getElementById('profil-sk').value = info.akreditasi ? info.akreditasi.nomorSK : '';
  document.getElementById('profil-berlaku').value = info.akreditasi ? info.akreditasi.berlakuHingga : '';

  if (info.strukturOrganisasi && info.strukturOrganisasi.length >= 3) {
    document.getElementById('kaprodi-nama').value = info.strukturOrganisasi[0].nama || '';
    document.getElementById('sekprodi-nama').value = info.strukturOrganisasi[1].nama || '';
    document.getElementById('kalab-nama').value = info.strukturOrganisasi[2].nama || '';
  }
}

function saveProfilForm(e) {
  e.preventDefault();
  if (!dbData || !dbData.prodiInfo) return;

  dbData.prodiInfo.visi = document.getElementById('profil-visi').value.trim();
  dbData.prodiInfo.misi = document.getElementById('profil-misi').value.split('\n').map(l => l.trim()).filter(l => l !== '');
  
  if (dbData.prodiInfo.akreditasi) {
    dbData.prodiInfo.akreditasi.nomorSK = document.getElementById('profil-sk').value.trim();
    dbData.prodiInfo.akreditasi.berlakuHingga = document.getElementById('profil-berlaku').value.trim();
  }

  if (dbData.prodiInfo.strukturOrganisasi && dbData.prodiInfo.strukturOrganisasi.length >= 3) {
    dbData.prodiInfo.strukturOrganisasi[0].nama = document.getElementById('kaprodi-nama').value.trim();
    dbData.prodiInfo.strukturOrganisasi[1].nama = document.getElementById('sekprodi-nama').value.trim();
    dbData.prodiInfo.strukturOrganisasi[2].nama = document.getElementById('kalab-nama').value.trim();
  }

  saveDB("Informasi profil dan pimpinan prodi berhasil diperbarui.");
}

// Editor formatting helpers
function formatTextarea(elementId, tagType) {
  const el = document.getElementById(elementId);
  if (!el) return;

  const start = el.selectionStart;
  const end = el.selectionEnd;
  const selectedText = el.value.substring(start, end) || 'Teks';
  let replacement = '';

  if (tagType === 'bold') {
    replacement = `<b>${selectedText}</b>`;
  } else if (tagType === 'italic') {
    replacement = `<i>${selectedText}</i>`;
  } else if (tagType === 'underline') {
    replacement = `<u>${selectedText}</u>`;
  } else if (tagType === 'h3') {
    replacement = `\n<h3>${selectedText}</h3>\n`;
  } else if (tagType === 'list') {
    replacement = `\n• ${selectedText}`;
  }

  el.value = el.value.substring(0, start) + replacement + el.value.substring(end);
  el.focus();
  el.setSelectionRange(start + replacement.length, start + replacement.length);
}

document.addEventListener('keydown', (e) => {
  const activeEl = document.activeElement;
  if (activeEl && (activeEl.id === 'berita-konten' || activeEl.id === 'berita-ringkasan')) {
    if (e.ctrlKey || e.metaKey) {
      const key = e.key.toLowerCase();
      if (key === 'b') {
        e.preventDefault();
        formatTextarea(activeEl.id, 'bold');
      } else if (key === 'i') {
        e.preventDefault();
        formatTextarea(activeEl.id, 'italic');
      } else if (key === 'u') {
        e.preventDefault();
        formatTextarea(activeEl.id, 'underline');
      }
    }
  }
});

function escapeHtml(str) {
  if (typeof str !== 'string') return str || '';
  return str.replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
}
