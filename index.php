<?php
// Start session at the very top
session_start();

// Include init.php safely
$initPath = __DIR__ . '/config/init.php';
if (!file_exists($initPath)) {
    die("Error: init.php not found at $initPath");
}
include_once $initPath;

// Include the consistent header
include_once 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>NovelNest & Stationery Hub</title>
</head>

<body>



<section class="hero">
    <div class="hero-card">
        <h1>Read. Write. Create.</h1>
        <p>Your one-stop stationery and book shop!</p>
        <a href="products.php" class="shop-btn">Shop Now</a>
    </div>
</section>

<section class="categories" id="categories">
    <!-- NOVELS -->
    <a href="products.php?category=novels" style="text-decoration: none; color: inherit;">
    <div class="category-card">
        <img src="images/novels/thriller/The_Gift.jpeg" alt="Novels">
        <h3>Novels</h3>
        <p>Discover amazing stories across all genres</p>
        <div class="sub-btn-container">
                    <a href="products.php?category=novels&sub=Fantasy" class="sub-btn">Fantasy</a>
                    <a href="products.php?category=novels&sub=Fiction" class="sub-btn">Fiction</a>
                    <a href="products.php?category=novels&sub=Mystery" class="sub-btn">Mystery</a>
                    <a href="products.php?category=novels&sub=Romance" class="sub-btn">Romance</a>
                    <a href="products.php?category=novels&sub=Thriller" class="sub-btn">Thriller</a>
                    <a href="products.php?category=novels&sub=Nonfiction" class="sub-btn">Non-Fiction</a>
                </div>
                <a href="products.php?category=novels" class="view-btn">View All Novels</a>
            </div>
        </a>
        
        <!-- OFFICE & SCHOOL -->
        <a href="products.php?category=office_school" style="text-decoration: none; color: inherit;">
            <div class="category-card">
                <img src="images/office_school_supplies/measuringtools_deskitems/Desk_Organizer.jpeg" alt="Office & School">
                <h3>Office & School</h3>
                <p>Everything you need for work and study</p>
                <div class="sub-btn-container">
                    <a href="products.php?category=office_school&sub=Books & Paper" class="sub-btn">Books & Paper</a>
                    <a href="products.php?category=office_school&sub=Measuring & Desk" class="sub-btn">Measuring & Desk</a>
                    <a href="products.php?category=office_school&sub=Writing" class="sub-btn">Writing</a>
                </div>
                <a href="products.php?category=office_school" class="view-btn">View All Office & School</a>
            </div>
        </a>
    <!-- ART SUPPLIES -->
    <div class="category-card">
        <img src="images/art_supplies/painting/marker_set.jpeg" alt="Art Supplies">
        <h3>Art Supplies</h3>
        <p>Unleash your creativity</p>
        <div class="sub-btn-container">
            <a href="products.php?category=art_supplies&sub=Drawing" class="sub-btn">Drawing</a>
            <a href="products.php?category=art_supplies&sub=Painting" class="sub-btn">Painting</a>
        </div>
        <a href="products.php?category=art_supplies" class="view-btn">View All Art Supplies</a>
    </div>
</section>

<section class="why-choose">
    <h2>Why Choose Us?</h2>
    <div class="why-choose-cards">
        <div class="why-card"><h3>Wide Selection</h3><p>Hundreds of products.</p></div>
        <div class="why-card"><h3>Quality Products</h3><p>Trusted brands only.</p></div>
        <div class="why-card"><h3>Fast Delivery</h3><p>Quick to your door.</p></div>
        <div class="why-card"><h3>Best Service</h3><p>Customer satisfaction first.</p></div>
    </div>
</section>

<section class="contact">
    <h2>Contact Us</h2>
    <p>📍 Nairobi, Kenya</p>
    <p>📞 +254 712 345 678</p>
    <p>📧 novelnest@gmail.com</p>
</section>

<footer>
    &copy; 2026 NovelNest & Stationery Hub. All rights reserved.
</footer>

</body>
</html>
