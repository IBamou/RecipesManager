# Wasafat - Moroccan Recipe Manager

A beautiful Moroccan recipe management web application built with PHP.

![Wasafat Banner](https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&auto=format&fit=crop&q=80)

## Features

- **Recipe Management** - Create, edit, and delete your favorite Moroccan recipes
- **Categories** - Organize recipes by category (Tajines, Couscous, Pastilla, etc.)
- **Discovery** - Browse recipes from other cooks in the community
- **Favorites** - Save recipes you love to your collection
- **User Profiles** - Share your culinary journey with bio and birthday
- **Search** - Find recipes quickly across My Recipes, Favorites, and Categories

## Tech Stack

- **Backend**: PHP (Vanilla MVC)
- **Database**: MySQL
- **Frontend**: HTML, CSS (Custom Moroccan-themed design)
- **Icons**: Font Awesome 6

## Getting Started

### Prerequisites

- PHP 7.4+
- MySQL 5.7+
- XAMPP / WAMP / MAMP

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/IBamou/RecipesManager.git
   ```

2. Start Apache and MySQL in XAMPP

3. Create the database:
   ```bash
   mysql -u root -p < app/Configs/query.sql
   ```

   Or import `query.sql` via phpMyAdmin

4. Configure database connection in `app/Configs/Database.php`

5. Open in browser:
   ```
   http://localhost/recipesManager
   ```

## Database Schema

```
users
├── id (PK)
├── name
├── email (UNIQUE)
├── password
├── bio (TEXT)
├── birthday (DATE)
└── created_at

categories
├── id (PK)
├── name
├── description
├── user_id (FK → users.id)
└── created_at

recipes
├── id (PK)
├── name
├── description
├── user_id (FK → users.id)
├── category_id (FK → categories.id)
├── preparation_time (INT, minutes)
├── cooking_time (INT, minutes)
├── difficulty (ENUM: easy, medium, hard)
├── ingredients (TEXT, newline-separated)
├── instructions (TEXT, newline-separated)
├── image_url
└── created_at

favorites
├── id (PK)
├── user_id (FK → users.id)
├── recipe_id (FK → recipes.id)
└── created_at
```

## Project Structure

```
├── index.php                    # Main entry point
├── .htaccess                   # URL routing
├── app/
│   ├── Configs/
│   │   ├── Database.php        # PDO connection
│   │   └── query.sql          # Database schema
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── CategoryController.php
│   │   ├── DashboardController.php
│   │   ├── FavoriteController.php
│   │   ├── ProfileController.php
│   │   └── RecipeController.php
│   ├── Models/
│   │   ├── CategoryModel.php
│   │   ├── FavoriteModel.php
│   │   ├── RecipeModel.php
│   │   └── UserModel.php
│   └── Views/
│       ├── auth/               # Login, Signup
│       ├── categories/         # Index, Create, Edit, Show
│       ├── dashboard/          # Dashboard
│       ├── errors/             # 404
│       ├── favorites/          # Favorites list
│       ├── layouts/            # Header, Footer
│       ├── profile/            # Profile
│       └── recipes/            # Index, Create, Edit, Show, Discover
└── public/
    └── css/
        └── style.css           # Main stylesheet
```

## Routes

| Route | Description | Auth Required |
|-------|-------------|--------------|
| `/` | Home/Landing | No |
| `/auth/login` | Login | No (redirects if logged in) |
| `/auth/signup` | Signup | No (redirects if logged in) |
| `/dashboard` | User dashboard | Yes |
| `/profile` | User profile | Yes |
| `/profile/update` | Update profile | Yes |
| `/categories` | My categories | Yes |
| `/categories/create` | New category | Yes |
| `/categories/edit` | Edit category | Yes |
| `/categories/show` | Category recipes | Yes |
| `/recipes` | My recipes | Yes |
| `/recipes/create` | New recipe | Yes |
| `/recipes/edit` | Edit recipe | Yes |
| `/recipes/show` | Recipe details | Yes |
| `/discover` | Discover recipes | Yes |
| `/favorites` | My favorites | Yes |
| `/favorites/toggle` | Toggle favorite | Yes |

## Moroccan Theme

- **Colors**: Gold (#C9973A), Cream (#FDF6E3), Deep brown (#2C2416)
- **Fonts**: Playfair Display (headings), system-ui (body)
- **Icons**: Flame, utensils, Tajine, spice-themed
- **Background**: Subtle Moroccan pattern or food photography

## License

MIT

---

Wasafat — Crafted with spice & code.