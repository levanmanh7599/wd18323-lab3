<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Update new</title>
</head>
<body>
    <div class="container w-50">
        <h1>Update new post</h1>
        @if(session('message'))
        <div class="alert alert-success mt-2">
            {{session('message')}}
        </div>
    @endif
        <a href="{{ route('post.index')}}" >List post</a>
        <form action="{{ route('post.update', $post)}}" method="post" enctype="multipart/form-data" >

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label  class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}" >
          </div>

          <div class="mb-3">
            <label class="form-label">Image</label>
            <input class="form-control" type="file" name="image" id="fileImage">
            <img id="img" src="{{ asset('/storage/' .$post->image) }}" alt="{{ $post->title }}" width="111">
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description"  rows="3">{{ $post->description }}</textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea class="form-control" name="content"  rows="6">{{ $post->content }}</textarea>
          </div>

          <div class="mb-3">
            <label  class="form-label">View</label>
            <input type="number" name="view" class="form-control" value="{{ $post->view }}" >
          </div>

          <div class="mb-3">
            <label  class="form-label">Category</label>
            <select name="cate_id" class="form-select">
            @foreach ($categories as $cate)
                <option value="{{$cate->id}}"
                    @if ($cate->id == $post->cate_id)
                        selected
                    @endif
                    >
                    {{ $cate->name}}
                </option>
            @endforeach
        </select>
          </div>

          <div class="mb-b">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
    </div>

    <script>
        var fileImage = document.querySelector("#fileImage");
        var img = document.querySelector("img");
        fileImage.addEventListener('change', function(e){
            e.preventDefault()
            img.src = URL.createObjectURL(this.files[0])
        })
    </script>
</body>
</html>