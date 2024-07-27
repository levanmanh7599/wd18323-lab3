<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Movie Details</title>
</head>
<body>
    <div class="container w-50 mt-4">
        <h1>Movie Details</h1>
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" value="{{ $movie->title }}" readonly>
        </div>

        <div class="mb-3">
            <label for="poster" class="form-label">Poster Image</label>
            <img src="{{ asset('/storage/' . $movie->poster) }}" 
                 alt="{{ $movie->title }}" width="111" class="img-fluid">
        </div>

        <div class="mb-3">
            <label for="intro" class="form-label">Introduction</label>
            <input type="text" class="form-control" id="intro" value="{{ $movie->intro }}" readonly>
        </div>

        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date</label>
            <input type="text" class="form-control" id="release_date" value="{{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}" readonly>
        </div>

        <div class="mb-3">
            <label for="genre_id" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre_id" value="{{ $movie->genre->name }}" readonly>
        </div>

        <div class="mb-3">
            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Back to Movie List</a>
        </div>
    </div>
</body>
</html>
