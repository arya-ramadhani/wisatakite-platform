<?php
// api/destinations.php — JSON endpoint untuk filter kategori (AJAX)
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json; charset=utf-8');

$category = isset($_GET['category']) ? trim($_GET['category']) : 'all';
$limit     = isset($_GET['limit'])    ? (int)$_GET['limit']   : 0;

// Daftar data statis (ganti dengan query DB jika tabel destinasi sudah ada)
$all = [
    [
        'id'       => 1,
        'name'     => 'Pagoda Nusantara',
        'location' => 'Sungailiat',
        'category' => 'sejarah',
        'img'      => 'assets/img/pagoda_nusantara.png',
    ],
    [
        'id'       => 2,
        'name'     => 'Pantai Lepar',
        'location' => 'Belinyu',
        'category' => 'pantai',
        'img'      => 'assets/img/pulau_lepar.png',
    ],
    [
        'id'       => 3,
        'name'     => 'Pulau Gelasa',
        'location' => 'Bangka Tengah',
        'category' => 'pulau',
        'img'      => 'assets/img/pulau_gelasa.png',
    ],
    [
        'id'       => 4,
        'name'     => 'Pantai Romodong',
        'location' => 'Belinyu',
        'category' => 'pantai',
        'img'      => 'assets/img/pantai_remodong.png',
    ],
    [
        'id'       => 5,
        'name'     => 'Pantai Teluk Uber',
        'location' => 'Sungailiat',
        'category' => 'pantai',
        'img'      => 'assets/img/pantai_remodong.png',
    ],
    [
        'id'       => 6,
        'name'     => 'Pantai Matras',
        'location' => 'Sungailiat',
        'category' => 'pantai',
        'img'      => 'assets/img/pantai_remodong.png',
    ],
    [
        'id'       => 7,
        'name'     => 'Pulau Putri',
        'location' => 'Bangka Barat',
        'category' => 'pulau',
        'img'      => 'assets/img/pulau_gelasa.png',
    ],
    [
        'id'       => 8,
        'name'     => 'Situs Benteng Toboali',
        'location' => 'Toboali',
        'category' => 'sejarah',
        'img'      => 'assets/img/pagoda_nusantara.png',
    ],
];

// Filter berdasarkan kategori
if ($category !== 'all') {
    $all = array_values(array_filter($all, fn($d) => $d['category'] === $category));
}

// Limit jumlah hasil jika diminta
if ($limit > 0) {
    $all = array_slice($all, 0, $limit);
}

echo json_encode(['status' => 'ok', 'data' => $all]);
