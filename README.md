## Step to run web app

- copy the project folder into your local folder

- make sure .env file is present and modify value "DB_DATABASE" and "APP_URL"(to make sure spatie image get displayed correctly) according to your local configuration

- run "composer install"

- run "php artisan migrate"

- run "php artisan storage:link"

- run "npm install && npm run dev"

- serve application in local server

- go to application "/" url path

- done.

## Functionality

- Movie listing will display movie's name, year, producer and actors

- Add new movie

- View/Edit movie

- View/Add producer/actor

- Delete movie

## Custom validation using rule

- (Story)Adding existing celebrity into a movie -> (Rule)Check if celebrity is already an actor/producer of the movie. Return false if model already existed.

- (Story)Adding existing/new celebrity into a movie -> (Rule)Check if a producer is already exist for the movie. Return false if producer existed.