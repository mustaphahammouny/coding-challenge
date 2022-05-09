<h1 align="center">
    Coding Challenge Software Engineer application
</h1>

## Installation

* Import the project from github :<br/>
  `git clone https://github.com/mustaphahammouny/coding-challenge.git`


* Navigate to the project folder :<br/>
  `cd coding-challenge`


* Install dependencies :<br/>
  `composer install` <br/>
  `npm install`


* Copy the environement file :<br/>
  `cp .env.example .env`<br/>
  then change database information with your values.


* Generate application key :<br/>
  `php artisan key:generate`<br/>


* Run the migration :<br/>
  `php artisan migrate`<br/>
  and Seed the data :<br/>
  `php artisan db:seed`<br/>
  or you can run only this command :<br/>
  `php artisan migrate --seed`


* Run the storage link command :<br/>
  `php artisan storage:link`


* Run npm to generate css & js files :<br/>
  `npm run dev`


* Start the project :<br/>
  `php artisan serve`


* CLI :<br/>
  Category creation command:<br/>
  `php artisan category:create`<br/>
  Category deletion command:<br/>
  `php artisan category:delete`<br/>
  Product creation command:<br/>
  `php artisan product:create`<br/>
  Product deletion command:<br/>
  `php artisan product:delete`
