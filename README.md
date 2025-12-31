# Set Up
Prerequisites: Laravel Herd (PHP 8.4+), Composer, Node 18+ (for front-end or Vite), MySQL or SQLite.
Quick start (Laravel):
* cd Herd
* git clone https://github.com/zrreid-pro/preborn-option-a.git
* cp .env.example .env
    * (adjust .env as needed)

Change the .env APP_URL to http://preborn-option-a.test
* composer install
* php artisan key:generate
* php artisan migrate
* php artisan db:seed
* npm install

This will build the front-end assets, so vite does not have to be running:  
* npm run build

# To Run
* composer run dev

# Notes
Forms for the creation POST routes have been included.
Submitting the forms redirects to a view that runs a GET all route so the results can be seen.

All other routes can be tested using Postman while the server is running.
To use a WRITE route in Postman, you need to first run the '/token' route for the token and then include that token in the header under the key value: X-CSRF-TOKEN.
I have made it easier so you only have to set the collection variable called "Session-Token" to the value of the token and all routes that need it will have it.

Everything has been given appropriately descriptive names in Postman.
Every test but the Sanctum one can be run in Postman however the Get All and Store POST routes will return webpages since they are used in the project.

Form values are validated on the Backend but not as much the Frontend since this is Backend focused.
I chose not to validate more heavily on the Frontend to save time.
