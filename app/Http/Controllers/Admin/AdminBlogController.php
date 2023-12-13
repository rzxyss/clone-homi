<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function index()
    {
        $data['blog'] = Blog::join('users', 'users.id', '=', 'blog.author')->select('users.name', 'blog.*')->get();
        return view('admin.blog.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move('assets/images/thumbnail', $imageName);
            $blog = Blog::create([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'thumbnail' => $imageName,
                'author' => auth()->id()
            ]);
            if ($blog) {
                return redirect('admin/blog')->with('message', 'Blog Addedd!');
            } else {
                return redirect('admin/blog')->with('error', 'Sorry, Failed Added Blog!');
            }
        } else {
            return redirect('admin/blog')->with('error', 'Sorry, Failed Added Blog!');
        }
    }

    public function show(Blog $blog)
    {
        $data['blog'] = Blog::join('users', 'users.id', '=', 'blog.author')->select('users.name', 'blog.*')->get()->first();
        return view('admin.blog.detail', $data);
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $blog = Blog::findOrFail($blog->id);
        if ($request->hasFile('thumbnail')) {
            $path = 'assets/images/thumbnail/' . $blog->thumbnail;
            unlink($path);
            $image = $request->file('thumbnail');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move('assets/images/thumbnail', $imageName);
            $blog->update([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'thumbnail' => $imageName
            ]);
            if ($blog) {
                return redirect('admin/blog')->with('message', 'Blog Updatedd!');
            } else {
                return redirect('admin/blog')->with('error', 'Sorry, Failed Updated Blog!');
            }
        } else {
            $blog->update([
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ]);
            if ($blog) {
                return redirect('admin/blog')->with('message', 'Blog Updatedd!');
            } else {
                return redirect('admin/blog')->with('error', 'Sorry, Failed Updated Blog!');
            }
        }
    }

    public function destroy(Blog $blog)
    {
        $path = 'assets/images/thumbnail/' . $blog->thumbnail;
        unlink($path);
        $blog->delete();
        if ($blog) {
            return redirect('admin/blog')->with('message', 'Blog Deletedd!');
        } else {
            return redirect('admin/blog')->with('error', 'Sorry, Failed Deleted Blog!');
        }
    }
}
