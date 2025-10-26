@extends("layouts.admin")

@section("title", "Dashboard")

@push("styles")
    <style>
        /* Main Content */
        .welcome-section h1 {
            font-size: 32px;
            font-weight: bold;
            color: #000000;
            font-family: 'Inter', Arial, sans-serif;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .welcome-section p {
            font-size: 18px;
            font-weight: 500;
            color: #000000;
            font-family: 'Inter', Arial, sans-serif;
            line-height: 1.4;
        }
    </style>
@endpush

@section("content")
    <div class="welcome-section">
        <h1>Selamat datang, Tim Admin!</h1>
        <p>Mari optimalisasi setiap proses hari ini!</p>
    </div>
@endsection
