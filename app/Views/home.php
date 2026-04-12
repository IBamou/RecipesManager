<?php require __DIR__ . '/layouts/header.php'; ?>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <div class="hero-tag"><i class="fas fa-star"></i> Discover Moroccan Cuisine</div>
    <h1>Taste the <em>Magic</em><br>of Morocco</h1>
    <p>Explore, create and share authentic Moroccan recipes with a vibrant community of passionate food lovers.</p>
    <div class="hero-actions">
      <?php if (!isset($_SESSION['user'])): ?>
        <a href="<?php echo BASE_URL; ?>/auth/signup" class="btn btn-gold btn-lg">
          <i class="fas fa-fire-flame-curved"></i> Start Cooking
        </a>
        <a href="<?php echo BASE_URL; ?>/auth/login" class="btn btn-outline btn-lg">
          Login
        </a>
      <?php else: ?>
        <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-gold btn-lg">
          Go to Dashboard <i class="fas fa-arrow-right"></i>
        </a>
        <a href="<?php echo BASE_URL; ?>/discover" class="btn btn-outline btn-lg">
          Explore Recipes
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<div class="stats-bar">
  <div class="stat-item"><div class="num">1,200+</div><div class="lbl">Recipes Shared</div></div>
  <div class="stat-item"><div class="num">5,000+</div><div class="lbl">Members</div></div>
  <div class="stat-item"><div class="num">50+</div><div class="lbl">Categories</div></div>
  <div class="stat-item"><div class="num">100%</div><div class="lbl">Delicious</div></div>
</div>

<!-- FEATURES -->
<section class="features-section">
  <div style="max-width:1100px;margin:0 auto;">
    <div style="text-align:center;margin-bottom:3rem;">
      <div class="section-label">Why join us</div>
      <div class="section-title">A World of Moroccan Flavor</div>
      <p style="color:var(--muted);max-width:500px;margin:0 auto;">From the spice-laden souks of Marrakech to your kitchen table.</p>
    </div>
    <div class="grid grid-3">
      <div class="feature-card fade-up">
        <div class="feature-icon"><i class="fas fa-book-open"></i></div>
        <h3>Rich Recipe Library</h3>
        <p>Thousands of curated Moroccan recipes from tagines to pastilla to harira.</p>
      </div>
      <div class="feature-card fade-up" style="animation-delay:.1s">
        <div class="feature-icon"><i class="fas fa-users"></i></div>
        <h3>Vibrant Community</h3>
        <p>Connect with local chefs, home cooks, and culinary adventurers worldwide.</p>
      </div>
      <div class="feature-card fade-up" style="animation-delay:.2s">
        <div class="feature-icon"><i class="fas fa-gem"></i></div>
        <h3>Step-by-Step Guides</h3>
        <p>Detailed instructions with timing, ingredients, and chef tips to cook like a pro.</p>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>
