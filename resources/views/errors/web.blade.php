<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $code }} | {{ $title }}</title>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen px-4 py-12 auth-container sm:px-6 lg:px-8">
        <div class="w-full max-w-2xl space-y-8">
            <div>
                <h1 style="" class="font-extrabold text-center text-red-600 uppercase text-8xl">
                    {{ $code }} | Error
                </h1>
                <p class="mt-8 text-3xl font-extrabold text-center text-gray-700">
                    {!! $title !!}
                </p>
            </div>

            {{-- <div class="flex justify-center gap-8 mt-8 text-center">
                <a href="/" class="no-underline">
                    <button class="btn btn-light-blue">Home</button>
                </a>

                <a href="{{ route('patient.index') }}" class="no-underline">
            <button class="btn btn-blue">Portal</button>
            </a>
        </div> --}}
    </div>
    </div>
</body>
</html>
