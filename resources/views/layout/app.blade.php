<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HairCare System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    @include('layout.navbar')


    <div class="flex">
        @include('layout.sidebar')

        <main class="flex-1 ">
            @yield('content')
        </main>
    </div>

    @include('layout.footer')

</body>
</html>
