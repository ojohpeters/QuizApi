<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# Quiz API

A Laravel-based API for managing quizzes, questions, and answers, allowing users to participate in quizzes and view their results.

---

## Features
- **User Authentication**: Register and log in with JWT.
- **Quiz Management**: Create, update, and delete quizzes.
- **Question Management**: Add, update, and delete questions with answers.
- **Quiz Participation**: Submit answers and calculate scores.
- **Results Viewing**: View quiz results for individual users.

---

## Requirements
- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Laravel >= 9.x
- Postman or cURL (for API testing)

---

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/quiz-api.git
cd quiz-api
```

### 2. Configure Environment
- Copy the `.env.example` file to `.env`:
  ```bash
  cp .env.example .env
  ```
- Update the following variables in the `.env` file:
  ```env
  APP_NAME=QuizAPI
  APP_URL=http://localhost

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=quiz_api
  DB_USERNAME=root
  DB_PASSWORD=yourpassword
  ```

### 3. Set Up the Database
Run migrations to set up the database schema:
```bash
php artisan migrate
```

### 4. Run the Application
Start the Laravel development server:
```bash
php artisan serve
```
The API will be available at: [http://localhost:8000](http://localhost:8000).

---

## API Endpoints

### Authentication
#### **Register**
```http
POST /register
```
**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```
**Response:**
```json
{
  "token": "your-jwt-token",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john.doe@example.com"
  }
}
```

#### **Login**
```http
POST /login
```
**Request Body:**
```json
{
  "email": "john.doe@example.com",
  "password": "password123"
}
```
**Response:**
```json
{
  "token": "your-jwt-token"
}
```
Use the token from the response in the `Authorization` header for all subsequent requests:
```
Authorization: Bearer <your-jwt-token>
```

---

### Quizzes
#### **Create a Quiz**
```http
POST /quizzes
```
**Request Body:**
```json
{
  "title": "General Knowledge Quiz"
}
```

#### **Fetch All Quizzes**
```http
GET /quizzes
```

#### **Fetch a Single Quiz**
```http
GET /quizzes/{quizId}
```

#### **Update a Quiz**
```http
PUT /quizzes/{quizId}
```
**Request Body:**
```json
{
  "title": "Updated Quiz Title"
}
```

#### **Delete a Quiz**
```http
DELETE /quizzes/{quizId}
```

---

### Questions
#### **Add a Question to a Quiz**
```http
POST /quizzes/{quizId}/questions
```
**Request Body:**
```json
{
  "question_text": "What is the capital of France?",
  "answers": [
    { "answer_text": "Paris", "is_correct": true },
    { "answer_text": "London", "is_correct": false },
    { "answer_text": "Berlin", "is_correct": false },
    { "answer_text": "Madrid", "is_correct": false }
  ]
}
```

#### **Update a Question**
```http
PUT /questions/{questionId}
```
**Request Body:**
```json
{
  "question_text": "What is the largest planet?",
  "answers": [
    { "answer_text": "Jupiter", "is_correct": true },
    { "answer_text": "Earth", "is_correct": false }
  ]
}
```

#### **Delete a Question**
```http
DELETE /questions/{questionId}
```

---

### Attempting a Quiz
#### **Submit Quiz Answers**
```http
POST /quizzes/{quizId}/results
```
**Request Body:**
```json
{
  "answers": [
    { "question_id": 1, "answer_id": 1 },
    { "question_id": 2, "answer_id": 5 }
  ]
}
```
**Response:**
```json
{
  "error": false,
  "result": {
    "id": 1,
    "user_id": 1,
    "quiz_id": 1,
    "score": 2
  }
}
```

#### **View User's Results**
```http
GET /results
```

---

## License
The Quiz API is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
