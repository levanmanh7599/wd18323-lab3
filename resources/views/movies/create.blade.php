<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm mới phim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1>Thêm mới phim</h1>
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label  class="form-label">Hình ảnh áp phích</label>
                <input class="form-control" type="file" name="poster" id="filePoster">
                <img id="img" src="{{ asset('/storage/' ) }}" width="100" alt="">

            </div>
            <div class="mb-3">
                <label for="intro" class="form-label">Giới thiệu</label>
                <input type="text" name="intro" class="form-control" id="intro">
            </div>
            <div class="mb-3">
                <label for="release_date" class="form-label">Ngày công chiếu</label>
                <input type="date" name="release_date" class="form-control" id="release_date">
            </div>
            <div class="mb-3">
                <label for="genre_id" class="form-label">Thể loại</label>
                <select name="genre_id" class="form-control" id="genre_id">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Thêm mới</button>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary">Danh sách phim</a>
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
