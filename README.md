## Secure Screening Services ticketing system

This application allows for the automated processing of tickets

### Basic steps to set up

- Set up your .env (see .env settings section below)
- Install the required libraries: `composer install`
- Generate Laravel key: `php artisan key:generate`
- Run the migrations and seeder: `php artisan migrate --seed`
- Install Node dependencies: `npm install`
- Setup an account with Pusher and Mailgun to get the keys to store in .env

### .env

- APP_NAME="SSS Ticketing System"
- APP_URL

- DB_CONNECTION
- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

- BROADCAST_DRIVER=pusher
- PUSHER_APP_ID
- PUSHER_APP_KEY
- PUSHER_APP_SECRET
- PUSHER_HOST=null
- PUSHER_PORT=443
- PUSHER_SCHEME=https
- PUSHER_APP_CLUSTER=eu

- MAIL_MAILER=mailgun
- MAIL_FROM_ADDRESS
- MAIL_FROM_NAME
- MAILGUN_DOMAIN
- MAILGUN_SECRET

- VITE_API_URL="${APP_NAME}/api"
- VITE_APP_NAME=`"${APP_NAME}"`
- VITE_PUSHER_APP_KEY=`"${PUSHER_APP_KEY}"`
- VITE_PUSHER_APP_CLUSTER=`"${PUSHER_APP_CLUSTER}"`
