#Klaviyo Test

###Installation:
1. Clone repository
2. Create schema in database
3. Configure our .env from .env.example
    1. In DB_DATABASE = put the name of the created schema
    2. In DB_USERNAME = put our mysql user (by default it is root)
    3. In DB_PASSWORD = put our mysql user password (by default it does not have)
4. Run the 'composer install' command
5. Run the command 'php artisan key: generate'
6. Run: php artisan migrate
7. Run: npm install
8. Run: npm run dev
