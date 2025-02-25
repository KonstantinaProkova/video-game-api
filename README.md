# Simple Video Game Management System API

## Overview
The **Simple Video Game Management System API** allows users to manage a collection of video games, including adding, updating, deleting, and retrieving game information.

## Features
- Authentication system
- Add new video games
- List all available games
- Update game information
- Delete games

## Technologies Used
- PHP (Laravel)
- MySQL
- RESTful API principles


## Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/KonstantinaProkova/video-game-api
   ```
2. Navigate to the project directory:
   ```sh
   cd video-game-api
   ```
3. Install dependencies:
   ```sh
   composer install
   ```
4. Set up environment variables:
    - Create a `.env` file in the root directory (you can copy the `.env.example`).
    - Adjust the following variables:
      ```env
      DB_USERNAME=your_db_username_here
      DB_PASSWORD=your_db_password_here
      DB_DATABASE=your_db_name_here
      SESSION_DRIVER=COOKIE (this is important. Authentication needs cookies)
      SESSION_SECURE_COOKIE=false (this needs to be done due to local dev environment)
      SANCTUM_STATEFUL_DOMAINS=127.0.0.1,localhost (or any other IP used in your local development environment)
      ```

5. Set up Laravel APP_KEY:
    ```sh
   php artisan key:generate
    ```

6. Run the migrations:
    ```sh
   php artisan migrate
    ```

7. Seed the database:
   ```sh
   php artisan db:seed
   ```

## Usage
1. Start the server:
   ```sh
   php artisan serve
   ```
2. The API will be available at `http://localhost:8000`



## Auth API Endpoints
### 1. Register
   ```http
   POST /api/register
   ```
### 2. Login
   ```http
   POST /api/login
   ```
### 3. Logout
   ```http
   POST /api/logout
   ```

## Game API Endpoints
### 1. Get User Games
   ```http
   GET /api/games
   ```
- Response: List of all video games

### 2. Add a New Game
   ```http
   POST /api/games
   ```
- Response: Added game details

### 3. Update a Game
   ```http
   PUT /api/games/:id
   ```
- Response: Updated game details

### 4. Delete a Game
   ```http
   DELETE /api/games/:id
   ```
- Response: Confirmation message with last snapshot of the game

#### In depth documentation for each route can be found inside the postman collection. Please import the ```Game API.postman_collection.json``` in your Postman installation.


## My comments on the project

### About authentication system

After some research, I found that one of the possible solutions to authenticate in an API system is by forcing a
cookie that is used by the consumer application in order to save the current session on the client level. Sanctum
offers this functionality by setting up the ``SESSION_DRIVER`` env variable to ``cookie`` and setting up
the ``SANCTUM_STATEFUL_DOMAINS``.

### About the API structure

One of the different ways to implement an API that I found on the Internet, is by using the CRUD system. This is what
I tried to apply on the ```/api/game/``` routes. The model can be managed with 4 different actions (Create, Read, Update
and Delete) using the appropriate methods (``POST``, ``GET``, ``PUT``, ``DELETE``).

Lastly I tried to send the correct status code(s) regarding each route response. For example, each creation returns a ``201``
response while routes that are protected (and you don't have permission on them), return a ``401`` response.
