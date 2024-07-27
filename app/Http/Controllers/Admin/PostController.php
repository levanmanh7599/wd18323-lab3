<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    public function test()
    {
        //Lấy ra toan bộ dữ liệu
        // $posts = Post::all();
        //Lấy 1 bản ghi
        // $post = Post::all()->first();

        //Lấy dữ liệu theo điều kiện
        // $posts = Post::query()->where('cate_id', 1)->get();

        //Tìm dữ liệu gần đúng
        // $posts = Post::query()->where('title', 'LIKE', '%aut%')->get();

        //Sử dụng hàm sum, count, avg, ..
        // $sum = Post::sum('view');
        // return $sum;

        //Thêm dữ liệu
        //1. Dùng mảng
        // $data = [
        //     'title' => fake()->text(25),
        //     'image' => fake()->imageUrl(),
        //     'description' => fake()->text(30),
        //     'content' => fake()->paragraph(),
        //     'view' => rand(10, 1000),
        //     'cate_id' => rand(1, 4),
        // ];
        // Post::query()->create($data);
        //2. sử dụng đối tượng
        // $post = new Post();
        // $post->title = fake()->text(25);
        // $post->image = fake()->imageUrl();
        // $post->description = fake()->text(30);
        // $post->content = fake()->paragraph();
        // $post->view = rand(10, 1000);
        // $post->cate_id = rand(1, 4);
        // $post->save();

        Post::query()->find(101)->update([
            'title' => 'Update data'
        ]);
        $posts = Post::orderByDesc('id')->get();
        return $posts;
    }

    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts', compact('posts'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create',compact('categories'));
    }
    //Lưu dữ liệu thêm mới vào database
    public function store(Request $request)
    {
        $data = $request->except('image'); //Hàm except để loại bỏ key image
        $data['image'] = ''; //Trường hợp người dùng không nhập ảnh
        //Nếu người dùng nhập ảnh
        if($request->hasFile('image')){
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        }
        //Lưu dữ liệu vaod database
        Post::query()->create($data);
        return redirect()->route('post.index')->with('message', 'Thêm dữ liệu thành công');
    }

    public function destroy(Post $post)
    {
        $post->delete( );
        return redirect()->route('post.index')->with('message', 'Xóa dữ liệu thành công');
    }
    //Hiển thị form edit
    public function edit( Post $post )
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('categories','post'));
    }
    public function update(Request $request, Post $post)
    {
        $data = $request->except('image');
        $old_image = $post->image;
        //Nếu không cập nhật ảnh
        $data['image'] = $old_image;
        //Nếu cập nhật ảnh
        if($request->hasFile('image')){
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        }
        //Lưu váo database
        $post->update($data);

        //Xóa ảnh cũ
        if(isset($path_image)){
            if(file_exists('storage/' .$old_image)){
                unlink('storage/' .$old_image);
            }
        }

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công');
    }
}
