![Symfony Concepts 2](./public/images/banner.png)

### Topics Explored

* Doctrine Relationships
* Symfony Security (Authentication & Authorization)
* Symfony Forms
* Doctrine Queries
* Symfony Bundle

### How to Set up and run the Application
```bash
# Copy Config
# Feel free to update values in .env file as needed
cp ./.env.dist ./.env

DATABASE_URL="mysql://root:root@127.0.0.1:3306/symfony_concepts_2"

# Install php dependencies
composer update

# Create Database
php bin/console make:database

# Migrate data to database
php bin/console doctrine:migrations:migrate

# Update Database with Dummy Data
php bin/console doctrine:fixtures:load

# Serve Application
symfony server:start
```