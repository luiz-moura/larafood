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

Clone the project
```bash
  git clone https://github.com/luiz-moura/larafood.git
```

Install composer dependencies
```bash
  composer install
```

Create aliases for sail bash path
```bash
  alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Start the server in background
```bash
  sail up -d
```

```bash
  sail artisan key:generate
```

Install npm dependencies
```bash
  sail npm install && sail npm run dev
```

Project listen in port http://localhost:80

## Database

Create tables and fill populate with fictitious data
```bash
  php artisan migrate:fresh --seed
```
 - User admin: admin@gmail.com, password: 12345678

## Commands

Start queue
```bash
  sail queue:work
```

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
