# LaraFood
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

The DDD architecture was implemented based on the article written by Brent on October 17, 2019 - [Domain-oriented Laravel](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel) . The following patterns were also used: repository pattern, actions and use cases, data transfer objects. Based on the LaraFood course project - EspecializaTi Academy.

<img src="https://user-images.githubusercontent.com/57726726/178367355-5b2d23be-b4e9-42ad-91d3-f16a30bd5321.png" alt="Larafood" width="100" height="auto">

## Technologies

- [Laravel](https://laravel.com/)
- [Laravel Sail](https://laravel.com/docs/9.x/sail#main-content)
- [PHP Mess Detector](https://phpmd.org/)
- [PHP Copy/Paste Detector](https://github.com/sebastianbergmann/phpcpd)
- [Sentry](https://sentry.io/)
- [Data transfer objects](https://github.com/spatie/data-transfer-object)
- [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE)
- [Pest](https://pestphp.com/)
- [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger)
- [activitylog](https://github.com/spatie/laravel-activitylog)

## Application structure

```
src
  └ Application
  └ Domains
    ├── Domain
    │   └── Actions
    │   └── UseCases
    │   └── DTOs
    │   └── Contracts
    │   └── Enums
    │   └── Exceptions
  └ Infrastructure
    │   └── Persistence
  └ Interfaces
    │   └── Console
    │   └── Http
```

## Installation

1. Clone the project
```bash
  git clone https://github.com/luiz-moura/laravel-movie-app.git
```

2. Create .env
```bash
  cp .env.example .env
```

3. Start the server in background
```bash
  docker-compose up -d
```

4. Create aliases for sail bash path
```bash
  alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

5. Generate key
```bash
  sail artisan key:generate
```

6. Install composer dependencies
```bash
  sail composer install
```

7. Install NPM dependencies
```bash
  sail npm install && sail npm run dev
```

8. Create tables and fill populate with fictitious data
```bash
  sail artisan migrate:fresh --seed
```

 - Project listen in port http://localhost:80
 - User admin: admin@gmail.com, password: 12345678

## Commands

Stop the server
```bash
  sail stop
```

All commands sail
```bash
  sail help
```

## Run tests
```bash
  sail test
```

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

- `DB_USERNAME`
- `DB_PASSWORD`
- `SENTRY_LARAVEL_DSN`

## API documentation (Swagger)

http://localhost:80/api/documentation

### 🔗 Links

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/luiz-moura/)
