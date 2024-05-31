<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/js/app.js')
</head>
<body class="antialiased">
    <form method="GET" action="{{ route('xero.contacts') }}">
        <button type="submit">Get Xero Contacts</button>
    </form>

    {{-- <button id="btn-submit">Get Xero Contacts</button> --}}

    {{-- <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', (event) => {
            const submitButton = document.getElementById('btn-submit');

            submitButton.onclick = (event) => {
                event.preventDefault();

                try {
                    const data = axios.get(@json(route('xero.contacts')));

                    console.log('success', data);
                } catch (error) {
                    console.error('failed', error);
                }
            }
        });

    </script> --}}
</body>
</html>
