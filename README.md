# home_hazard_map
utilize hazard map on google map for searching your ideal home location

# Prerequisites
- installed php for your backend
  - enable `extension=mysqli` at your php.ini file
- installed or prepared your MySQL DB
- Need Google MAP API Key enable.

# How to Jump Start
1. Create Database by running `create-table.sql` under ddl folder.
1. Open command prompt and locate to `mapservice` folder.
1. Start php server by executing:
```
php -S localhost:8080
```
1. Open blowser and load `http://localhost:8080/index.html`.

# Configuration
- Replace your MAP API key with <YOUR_GOOGLE_MAP_API_KEY> at `index.html`.
- Database configuration at `db_config.php`.
