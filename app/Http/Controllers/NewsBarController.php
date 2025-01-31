<?php

namespace App\Http\Controllers;

use App\Models\NewsBar;
use Illuminate\Http\Request;

class NewsBarController extends Controller
{
    public function index()
    {
        $newsBar = NewsBar::first();
        return view('admin.news-bar.create', compact('newsBar'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $newsBar = NewsBar::firstOrNew();
        $newsBar->content = $request->content;
        $newsBar->save();

        return redirect()->back()->with('success', 'News Bar updated successfully.');
    }
}
