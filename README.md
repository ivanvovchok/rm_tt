CREATE DATABASE auth_service CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

mysql -h 127.0.0.1 -u root -p auth_service < database/migrations/create_users_table.sql
