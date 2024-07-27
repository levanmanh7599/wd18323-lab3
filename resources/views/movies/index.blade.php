<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách phim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1>Danh sách phim</h1>
        @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif
        <form action="{{ route('movies.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm phim...">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </form>
        <th>
            <a href="{{ route('movies.create') }}" class="btn btn-success mb-3">Thêm mới</a>
        </th>

        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Hình ảnh </th>
                    <th scope="col">Giới thiệu</th>
                    <th scope="col">Ngày công chiếu</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Hành động</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <th scope="row">{{ $movie->id }}</th>
                        <td><a class="" href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
                        <td>
                            <img src="{{ asset('/storage/' .$movie->poster) }}" width="100">         
                        </td>
                        <td>{{ $movie->intro }}</td>
                        <td>{{ $movie->release_date }}</td>
                        <td>{{ $movie->genre->name }}</td>
                        <td class="d-flex gap-1" >
                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-success mb-1">Sửa</a>
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</button>
                            </form>
                         
                                <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info">Show</a>
                      
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $movies->links() }}
        </div>
        @if ($movies->isEmpty())
            <p>Không tìm thấy phim nào.</p>
        @endif
    </div>


</body>

</html>
