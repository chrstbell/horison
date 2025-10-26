<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield("title", "HORISON Admin")</title>

        {{-- Fonts, styles, etc --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        {{-- Optional extra CSS --}}
        @stack("styles")
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', Arial, sans-serif;
                background-color: #ffffff;
                overflow-x: hidden;
            }

            .main-content {
                margin-left: 350px;
                padding: 40px 50px;
                background-color: #ffffff;
                min-height: 100vh;
                flex: 1;
            }

            .dashboard-container {
                width: 100vw;
                min-height: 100vh;
                background-color: #ffffff;
                position: relative;
                display: flex;
            }
        </style>
    </head>

    <body>
        {{-- Optional scripts --}}
        @stack("scripts")
    </body>

</html>
