<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

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
        // dd($request->file('image'));

        // validation image type 
        $request->validate([
            'image.*' => 'required|image',
        ]);
        //  get user session 
        $user_session = $request->session()->getId();

        // create image folder 
        $path = storage_path() . '/app/public/images';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        // Define the path for the current user's image directory
        $user_dir = $path . '/' . $user_session;

        // Delete the user's image directory if it already exists
        if (is_dir($user_dir)) {
            $it = new RecursiveDirectoryIterator($user_dir, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator(
                $it,
                RecursiveIteratorIterator::CHILD_FIRST
            );
            foreach ($files as $file) {
                if ($file->isDir()) {
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            rmdir($user_dir);
        }

        // Create the user's image directory
        mkdir($user_dir, 0777, true);

        // save images in user dir 
        $images = $request->file('image');
        foreach ($images as $image) {
            $image->store('images/' . $user_session, 'public');
        }
        // $request->file('image')->store('images/' . $user_session, 'public');

        // redirect after saving data 
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
