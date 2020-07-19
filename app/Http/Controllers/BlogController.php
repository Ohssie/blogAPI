<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Blog as BlogResource;
use Illuminate\Support\Str;
use App\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return BlogResource::collection(Blog::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'featured_image' => 'required',
        'title' => 'required',
        'body' => 'required',
      ]);

      $blog = new Blog;
      if ($request->hasFile('featured_image')){
        $blog->featured_image = $this->processImage($request->featured_image);
      }
      $blog->title = $request->title;
      $blog->body = $request->body;
      $blog->save();

      return new BlogResource($blog);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return new BlogResource(Blog::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'title' => 'required',
        'body' => 'required',
      ]);

      $blog = Blog::find($id);
      $blog->title = $request->title;
      $blog->body = $request->body;
      $blog->save();

      return new BlogResource($blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $blog = Blog::find($id);
      $blog->delete();
      return response()->json(null, 204);
    }

    private function processImage($image_file) {
      $image = $image_file;
      $image_name = Str::random(20);
      $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
      $image_full_name = $image_name.'.'.$ext;
      $upload_path = 'image/';    //Creating Sub directory in Public folder to put image
      $image_url = $upload_path.$image_full_name;
      $success = $image->move($upload_path, $image_full_name);
      return $success;
    }
}
