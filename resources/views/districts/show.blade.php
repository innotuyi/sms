<!DOCTYPE html>
<html lang="en">
<head>
    <title>Schools in {{ $district }}</title>
</head>
<body>
    <h1>Schools in {{ $district }}, {{ $province }}</h1>
    <ul>
        @foreach ($schools as $school)
            <li>
                <a href="{{ route('schools.show', ['id' => $school->id]) }}">
                    {{ $school->school_name }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
