<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Update Movie</title>
</head>
<body>
    <div class="container w-50 mt-4">
        <h1>Update Movie</h1>
        @if(session('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
        @endif
        
        <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ $movie->title }}">
            </div>

            <div class="mb-3">
                <label for="filePoster" class="form-label">Poster Image</label>
                <input class="form-control" type="file" name="poster" id="filePoster">
                <img id="img" src="{{  asset('/storage/' . $movie->poster) }}" 
                alt="{{ $movie->title }}" width="111" class="mt-2">
            </div>

            <div class="mb-3">
                <label for="intro" class="form-label">Introduction</label>
                <input type="text" name="intro" class="form-control" id="intro" value="{{ $movie->intro }}">
            </div>

            <div class="mb-3">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="date" name="release_date" class="form-control" id="release_date" value="{{ $movie->release_date}}">
            </div>

            <div class="mb-3">
                <label for="genre_id" class="form-label">Genre</label>
                <select name="genre_id" class="form-select" id="genre_id">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $genre->id == $movie->genre_id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a  href="{{ route('movies.index') }}" class="btn btn-secondary ">Movie List</a>
            </div>
            
        </form>
    </div>

    <script>
          var filePoster = document.querySelector("#filePoster");
        var img = document.querySelector("img");
        filePoster.addEventListener('change', function(e){
            e.preventDefault()
            img.src = URL.createObjectURL(this.files[0])
        })
    </script>
</body>
</html>
