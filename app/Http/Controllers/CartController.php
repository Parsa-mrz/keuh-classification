<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

class CartController extends Controller
{

    public function create(Request $request)
    {
        $session = $request->session()->getId();
        // select labels from database 
        $labels = Cart::select('labels')
            ->where('user_id', '=', $session)
            ->get();

        // check labels is set for user or not 
        if ($labels->isEmpty()) {
            $image_labels = '';
        } else {
            $image_labels = $labels[0]->labels ?? '';
        }

        // Split the labels into an array
        $labelsArray = explode("\n", $image_labels);

        // remove empty string 
        $labelsArray = array_filter($labelsArray, function ($value) {
            return $value !== "";
        });
        // return cart view 
        return view('cart', compact(['labelsArray']));
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

        // insert to database
        $cart = new Cart();
        $cart->user_id = $user_session;
        $cart->image_directory = $user_dir;
        $cart->save();


        // redirect after saving data
        return redirect()->route('cart.create')->with('alert', 'Image Uploaded Successfully');
    }
}
