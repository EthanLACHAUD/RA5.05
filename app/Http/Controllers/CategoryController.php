<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Track;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('tracks')->get();
        return view('app.categorie.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $tracks = $category->tracks()
            ->with(['user', 'week'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->paginate(15);

        return view('app.categorie.show', compact('category', 'tracks'));
    }

    public function tracks(Category $category)
    {
        return view('app.categories.tracks', compact('category'));
    }

    public function artists(Category $category)
    {
        return view('app.categories.artists', compact('category'));
    }

    public function weeks(Category $category)
    {
        return view('app.categories.weeks', compact('category'));
    }

    


}
