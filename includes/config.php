<?php
/* ============================================================
 * KONFIGURASI SITUS KLINIK — Medika Care
 * ============================================================ */

$namaKlinik = 'Medika Care';
$tagline   = 'Sehat Bersama Kami';
$promoStrip = 'Konsultasi dokter umum gratis • Check-up paket hemat • Buka setiap hari 08.00 - 20.00';

$dokterDefault = [
    ['id' => 1, 'nama' => 'dr. Ratna Dewi, Sp.PD', 'spesialis' => 'Penyakit Dalam', 'harga' => 150000, 'hargaAsli' => 200000, 'label' => 'Terlaris', 'singkat' => 'DR', 'pengalaman' => '12 Thn', 'jadwal' => 'Sen-Jum', 'warna' => ['#e11d48', '#be123c'], 'deskripsi' => 'Konsultasi penyakit dalam, hipertensi, dan diabetes.'],
    ['id' => 2, 'nama' => 'dr. Bagus Prasetyo, Sp.A', 'spesialisasi' => 'Kesehatan Anak', 'harga' => 140000, 'hargaAsli' => 0, 'label' => 'Baru', 'singkat' => 'BA', 'pengalaman' => '8 Thn', 'jadwal' => 'Sel-Sab', 'warna' => ['#f97316', '#ea580c'], 'deskripsi' => 'Perawatan tumbuh kembang dan imunisasi anak.'],
    ['id' => 3, 'nama' => 'drg. Sari Mutiara', 'spesialisasi' => 'Gigi', 'harga' => 180000, 'hargaAsli' => 0, 'label' => '', 'singkat' => 'GM', 'pengalaman' => '10 Thn', 'jadwal' => 'Sen-Kam', 'gigi' => '#0ea5e9', 'warna' => ['#0284c7', '#0369a1'], 'deskripsi' => 'Scaling, tambal gigi, dan perawatan saluran akar.'],
    ['id' => 4, 'nama' => 'dr. Andi Wijaya, Sp.OG', 'spesialisasi' => 'Kandungan', 'harga' => 200000, 'hargaAsli' => 250000, 'label' => 'Diskon', 'singkat' => 'OG', 'pengalaman' => '12 Thn', 'jadwal' => 'Sen-Jum', 'warna' => ['#8b5cf6', '#7c3aed'], 'deskripsi' => 'Pemeriksaan kehamilan dan kesehatan reproduksi.'],
    ['id' => 5, 'nama' => 'dr. Dewi Lestari', 'spesialisasi' => 'Umum', 'harga' => 100000, 'hargaAsli' => 0, 'label' => 'Terlaris', 'singkat' => 'DU', 'pengalaman' => '6 Thn', 'jadwal' => 'Setiap Hari', 'warna' => ['#16a34a', '#15803d'], 'deskripsi' => 'Layanan dokter umum dan pengecekan kesehatan rutin.'],
    ['id' => 6, 'nama' => 'dr. Nanda Putra, Sp.M', 'spesialisasi' => 'Mata', 'harga' => 180000, 'hargaAsli' => 220000, 'label' => 'Diskon', 'singkat' => 'MA', 'pengalaman' => '9 Thn', 'jadwal' => 'Rab-Sab', 'warna' => ['#0d9488', '#0f766e'], 'deskripsi' => 'Pemeriksaan mata, koreksi kacamata, dan keluhan mata.'],
];

$kategoriDokter = ['Semua', 'Umum', 'Kesehatan', 'Gigi', 'Mata', 'Kandungan', 'Penyakit Dalam'];
$statusJanji = ['Baru', 'Dikonfirmasi', 'Selesai', 'Dibatalkan'];

$kontak = ['alamat' => 'Jl. Sehat Sejahtera No. 7, Jakarta', 'telepon' => '(021) 555 7788', 'wa' => '6281234567890', 'email' => 'halo@medikacare.id', 'jam' => '08.00 - 20.00 WIB'];

$menuNav = [
    ['label' => 'Beranda', 'url' => 'index.php'],
    ['label' => 'Dokter', 'url' => 'dokter.php'],
    ['label' => 'Janji', 'url' => 'janji.php'],
];

$dataDir = __DIR__ . '/../data';
$dokterFile = $dataDir . '/dokter.json';
$janjiFile = $dataDir . '/janji.json';

function e($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }
function rupiah($n) { return 'Rp ' . number_format((int) $n, 0, ',', '.'); }
function baca_json($file, $default = []) { if (!is_file($file)) return is_array($default) ? $default : []; $d = json_decode(file_get_contents($file), true); return is_array($d) ? $d : $default; }
function tulis_json($file, $data) { $dir = dirname($file); if (!is_dir($dir)) mkdir($dir, 0777, true); file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)); }

$daftarDokter = baca_json($dokterFile, $dokterDefault);

function kartu_dokter($m) {
    $badge = '';
    if (!empty($m['label'])) { $cls = $m['label'] === 'Terlaris' ? 'badge-terlaris' : ($m['label'] === 'Baru' ? 'badge-baru' : 'badge-diskon'); $badge = '<span class="badge ' . $cls . '">' . e($m['label']) . '</span>'; }
    $diskon = '';
    if ((int) $m['hargaAsli'] > 0) { $diskon = '<span class="harga-asli">' . rupiah($m['hargaAsli']) . '</span>'; if (($m['label'] ?? '') !== 'Diskon') { $badge .= '<span class="badge badge-diskon">-' . (int) round((1 - $m['harga'] / $m['hargaAsli']) * 100) . '%</span>'; } }
    $w0 = e($m['warna'][0] ?? '#e11d48'); $w1 = e($m['warna'][1] ?? '#be123c');
    return '<article class="card" data-id="' . (int) $m['id'] . '">'
        . '<div class="card-gambar" style="background:linear-gradient(135deg,' . $w0 . ',' . $w1 . ')"><div class="img-lapis"><i class="fa-solid fa-user-doctor"></i></div>' . $badge . '</div>'
        . '<div class="card-body"><span class="card-kat">' . e($m['spesialisasi']) . '</span>'
        . '<h3 class="card-nama">' . e($m['nama']) . '</h3>'
        . '<p class="card-desk">' . e($m['deskripsi']) . '</p>'
        . '<div class="meta-dokter"><span><i class="fa-solid fa-briefcase-medical"></i> ' . e($m['pengalaman']) . '</span><span><i class="fa-solid fa-calendar-day"></i> ' . e($m['jadwal']) . '</span></div>'
        . '<div class="harga">' . rupiah($m['harga']) . $diskon . '</div>'
        . '<a class="btn-tambah" href="janji.php?dokter=' . (int) $m['id'] . '">Buat Janji</a>'
        . '</article>';
}