<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10); // Paginate the posts with 10 posts per page
        return view('posts.index', compact('posts'));
    }


    public function show($id)
    {
        $post = Post::findOrFail($id); // Retrieve the post with the given ID

        return view('posts.show', compact('post')); // Load the show view and pass the post data to it
    }

    public function create()
    {
        $branches = Branch::all();
        $post = Post::all();

        return view('posts.create', compact('branches', 'post'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'branch' => 'required',
            'regional' => 'required',
        ]);

        try {
            if ($request->start_date > $request->end_date) {
                return back()->with('error', 'Start date cannot be greater than end date.');
            }

            // dd($request->file('image'));
                if ($request->hasFile('image')) {
                $imagePaths = [];
                foreach ($request->file('image') as $image) {
                    // Validate image resolution
                    $imageSize = getimagesize($image);
                    $width = $imageSize[0];
                    $height = $imageSize[1];
            
                    if ($width != 1441 || $height != 801) {
                        return back()->with('error', 'Please upload images with resolution 1441 x 801.');
                    }
            
                    $imageName = time() . '_' . $image->getClientOriginalName();
            
                    $image->move(public_path('images'), $imageName);
                    $imagePaths[] = $imageName;
                }
            
                // if (count($imagePaths) < 3) {
                //   return back()->with('error', 'Please upload at least 3 images.');
                // }
            } else {
                return back()->with('error', 'Please upload at least 3 images.');
            }




            $post = new Post();
            $post->title = $request->title;
            $post->start_date = $request->start_date;
            $post->end_date = $request->end_date;
            $post->image = json_encode($imagePaths);
            $post->branch = $request->branch;
            $post->regional = $request->regional;
            $now = now();

            if ($post->end_date < $now) {
                $post->status = 'Expired';
            } else {
                $post->status = 'Published';
            }
            $post->save();

            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            Log::error('Error occurred while saving post: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while saving the post.');
        }
    }



    public function edit(Post $post)
    {
        $branches = Branch::all();

        return view('posts.edit', compact('post', 'branches'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'branch' => 'required',
            'regional' => 'required',
        ]);

        try {
            // Check if at least 3 images are uploaded
            // if ($request->hasFile('image') && count($request->file('image')) < 3) {
            //     return back()->with('error', 'Please upload at least 3 images.');
            // }

            if ($request->start_date > $request->end_date) {
                return back()->with('error', 'Start date cannot be greater than end date.');
            }

            // Update post attributes
            $post->title = $request->title;
            $post->start_date = $request->start_date;
            $post->end_date = $request->end_date;

            // Process and update images if provided
            if ($request->hasFile('image')) {
                $imagePaths = [];
                foreach ($request->file('image') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);
                    $imagePaths[] = $imageName;
                }
                $post->image = json_encode($imagePaths);
            }

            $post->branch = $request->branch;
            $post->regional = $request->regional;
            $post->save();

            return redirect()->route('posts.index')->with('success', 'Post updated successfully');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error occurred while updating post: ' . $e->getMessage());
            // Redirect back with error message
            return back()->with('error', 'An error occurred while updating the post.');
        }
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }


public function showByBranch($branch)
    {
        // Get the current date
        $currentDate = Carbon::now();

        // Get the posts for the given branch
        $posts = Post::where('branch', $branch)->get();

        // Check if any posts are found
        if ($posts->isEmpty()) {
           return response()->view('errors.404', [], 404);
        }

        // Check if the start date of any post is after the current date
        foreach ($posts as $post) {
            if (Carbon::parse($post->end_date)->isBefore($currentDate)) {
               return response()->view('errors.404', [], 404);
            }
        }

        // If no errors occurred, return the view with the posts
        return view('posts.show_by_branch', compact('posts'));
    }


    public function saveImagePriority(Request $request)
    {
        // Extract and process priority scale values
        $priorityValues = $request->input('image_priorities');

        // Fetch the post from the database (assuming you are updating images for a specific post)
        $postId = $request->input('post_id');
        $post = Post::findOrFail($postId);

        // Update the priority scale values for images
        foreach ($priorityValues as $index => $priority) {
            // Assuming the images are stored in a column named 'image' as JSON
            $images = json_decode($post->image);
            $images[$index]->priority = $priority; // Update priority scale value
        }

        // Save/update the modified images back to the database
        $post->image = json_encode($images);
        $post->save();

        // Optionally, you can return a response indicating success or failure
        return response()->json(['message' => 'Priority scale values updated successfully']);
    }

    public function saveSortedImages(Request $request)
    {
        // Validate the incoming request data if needed

        // Retrieve the post ID from the request
        $postId = $request->input('post_id');

        // Retrieve the sorted image order from the request
        $imageOrder = $request->input('image_order');

        // Update the post's image column with the new sorted image order
        $post = Post::find($postId);
        $post->image = json_encode($imageOrder); // Assuming you store image URLs as JSON in the image column
        $post->save();

        // Optionally, you can return a response to the client
        return response()->json(['success' => true, 'message' => 'Image order saved successfully']);
    }
}
