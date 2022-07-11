
# LaraFood
[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)

Project inspired by the Laravel Course (LaraFood) - EspecializaTi Academy, I implemented the DDD architecture based on the article written by Brent on October 17, 2019 - [Domain oriented Laravel](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel).

![Logo](https://user-images.githubusercontent.com/57726726/178367355-5b2d23be-b4e9-42ad-91d3-f16a30bd5321.png)

## Tech Stack

 - [Laravel](https://laravel.com/)
 - [Laravel Sail](https://laravel.com/docs/9.x/sail#main-content)
 - [Sentry](https://sentry.io/)
 - [Data transfer objects](https://github.com/spatie/data-transfer-object)
 - [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE)
 - [Pest](https://pestphp.com/)
  
## Installation

First create aliases
```bash
  alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Install larafood with composer
```bash
  sail composer install
```
    
Install npm dependencies

```bash
  sail npm install && sail npm run dev
```

## Run Locally

Start the server in background

```bash
  sail up -d
```

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

project listen in port http://localhost:80

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`APP_URL`
`DB_USERNAME`
`DB_PASSWORD`
`SENTRY_LARAVEL_DSN`

## 🔗 Links
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/luiz-moura/)
