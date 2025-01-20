<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# QuizApi

# Quiz API

A Laravel-based Quiz API to manage quizzes, questions, and answers, as well as allow users to take quizzes and view their results.

---

## **Features**
- User registration and login with JWT authentication.
- CRUD operations for quizzes, questions, and answers.
- Submit quiz answers and calculate scores.
- View quiz results for users.

---

## **Requirements**
- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Laravel >= 9.x
- Postman or cURL (for API testing)

---

## **Installation**

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/quiz-api.git
cd quiz-api
Configure Environment

    Copy the .env.example file to .env
    Update the following environment variables in the .env file

Set Up Database
APP_NAME=QuizAPI
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quiz_api
DB_USERNAME=root
DB_PASSWORD=yourpassword
Run Migrations
    php artisan migrate

Usage
1. Run the Application

Start the Laravel development server:

php artisan serve

The API will be available at: http://localhost:8000
2. API Endpoints
Authentication

    Register

POST /register

Request Body:

{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}

Response:

{
    "token": "your-jwt-token",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john.doe@example.com"
    }
}

Login

POST /login

Request Body:

{
    "email": "john.doe@example.com",
    "password": "password123"
}

Response:

    {
        "token": "your-jwt-token"
    }

Use the token from the response in the Authorization header for all subsequent requests:

Authorization: Bearer <your-jwt-token>

Quizzes

    Create a Quiz

POST /quizzes

Request Body:

{
    "title": "General Knowledge Quiz"
}

Fetch All Quizzes

GET /quizzes

Fetch a Single Quiz

GET /quizzes/{quizId}

Update a Quiz

PUT /quizzes/{quizId}

Request Body:

{
    "title": "Updated Quiz Title"
}

Delete a Quiz

    DELETE /quizzes/{quizId}

Questions

    Add a Question to a Quiz

POST /quizzes/{quizId}/questions

Request Body:

{
    "question_text": "What is the capital of France?",
    "answers": [
        { "answer_text": "Paris", "is_correct": true },
        { "answer_text": "London", "is_correct": false },
        { "answer_text": "Berlin", "is_correct": false },
        { "answer_text": "Madrid", "is_correct": false }
    ]
}

Update a Question

PUT /questions/{questionId}

Request Body:

{
    "question_text": "What is the largest planet?",
    "answers": [
        { "answer_text": "Jupiter", "is_correct": true },
        { "answer_text": "Earth", "is_correct": false }
    ]
}

Delete a Question

    DELETE /questions/{questionId}

Attempting a Quiz

    Submit Quiz Answers

POST /quizzes/{quizId}/results

Request Body:

{
    "answers": [
        { "question_id": 1, "answer_id": 1 },
        { "question_id": 2, "answer_id": 5 }
    ]
}

Response:

{
    "error": false,
    "result": {
        "id": 1,
        "user_id": 1,
        "quiz_id": 1,
        "score": 2
    }
}

View User's Results

GET /results
