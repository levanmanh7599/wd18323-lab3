<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Hiển thị danh sách phim với phân trang
    public function index()
    {
        $movies = Movie::with('genre')->paginate(10);
        
        return view('movies.index', compact('movies'));
    }

    public function search(Request $request)
    {
        $searchTitle = $request->input('search');
        
        // Tìm kiếm phim theo tiêu đề và phân trang
        $movies = Movie::with('genre')
            ->where('title', 'like', '%' . $searchTitle . '%')
            ->paginate(10);
        
        return view('movies.index', compact('movies'));
    }


    // Hiển thị form tạo mới phim
    public function create()
    {
        $genres = Genre::all(); // Lấy tất cả thể loại phim
        return view('movies.create', compact('genres'));
    }

    // Lưu dữ liệu phim mới vào database
    public function store(Request $request)
    {
        $data = $request->except('poster'); // Loại bỏ trường poster nếu không cần thiết
        $data['poster'] = ''; // Trường hợp người dùng không nhập ảnh

        // Nếu người dùng nhập ảnh
        if ($request->hasFile('poster')) {
            $path_poster = $request->file('poster')->store('posters', 'public');
            $data['poster'] = $path_poster;
        }

        // Lưu dữ liệu vào database
        Movie::create($data);

        return redirect()->route('movies.index')->with('message', 'Thêm phim thành công');
    }

    // Hiển thị form chỉnh sửa phim
    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        // Chuyển đổi ngày phát hành thành chuỗi định dạng Y-m-d
      
        return view('movies.edit', compact('genres', 'movie'));
    }
    

    // Cập nhật dữ liệu phim
    public function update(Request $request, Movie $movie)
    {
        $data = $request->except('poster');
        $old_poster = $movie->poster;
        // Nếu không cập nhật ảnh
        $data['poster'] = $old_poster;

        // Nếu cập nhật ảnh
        if ($request->hasFile('poster')) {
            $path_poster = $request->file('poster')->store('posters', 'public');
            $data['poster'] = $path_poster;

            // Xóa ảnh cũ nếu có
            if ($old_poster && file_exists(public_path('storage/' . $old_poster))) {
                unlink(public_path('storage/' . $old_poster));
            }
        }

        // Cập nhật dữ liệu vào database
        $movie->update($data);

        return redirect()->route('movies.index')->with('message', 'Cập nhật phim thành công');
    }

    // Xóa phim
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')->with('message', 'Xóa phim thành công');
    }

    public function show(Movie $movie)
    {
        // Đảm bảo rằng mô hình đã được liên kết với thể loại
        $movie->load('genre');

        // Trả về view chi tiết với dữ liệu phim
        return view('movies.show', compact('movie'));
    }
}
