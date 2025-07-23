# Auth service

## Setup
### 1. Clone the repository:

```bash
git clone git@github.com:ivanvovchok/rm_tt.git
cd rm_tt
```

### 2. Create an .env file:
```bash
cp .env.example .env
```

### 3. Create the database:
```bash
CREATE DATABASE auth_service CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Run the migrations:
```bash
mysql -h 127.0.0.1 -u root -p auth_service < database/migrations/create_users_table.sql
```

### 5. Install dependencies:
```bash
composer install
```

### 6. Start the app:
```bash
composer start
```

### Additional commands:
```bash
composer phpstan   # Runs static analysis
composer fix       # Fixes styles
composer test      # Runs tests 
```