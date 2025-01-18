@extends('layouts.login_master')

@section('content')
<body>
    <h1>{{ $school->school_name }}</h1>
    <p><strong>Address:</strong> {{ $school->address }}</p>
    <p><strong>Phone:</strong> {{ $school->phone_number }}</p>
    <p><strong>Email:</strong> {{ $school->email }}</p>
    <p><strong>Principal:</strong> {{ $school->principal_name }}</p>
    <p><strong>Province:</strong> {{ $school->province }}</p>
    <p><strong>District:</strong> {{ $school->district }}</p>
    <p><strong>Established Year:</strong> {{ $school->established_year }}</p>
    <p><strong>School Type:</strong> {{ $school->school_type }}</p>
</body>
</html>
@endsection
