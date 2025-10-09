<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
</head>

<body class="antialiased d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #FFFAFA;">
    <div class="card card-primary col-10 col-lg-4 p-4">
        <form action="/loginAction" method="post" class="d-flex flex-column">
            @csrf
            <h1 class="mb-4">Login</h1>
            <div class="mb-4">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-input w-100" id="email" name="email" placeholder="Masukkan Email" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password :</label>
                <input type="password" class="form-input w-100" id="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <div class="mt-2 d-flex">
                <button type="submit" class="btn btn-primary col-5">Log in</button>
            </div>
        </form>
    </div>
</body>

</html>
@if (session('error'))
    <script>
        alert('Email atau Password salah')
    </script>
@endif