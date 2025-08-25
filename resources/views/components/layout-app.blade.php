<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}} @isset($pageTitle) - {{$pageTitle}}@endisset</title>
    <!-- favicon -->
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/png">
    <!-- resources -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/datatables/datatables.min.css')}}">  
    <!-- custom -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}"> 

    {{-- <!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">

<!-- DataTables + Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- Seu CSS customizado -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"> --}}
</head>

<body>

    <x-user-bar />

    <div class="d-flex pt-2">
        <x-side-bar/>
        {{$slot}}
    </div>

    {{-- <script src="{{asset('assets/datatables/jquery.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script> --}}
    <!-- jQuery -->
    <script src="{{ asset('assets/datatables/jquery.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables + Bootstrap 5 JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Seu JS customizado -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>