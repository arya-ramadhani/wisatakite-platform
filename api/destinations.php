<?php
// api/destinations.php — JSON endpoint untuk filter kategori & rekomendasi pencarian (AJAX)
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json; charset=utf-8');

$category = isset($_GET['category']) ? trim($_GET['category']) : 'all';
$limit    = isset($_GET['limit'])    ? (int)$_GET['limit']   : 0;
$query    = isset($_GET['q'])        ? trim($_GET['q'])      : (isset($_GET['search']) ? trim($_GET['search']) : '');

// Data katalog destinasi lengkap WisataKite
$all = [
    [
        'id'             => 1,
        'name'           => 'Pagoda Nusantara',
        'location'       => 'Sungailiat',
        'category'       => 'sejarah',
        'category_label' => 'Sejarah',
        'img'            => 'assets/img/pagoda_nusantara.png',
        'url'            => 'detail.php?id=6',
    ],
    [
        'id'             => 2,
        'name'           => 'Pantai Lepar',
        'location'       => 'Belinyu',
        'category'       => 'pantai',
        'category_label' => 'Pantai',
        'img'            => 'assets/img/pulau_lepar.png',
        'url'            => 'detail.php?id=7',
    ],
    [
        'id'             => 3,
        'name'           => 'Pulau Gelasa',
        'location'       => 'Bangka Tengah',
        'category'       => 'pulau',
        'category_label' => 'Pulau',
        'img'            => 'assets/img/pulau_gelasa.png',
        'url'            => 'k_pulau.php',
    ],
    [
        'id'             => 4,
        'name'           => 'Pantai Romodong',
        'location'       => 'Belinyu',
        'category'       => 'pantai',
        'category_label' => 'Pantai',
        'img'            => 'assets/img/pantai_remodong.png',
        'url'            => 'k_pantai.php',
    ],
    [
        'id'             => 5,
        'name'           => 'Pantai Teluk Uber',
        'location'       => 'Sungailiat',
        'category'       => 'pantai',
        'category_label' => 'Pantai',
        'img'            => 'assets/img/pantai_remodong.png',
        'url'            => 'k_pantai.php',
    ],
    [
        'id'             => 6,
        'name'           => 'Pantai Matras',
        'location'       => 'Sungailiat',
        'category'       => 'pantai',
        'category_label' => 'Pantai',
        'img'            => 'assets/img/pantai_remodong.png',
        'url'            => 'k_pantai.php',
    ],
    [
        'id'             => 7,
        'name'           => 'Pulau Putri',
        'location'       => 'Bangka Barat',
        'category'       => 'pulau',
        'category_label' => 'Pulau',
        'img'            => 'assets/img/pulau_gelasa.png',
        'url'            => 'k_pulau.php',
    ],
    [
        'id'             => 8,
        'name'           => 'Situs Benteng Toboali',
        'location'       => 'Toboali',
        'category'       => 'sejarah',
        'category_label' => 'Sejarah',
        'img'            => 'assets/img/pagoda_nusantara.png',
        'url'            => 'k_sejarah.php',
    ],
    [
        'id'             => 9,
        'name'           => 'Pulau Ketawai',
        'location'       => 'Bangka Tengah',
        'category'       => 'pulau',
        'category_label' => 'Pulau',
        'img'            => 'assets/img/index3.png',
        'url'            => 'k_pulau.php',
    ],
    [
        'id'             => 10,
        'name'           => 'Pulau Celagen',
        'location'       => 'Bangka Selatan',
        'category'       => 'pulau',
        'category_label' => 'Pulau',
        'img'            => 'assets/img/pulau_gelasa.png',
        'url'            => 'k_pulau.php',
    ],
    [
        'id'             => 11,
        'name'           => 'Klenteng Dewi Laut',
        'location'       => 'Pangkalpinang',
        'category'       => 'sejarah',
        'category_label' => 'Sejarah',
        'img'            => 'assets/img/pagoda_nusantara.png',
        'url'            => 'k_sejarah.php',
    ],
    [
        'id'             => 12,
        'name'           => 'Museum Timah Indonesia',
        'location'       => 'Pangkalpinang',
        'category'       => 'sejarah',
        'category_label' => 'Sejarah',
        'img'            => 'assets/img/index1.png',
        'url'            => 'k_sejarah.php',
    ],
    [
        'id'             => 13,
        'name'           => 'Pesanggrahan Menumbing',
        'location'       => 'Mentok, Bangka Barat',
        'category'       => 'sejarah',
        'category_label' => 'Sejarah',
        'img'            => 'assets/img/pagoda_nusantara.png',
        'url'            => 'k_sejarah.php',
    ],
];

