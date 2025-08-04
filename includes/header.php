<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo SITE_DESCRIPTION; ?>">
    <meta name="keywords" content="sarkari result, government jobs, admit card, exam results, answer key, sarkari naukri">
    <meta name="author" content="Sarkari Result">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-content">
                    <div class="contact-info">
                        <span><i class="fas fa-envelope"></i> info@sarkariresult.com.cm</span>
                        <span><i class="fas fa-phone"></i> +91-XXXXXXXXXX</span>
                    </div>
                    <div class="social-links">
                        <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" aria-label="Telegram"><i class="fab fa-telegram"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="main-header">
            <div class="container">
                <div class="header-content">
                    <div class="logo">
                        <a href="index.php">
                            <h1>SARKARI RESULT</h1>
                            <span>SarkariResult.com.cm</span>
                        </a>
                    </div>
                    
                    <div class="header-actions">
                        <div class="search-box-header">
                            <form action="search.php" method="GET">
                                <input type="text" name="query" placeholder="Search..." class="search-input">
                                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <div class="mobile-menu-toggle">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="navigation">
            <div class="container">
                <ul class="nav-menu">
                    <?php foreach($nav_menu as $title => $url): ?>
                        <li><a href="<?php echo $url; ?>" <?php echo (basename($_SERVER['PHP_SELF']) == $url) ? 'class="active"' : ''; ?>><?php echo $title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Breadcrumb -->
    <?php if(isset($breadcrumb) && !empty($breadcrumb)): ?>
    <div class="breadcrumb">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb-list">
                    <li><a href="index.php">Home</a></li>
                    <?php foreach($breadcrumb as $title => $url): ?>
                        <?php if($url): ?>
                            <li><a href="<?php echo $url; ?>"><?php echo $title; ?></a></li>
                        <?php else: ?>
                            <li class="active"><?php echo $title; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </nav>
        </div>
    </div>
    <?php endif; ?>
