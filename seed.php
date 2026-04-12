<?php
// Seed test data into the database
try {
  $host = 'localhost';
  $dbname = 'wasafat_db';
  $user = 'root';
  $pass = '';
  
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Reset tables
  $pdo->exec('SET FOREIGN_KEY_CHECKS=0');
  $pdo->exec('TRUNCATE TABLE favorites');
  $pdo->exec('TRUNCATE TABLE recipes');
  $pdo->exec('TRUNCATE TABLE categories');
  $pdo->exec('TRUNCATE TABLE users');
  $pdo->exec('SET FOREIGN_KEY_CHECKS=1');

  echo "Tables reset. ";

  // Seed users
  $users = [
    ['name' => 'Alice Chef', 'email' => 'alice@example.com', 'password' => 'test123'],
    ['name' => 'Bob Baker', 'email' => 'bob@example.com', 'password' => 'test1234']
  ];
  
  $userIds = [];
  foreach ($users as $i => $u) {
    $pw = password_hash($u['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :pwd, NOW())");
    $stmt->execute(['name' => $u['name'], 'email' => $u['email'], 'pwd' => $pw]);
    $userIds[] = $pdo->lastInsertId();
  }
  
  echo "Users created. ";

  // Seed categories
  $categories = [
    ['name' => 'Tagines', 'description' => 'Slow-cooked Moroccan stews', 'user_id' => $userIds[0]],
    ['name' => 'Desserts', 'description' => 'Sweet Moroccan treats', 'user_id' => $userIds[0]],
    ['name' => 'Couscous', 'description' => 'Traditional semolina dish', 'user_id' => $userIds[1]]
  ];
  
  $catIds = [];
  foreach ($categories as $cat) {
    $stmt = $pdo->prepare("INSERT INTO categories (name, description, user_id, created_at) VALUES (:name, :desc, :uid, NOW())");
    $stmt->execute(['name' => $cat['name'], 'desc' => $cat['description'], 'uid' => $cat['user_id']]);
    $catIds[] = $pdo->lastInsertId();
  }
  
  echo "Categories created. ";

  // Seed recipes
  $recipes = [
    [
      'name' => 'Lamb Tagine',
      'description' => 'Aromatic lamb with dried apricots and almonds',
      'user_id' => $userIds[0],
      'category_id' => $catIds[0],
      'preparation_time' => 20,
      'cooking_time' => 120,
      'difficulty' => 'Easy',
      'ingredients' => "1 kg lamb shoulder\n2 onions, chopped\n1 tsp cinnamon\n0.5 cup dried apricots\n0.5 cup almonds\nFresh cilantro",
      'instructions' => "Season lamb with salt, pepper, and cinnamon.\nBrown in olive oil.\nAdd onions and cook until soft.\nAdd broth and simmer for 1 hour.\nAdd apricots and almonds.\nCook for another hour until tender.\nGarnish with cilantro."
    ],
    [
      'name' => 'Couscous with Vegetables',
      'description' => 'Classic Moroccan couscous with seven vegetables',
      'user_id' => $userIds[1],
      'category_id' => $catIds[2],
      'preparation_time' => 15,
      'cooking_time' => 30,
      'difficulty' => 'Medium',
      'ingredients' => "2 cups couscous\n1 carrot, sliced\n1 zucchini, sliced\n1 onion, chopped\n1 tsp turmeric\n2 tbsp olive oil",
      'instructions' => "Steam vegetables with turmeric for 20 minutes.\nToast couscous in olive oil.\nAdd steamed vegetables.\nMix well and serve."
    ],
    [
      'name' => 'Baklava',
      'description' => 'Sweet pastry with honey and pistachios',
      'user_id' => $userIds[0],
      'category_id' => $catIds[1],
      'preparation_time' => 30,
      'cooking_time' => 45,
      'difficulty' => 'Hard',
      'ingredients' => "1 pack phyllo dough\n1 cup pistachios, crushed\n0.5 cup butter\n0.5 cup honey\n1 tsp cinnamon",
      'instructions' => "Layer phyllo in a baking dish.\nSprinkle pistachios and cinnamon between layers.\nBake at 180C for 40 minutes.\nDrizzle with honey.\nLet cool and serve."
    ],
    [
      'name' => 'Harira',
      'description' => 'Traditional lentil and chickpea soup',
      'user_id' => $userIds[1],
      'category_id' => $catIds[0],
      'preparation_time' => 15,
      'cooking_time' => 60,
      'difficulty' => 'Easy',
      'ingredients' => "1 cup lentils\n1 can chickpeas\n1 onion, diced\n2 tomatoes, crushed\n1 tsp ginger\nFresh cilantro",
      'instructions' => "Sauté onion and tomatoes.\nAdd lentils, chickpeas, and ginger.\nSimmer for 45 minutes.\nGarnish with cilantro.\nServe with bread."
    ]
  ];
  
  foreach ($recipes as $r) {
    $stmt = $pdo->prepare("INSERT INTO recipes (name, description, user_id, category_id, preparation_time, cooking_time, difficulty, ingredients, instructions, image_url, created_at) VALUES (:name, :desc, :uid, :cid, :pt, :ct, :diff, :ing, :ins, '', NOW())");
    $stmt->execute([
      'name' => $r['name'],
      'desc' => $r['description'],
      'uid' => $r['user_id'],
      'cid' => $r['category_id'],
      'pt' => $r['preparation_time'],
      'ct' => $r['cooking_time'],
      'diff' => $r['difficulty'],
      'ing' => $r['ingredients'],
      'ins' => $r['instructions']
    ]);
  }
  
  echo "Recipes created. ";

  // Seed a favorite
  $stmt = $pdo->prepare("SELECT id FROM recipes WHERE name = :n");
  $stmt->execute(['n' => 'Lamb Tagine']);
  $recipeId = $stmt->fetchColumn();
  
  $stmt = $pdo->prepare("INSERT INTO favorites (user_id, recipe_id, created_at) VALUES (:u, :r, NOW())");
  $stmt->execute([$userIds[0], $recipeId]);

  echo "Favorite created.\n";
  echo "SEED COMPLETE! You can now test the app.\n";
  echo "Login with: alice@example.com / test123\n";

} catch (Exception $e) {
  echo 'Seed error: ' . $e->getMessage();
}