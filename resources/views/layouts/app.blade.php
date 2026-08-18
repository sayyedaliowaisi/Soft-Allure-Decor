<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Soft Allure Décor</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-white text-gray-900">

@include('components.navbar')

<main>

    @yield('content')

</main>

@include('components.footer')

</body>

</html>