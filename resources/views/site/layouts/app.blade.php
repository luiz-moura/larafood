<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Larafood</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta name="theme-color" content="#7952b3">
</head>

<body>
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center border-bottom mb-4 pb-3">
                <a class="d-flex align-items-center text-dark text-decoration-none" href="/">
                    <span class="fs-4">Larafood</span>
                </a>
                <nav class="d-inline-flex mt-md-0 ms-md-auto mt-2">
                    <a class="text-dark text-decoration-none py-2" href="{{ route('login') }}">{{ __('site.login') }}</a>
                </nav>
            </div>
            <div class="pricing-header pb-md-4 mx-auto p-3 text-center">
                <h1 class="display-4 fw-normal">{{ __('site.explore_our_plans') }}</h1>
                <p class="fs-5 text-muted">{{ __('site.summary_of_plans') }}</p>
            </div>
        </header>
        <main>
            @yield('content')
        </main>
        <footer class="my-md-5 pt-md-5 border-top pt-4">
            <div class="row">
                <div class="col-12 col-md">
                    <small class="d-block text-muted mb-3">&copy; 2022-2023</small>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
