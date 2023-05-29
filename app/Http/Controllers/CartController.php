<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function create()
    {
        $attr = array(
            'pizza',
            'hamburger',
            'cheese',
            'burger',
        );
        // Storage::disk('public')->deleteDirectory('images');
        return view('cart',compact('attr'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $request->file('image')->store('images', 'public');

        return redirect()->route('cart.create')->with('alert', 'Image Uploaded Successfully');
    }
}