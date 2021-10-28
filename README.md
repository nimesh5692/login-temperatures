# Users Geolocation and Weather History

> ### A simple application to track users login locations and weather history

Users can register on the platform. Upon logging in to the platform, users geolocation and current temperature of the location will be stored.
On the dashboard, each user can see a history of their logins, geolocations and what the weather was like each time they logged in.

----------

# Getting started

## Installation

Clone the repository

    git clone https://github.com/nimesh5692/login-temperatures.git

Switch to the repo folder

    cd login-temperatures

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
    
Set the database connection details in .env and run the database migrations

    php artisan migrate
	
Install node modules

    npm install

Compile the assets

    npm run dev

Start the local development server

    php artisan serve
	

You can now access the server at http://localhost:8000

## Database

A sqlite database under the name *database.sqlite* is included in the database directory.

.env will be confugured to use this by default, but you can use any other database you prefer. Make sure to include the correct configuration in the .env

----------

# Code overview

## Dependencies

**None**

## Important Files and Folders

- `app/Models` - Contains all the Eloquent models
- `app/Http/Controllers` - Contains all the controllers
- `app/Providers` - Contains all service provider classes
- `app/Listeners` - Contains all event listeners
- `config/cities.php` - Contains the data of the cities
- `database/migrations` - Contains all the database migrations
- `database/database.sqlite` - Database
- `routes/web.php` - Contains all routes
- `resources/views` - Includes the blade views
- `resources/js` - Includes all the js assets of the application

## Environment variables

- `.env` - Environment variables for the application

----------

# Application Functionality

Run the development server

    php artisan serve

The application will open in the login window. Registered users can login from here.
If users are unregistered, they can navigate to the register menu using the link provided in the navigation and register with the platform.
Uporn registration users will be automatically logged in.
Logged in users will be navigated to the dashboard.

On the login event usres' location will be picked.
*Location will be randomized from the locations included in the `cities.php` in `config`*
*Each location array consists of the city's name, longitude and latitude*

Using the location data, weather information will be picked from the OpenWeatherMap API (`https://openweathermap.org/`)

Temperature data fetched from OpenWeatherMap and the geolocation will be saved in the database along with the logged in time.

The a history of login locations, temperatures (both in celsius and fahrenheit) and the logged in times will be displayed for the logged in users on their dashboard.

----------