// Integrasi dengan database destinasi yang terverifikasi (Di Terima)
if (isset($koneksi) && $koneksi) {
    $dbRes = @mysqli_query($koneksi, "SELECT id_destinasi, nama_destinasi, alamat_destinasi, foto_destinasi FROM destinasi WHERE keterangan_destinasi = 'Di Terima'");
    if ($dbRes) {
        $existingNames = array_map(function($d) { return strtolower(trim($d['name'])); }, $all);
        while ($row = mysqli_fetch_assoc($dbRes)) {
            $dbName = trim($row['nama_destinasi']);
            $dbNameLower = strtolower($dbName);
            $foundIndex = array_search($dbNameLower, $existingNames);
            if ($foundIndex !== false) {
                // Perbarui URL ke ID spesifik di database
                $all[$foundIndex]['url'] = 'detail.php?id=' . (int)$row['id_destinasi'];
                if (!empty($row['foto_destinasi']) && file_exists(__DIR__ . '/../assets/img/destinasi/' . $row['foto_destinasi'])) {
                    $all[$foundIndex]['img'] = 'assets/img/destinasi/' . $row['foto_destinasi'];
                }
            } else {
                // Destinasi baru dari database
                $cat = 'pantai';
                if (stripos($dbName, 'pulau') !== false) {
                    $cat = 'pulau';
                } elseif (stripos($dbName, 'sejarah') !== false || stripos($dbName, 'benteng') !== false || stripos($dbName, 'pagoda') !== false || stripos($dbName, 'museum') !== false) {
                    $cat = 'sejarah';
                }
                $labels = ['pantai' => 'Pantai', 'pulau' => 'Pulau', 'sejarah' => 'Sejarah'];

                $img = 'assets/img/index2.png';
                if (!empty($row['foto_destinasi']) && file_exists(__DIR__ . '/../assets/img/destinasi/' . $row['foto_destinasi'])) {
                    $img = 'assets/img/destinasi/' . $row['foto_destinasi'];
                }

                $all[] = [
                    'id'             => (int)$row['id_destinasi'],
                    'name'           => $dbName,
                    'location'       => $row['alamat_destinasi'] ?: 'Bangka Belitung',
                    'category'       => $cat,
                    'category_label' => $labels[$cat] ?? 'Wisata',
                    'img'            => $img,
                    'url'            => 'detail.php?id=' . (int)$row['id_destinasi'],
                ];
            }
        }
    }
}

// 1. Filter pencarian kata kunci ($query) jika ada
if ($query !== '') {
    $qLower = strtolower($query);
    $all = array_values(array_filter($all, function($d) use ($qLower) {
        return stripos($d['name'], $qLower) !== false
            || stripos($d['location'], $qLower) !== false
            || stripos($d['category'], $qLower) !== false
            || stripos($d['category_label'] ?? '', $qLower) !== false;
    }));
}

// 2. Filter kategori jika diminta
if ($category !== 'all' && $category !== '') {
    $all = array_values(array_filter($all, fn($d) => $d['category'] === $category));
}

// 3. Batasi jumlah hasil jika diminta
if ($limit > 0) {
    $all = array_slice($all, 0, $limit);
}

echo json_encode([
    'status' => 'ok',
    'count'  => count($all),
    'data'   => $all
]);
