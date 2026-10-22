<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page_title = isset($page_title) ? $page_title : 'WisataKite';
$css_file = isset($css_file) ? $css_file : 'style.css';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WisataKite - Temukan destinasi wisata terbaik di Bangka Belitung">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/<?php echo htmlspecialchars($css_file); ?>">
</head>
<body<?php echo isset($body_class) ? ' class="'.htmlspecialchars($body_class).'"' : ''; ?>>
