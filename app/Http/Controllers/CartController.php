<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class CartController extends Controller
{
    public $attr = array(
        'pizza',
        'hamburger',
        'cheese',
        'burger',
    );
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labels = $this->attr;
        // Storage::disk('public')->deleteDirectory('images');
        return view('cart', compact(['labels']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation image type 
        $request->validate([
            'image' => 'required|image',
        ]);
        //  get user session 
        $user_session = $request->session()->getId();
        // create image folder 
        $path = storage_path() . '/app/public/images';
        if (!file_exists($path)) {
            mkdir($path);
        }
        // create user image folder 
        $user_dir = $path . '/' . $user_session;
        if (file_exists($user_dir)) {
            rmdir($user_dir);
        }
        mkdir($user_dir);

        $request->file('image')->store('images/'. $user_session , 'public');
        dd($request->file('image'));

        return redirect()->route('cart.create')->with('alert', 'Image Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $formData = $request->all();
        // $this->attr .append($formData);
        return response()->json(['FormData' =>  $formData], 200);

        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
