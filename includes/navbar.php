<?php
// includes/navbar.php
$current_page = isset($current_page) ? $current_page : 'home';
?>
<!-- Navbar -->
<header class="header" role="banner">
    <h1><a href="index.php">WisataKite</a></h1>

    <!-- Desktop nav -->
    <nav class="nav" aria-label="Navigasi utama">
        <a href="index.php" class="<?php echo $current_page === 'home' ? 'active' : ''; ?>">Home</a>
        <a href="news.php"  class="<?php echo $current_page === 'news' ? 'active' : ''; ?>">News</a>
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            $uname = htmlspecialchars($_SESSION['username'] ?? 'Akun');
            echo "<a href=\"#\" id=\"guest-btn\" aria-haspopup=\"true\" aria-expanded=\"false\">👤 $uname</a>";
        } else {
            echo '<a href="#" id="guest-btn" aria-haspopup="true" aria-expanded="false">👤 Guest</a>';
        }
        ?>
    </nav>

    <!-- Hamburger (mobile) -->
    <button class="hamburger" id="hamburger-btn" aria-label="Buka menu" aria-controls="mobile-nav">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>

<!-- Mobile nav overlay -->
<div class="nav-overlay" id="nav-overlay" aria-hidden="true"></div>

<!-- Mobile nav drawer -->
<nav class="mobile-nav" id="mobile-nav" aria-label="Navigasi mobile">
    <a href="index.php" class="<?php echo $current_page === 'home' ? 'active' : ''; ?>">🏠 Home</a>
    <a href="news.php"  class="<?php echo $current_page === 'news' ? 'active' : ''; ?>">📰 News</a>
    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        $uname = htmlspecialchars($_SESSION['username'] ?? 'Akun');
        echo "<a href=\"#\" class=\"mobile-guest-btn\">👤 $uname</a>";
    } else {
        echo '<a href="#" class="mobile-guest-btn">👤 Guest</a>';
    }
    ?>
    <a href="login.php">🔐 Masuk</a>
</nav>

<!-- Sidebar backdrop -->
<div class="sidebar-overlay" id="sidebar-overlay" aria-hidden="true"></div>
