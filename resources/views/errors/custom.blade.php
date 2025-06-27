<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger">
            <h4 class="alert-heading">Error!</h4>
            <p>{{ $exception->getMessage() }}</p>
            @if(config('app.debug'))
                <hr>
                <p class="mb-0">File: {{ $exception->getFile() }}</p>
                <p class="mb-0">Line: {{ $exception->getLine() }}</p>
                <pre class="mt-3">{{ $exception->getTraceAsString() }}</pre>
            @endif
        </div>
    </div>
</body>
</html> 