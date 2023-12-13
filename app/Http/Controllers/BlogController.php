<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $data['is_active'] = 'blog';
        $data['blog'] = Blog::join('users', 'users.id', '=', 'blog.author')->select('blog.*', 'users.name')->orderBy('blog.created_at', 'desc')->get();
        return view('page.blog.index', $data);
    }

    public function detail($id)
    {
        $data['is_active'] = 'blog';
        $data['blog'] = Blog::join('users', 'users.id', '=', 'blog.author')->select('blog.*', 'users.name')->orderBy('blog.created_at', 'desc')->where('blog.id', $id)->get()->first();
        return view('page.blog.detail', $data);
    }
}
