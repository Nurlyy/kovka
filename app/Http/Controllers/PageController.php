<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{

    public function addPage(Request $request)
    {

        $name = $request->name;
        $slug  = $request->slug;
        $title = $request->title;
        $header_title = $request->header_title;
        $body = $request->body;
        $keyword = $request->keyword;
        $description = $request->description;
        $show = $request->visibility;
        $isPreview = $request->isPreview;
        $preview_title = $request->preview_title;
        $preview_body = $request->preview_body;
        $preview_image = null;

        $slug_page = Page::select('slug', 'id')->where('slug', $slug)->first();

        if($request->hasFile("preview_image")){
            $imageName = time();
            $ext = $request->preview_image->getClientOriginalExtension();
            $request->preview_image->move(public_path('uploads/pages/'), $imageName . "." . $ext);
            $file =  $imageName . '.' . $ext;
            $this->convertImageToWebp($file, "pages");
            $path = '/uploads/pages/' . $imageName . '.' . 'webp';
            if ($path != null) {
                $preview_image = $path;
            }
            // return $path;
        }

        // return response()->json($slug_page, 200);
        if ($slug_page == null || $slug_page == []) {
            $page = Page::create([
                'name' => $name,
                'slug' => $slug,
                'title' => $title,
                'header_title' => $header_title,
                'body' => $body,
                'keyword' => $keyword,
                'description' => $description,
                'show' => $show,
                'isPreview' => $isPreview,
                'preview_title' => $preview_title,
                'preview_body' => $preview_body,
                'preview_image' => $preview_image,
            ]);

            return response()->json(['page' => $page], 201);
        } else {
            return response()->json(['message' => 'Page with this slug already exists'], 500);
        }
    }

    public function updatePage(Request $request)
    {
        // return response()->json(['page' => $request->name]);
        $name = $request->name;
        $slug  = $request->slug;

        $title = $request->title;
        $header_title = $request->header_title;
        $body = $request->body;
        $keyword = $request->keyword;
        $description = $request->description;
        $show = $request->visibility;
        $id = $request->id;
        $isPreview = $request->isPreview;
        $preview_title = $request->preview_title;
        $preview_body = $request->preview_body;
        $preview_image = null;
        // return $body;
        $page = Page::where('id', intval($id))->first();

        $slug_page = Page::select('slug', 'id')
                ->where('slug', $slug)
                ->where('id', '!=', $page->id)
                ->first();

        // return response()->json(['message' => ['file' => 'fail']], 500);
        if($request->hasFile("preview_image")){
            // return 'it has image;';
            
            $imageName = time();
            $ext = $request->preview_image->getClientOriginalExtension();
            $request->preview_image->move(public_path('uploads/pages/'), $imageName . "." . $ext);
            $file =  $imageName . '.' . $ext;
            
            $this->convertImageToWebp($file, "pages");
            $path = '/uploads/pages/' . $imageName . '.' . 'webp';
            if ($path != null) {
                $preview_image = $path;
            }
            // return $path;
        }
        // return response()->json($slug_page, 200);
        if ($slug_page == null || $slug_page->slug == $slug && $slug_page->id == $id || $slug_page == null || $slug_page == []) {
            $page->update([
                'name' => $name,
                'slug' => $slug,
                'title' => $title,
                'header_title' => $header_title,
                'body' => $body,
                'keyword' => $keyword,
                'description' => $description,
                'show' => $show,
                'isPreview' => $isPreview,
                'preview_title' => $preview_title,
                'preview_body' => $preview_body,
                'preview_image' => $preview_image,
            ]);
        } else {
            return response()->json(['message' => 'Page with this slug already exists'], 500);
        }

        return response()->json(['page' => $page], 201);
        return response()->json(['message' => 'tell developer to make this function ))'], 200);
    }


    public function getPage(Request $request)
    {
        $slug = $request->slug;
        $page = Page::where('slug', $slug)->first();
        if ($page->show == 1) {
            return response()->json(['page' => $page]);
        } else {
            return response()->json(['message' => 'Page is not available']);
        }
    }

    public function getPages()
    {
        $items = Page::where('show', '1')->get();
        return response()->json(['items' => $items]);
    }

    public function getPagesAdmin()
    {
        $items = Page::all();
        return response()->json(['items' => $items]);
    }

    public function getPageAdmin(Request $request)
    {
        $id = $request->id;
        $page = Page::where('id', $id)->first();
        return response()->json(['page' => $page]);
    }

    public function deletePage(Request $request)
    {
        $id = $request->id;
        $page = Page::where('id', $id)->first();
        $page->delete();
        return response()->json(['items' => Page::all()], 204);
    }

    public function uploadImage(Request $request){
        if($request->hasFile("image")){
            $imageName = time();
            $ext = $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/editor/'), $imageName . "." . $ext);
            $file =  $imageName . '.' . $ext;
            $this->convertImageToWebp($file, "editor");
            $path = '/uploads/editor/' . $imageName . '.' . 'webp';
            if ($path != null) {
                $image = $path;
            }
            return $path;
        }
    }
    private function convertImageToWebp($file, $path)
    {
        ini_set('memory_limit', '256M');
        $directory = str_replace('\\', '/', public_path()) . '/' . "uploads/{$path}/";
        if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', "JPG", "JPEG", "PNG"))) {

            if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('jpg', 'jpeg', "JPG", "JPEG"))) {
                // Load the original image
                $original_image = imagecreatefromjpeg($directory . $file);

                // Create a new WebP image
                $new_image = imagecreatetruecolor(imagesx($original_image), imagesy($original_image));
                imagepalettetotruecolor($new_image);

                // Convert the original image to the WebP format
                imagewebp($original_image, $directory . pathinfo($file, PATHINFO_FILENAME) . '.webp');

                // Clean up the resources
                imagedestroy($original_image);
                imagedestroy($new_image);
            } elseif (in_array(pathinfo($file, PATHINFO_EXTENSION), array('png', 'PNG'))) {
                // Load the original image
                $original_image = imagecreatefrompng($directory . $file);

                // Create a new WebP image
                $new_image = imagecreatetruecolor(imagesx($original_image), imagesy($original_image));
                imagepalettetotruecolor($new_image);

                // Convert the original image to the WebP format
                imagewebp($original_image, $directory . pathinfo($file, PATHINFO_FILENAME) . '.webp');

                // Clean up the resources
                imagedestroy($original_image);
                imagedestroy($new_image);
            }
        }
        unlink($directory . $file);
    }

    public function getBlogs(){
        $blogs = Page::where('isPreview', '1')->get();
        return response()->json(['blogs' => $blogs]);
    }

    public function viewPage(Request $request){
        if($request->id){
            $page_id = htmlentities($request->page_id);
            $page = Page::where('id', $page_id)->first();
            $page->views += 1;
            $page->save();
        }
    }
}
