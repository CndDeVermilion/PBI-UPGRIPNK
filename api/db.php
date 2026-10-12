<?php
// Database Helper using PDO (SQLite / MySQL)
// Default: SQLite database stored locally in data/database.sqlite

$dbPath = __DIR__ . '/../data/database.sqlite';

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]));
}

// Function to initialize schema and seed initial data if empty
function initDatabase($pdo) {
    // 1. Users Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL,
        nama TEXT NOT NULL,
        role TEXT DEFAULT 'admin',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 2. Berita Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS berita (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        news_id TEXT UNIQUE,
        slug TEXT UNIQUE,
        judul TEXT NOT NULL,
        kategori TEXT NOT NULL,
        tanggal TEXT NOT NULL,
        ringkasan TEXT NOT NULL,
        konten TEXT,
        gambar TEXT,
        views INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 3. Dosen Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS dosen (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        dosen_id TEXT UNIQUE,
        nama TEXT NOT NULL,
        nip TEXT,
        jabatan TEXT NOT NULL,
        bidang_keahlian TEXT NOT NULL,
        email TEXT,
        foto TEXT,
        pendidikan TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 4. Kurikulum Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS kurikulum (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        semester INTEGER NOT NULL,
        kode TEXT NOT NULL,
        nama TEXT NOT NULL,
        sks INTEGER NOT NULL,
        sifat TEXT NOT NULL,
        desc TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 5. Prodi Info Table (Key-Value)
    $pdo->exec("CREATE TABLE IF NOT EXISTS prodi_info (
        key_name TEXT PRIMARY KEY,
        val_content TEXT NOT NULL
    )");

    // Seed default admin user if empty
    $userCheck = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    if ($userCheck == 0) {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, nama, role) VALUES (?, ?, ?, ?)");
        $defaultPass = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt->execute(['admin', $defaultPass, 'Administrator PBI', 'admin']);
    }

    // Seed from db.json if database tables are empty
    $beritaCheck = $pdo->query("SELECT COUNT(*) FROM berita")->fetchColumn();
    $dbJsonFile = __DIR__ . '/../data/db.json';

    if ($beritaCheck == 0 && file_exists($dbJsonFile)) {
        $jsonContent = json_decode(file_get_contents($dbJsonFile), true);
        if ($jsonContent) {
            // Seed Berita
            if (!empty($jsonContent['beritaList'])) {
                $stmt = $pdo->prepare("INSERT OR IGNORE INTO berita (news_id, slug, judul, kategori, tanggal, ringkasan, konten, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                foreach ($jsonContent['beritaList'] as $b) {
                    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $b['judul']), '-'));
                    $konten = $b['ringkasan'] . "\n\nProgram Studi S1 Pendidikan Bahasa Inggris Universitas PGRI Pontianak terus berkomitmen untuk menghadirkan pendidikan berkualitas tinggi melalui berbagai program akademis, pengembangan riset, serta pengabdian kepada masyarakat.";
                    $stmt->execute([
                        $b['id'] ?? ('news-' . uniqid()),
                        $slug,
                        $b['judul'],
                        $b['kategori'],
                        $b['tanggal'],
                        $b['ringkasan'],
                        $konten,
                        $b['gambar']
                    ]);
                }
            }

            // Seed Dosen
            if (!empty($jsonContent['dosenList'])) {
                $stmt = $pdo->prepare("INSERT OR IGNORE INTO dosen (dosen_id, nama, nip, jabatan, bidang_keahlian, email, foto, pendidikan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                foreach ($jsonContent['dosenList'] as $d) {
                    $pendidikanStr = is_array($d['pendidikan'] ?? null) ? implode('; ', $d['pendidikan']) : ($d['pendidikan'] ?? '');
                    $stmt->execute([
                        $d['id'] ?? ('ds-' . uniqid()),
                        $d['nama'],
                        $d['nip'] ?? '',
                        $d['jabatan'],
                        $d['bidangKeahlian'] ?? '',
                        $d['email'] ?? '',
                        $d['foto'] ?? '',
                        $pendidikanStr
                    ]);
                }
            }

            // Seed Kurikulum
            if (!empty($jsonContent['kurikulumData']['semesters'])) {
                $stmt = $pdo->prepare("INSERT INTO kurikulum (semester, kode, nama, sks, sifat, desc) VALUES (?, ?, ?, ?, ?, ?)");
                foreach ($jsonContent['kurikulumData']['semesters'] as $sem) {
                    $semNum = $sem['semester'];
                    if (!empty($sem['mk'])) {
                        foreach ($sem['mk'] as $m) {
                            $stmt->execute([
                                $semNum,
                                $m['kode'],
                                $m['nama'],
                                $m['sks'],
                                $m['sifat'],
                                $m['desc']
                            ]);
                        }
                    }
                }
            }

            // Seed Prodi Info
            if (!empty($jsonContent['prodiInfo'])) {
                $stmt = $pdo->prepare("INSERT OR REPLACE INTO prodi_info (key_name, val_content) VALUES (?, ?)");
                $stmt->execute(['prodi_info_json', json_encode($jsonContent['prodiInfo'], JSON_UNESCAPED_UNICODE)]);
            }
        }
    }
}

// Run DB init
initDatabase($pdo);
