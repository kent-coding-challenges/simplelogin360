<p><img src="http://simplelogin360.kendtimothy.com/logo.jpg" height="60"></p>

## About Simple Login 360

A coding test challenge which aims to implement Login and User Management CRUD modules using PHP with Laravel Framework.

## Live Demo

You can access the [live demo here](http://simplelogin360.kendtimothy.com).

## Technology

- PHP 7.1 with Laravel 5.4
- MySQL for database storage
- Redis for auth session storage (configurable)
- Web Server: Apache
- Demo Server: Ubuntu 16.04 (.t2 micro instance on AWS)

## Data Access Layer (DAL)

Data access is implemented with the help of
<a href="https://laravel.com/docs/5.4/eloquent">Eloquent</a>,
an ORM framework that enables us to interact with our database objects using PHP Models and Methods instead of raw SQL queries.

To prevent our controllers from being tightly coupled to the data access layer, we create a repository which handles our application's database interaction with Eloquent. Each controller now communicates with repositories to read / write data by having the relevant repository registered with Dependency Injection. In our project, we have UsersController, which communicates with our DbUserRepository to read, create, update, and delete user data.

### Interface for User Repository

Following are the interface contracts registered for our User Repository.

```php
interface UserRepositoryInterface {
    public function count();
    public function getAll();
    public function search($query);
    public function find($id);
    public function store($user);
    public function update($id, $user);
    public function updatePassword($id, $old_password, $new_password);
    public function destroy($id);
}
```

## Authentication Layer

Authentication layer is done using standard Laravel Auth mechanism,
allowing users to log in with email and password based authentication.
For secure password storage, all passwords are hashed using 
<a href="https://laravel.com/docs/5.4/hashing">bcrypt algorithm</a>.

### User Session Handling

Following are the settings configured in the demo server.

- Session is configured on local Redis server (configurable from the .env file)
- Default timeout: 120 minutes

## Testing Strategy

We will adopt two test strategies for this project: Unit and Feature (Integration) Tests. Each communication to database is wrapper inside its own transaction to ensure that one test case doesn't affect the others.

### Unit Test

#### /tests/Unit/DbUserRepositoryTest.php

Unit tests are written for the User Repository. Each test case aims to ensure that the methods within our repository do what it's stupposed to do - retrieving, searching, storing, updating, and deleting data.

### Feature / Integration Test

#### tests/Feature/AuthenticationTest.php

Additionally, we write Feature Test to validate our Authentication layer; ensuring authenticated users are redirected to login page and authenticated (logged in) users are able to access the application.