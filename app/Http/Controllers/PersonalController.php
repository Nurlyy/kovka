<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personal;

class PersonalController extends Controller
{

    public function addPersonal(Request $request)
    {

        $position = $request->position;
        $name = $request->name;
        $body = $request->body;
        $visibility = $request->visibility;
        $image = null;
        $email = '';

        if ($request->hasFile("image")) {
            $imageName = time();
            $ext = $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/personal/'), $imageName . "." . $ext);
            $file =  $imageName . '.' . $ext;
            $this->convertImageToWebp($file);
            $this->createPreview($imageName . ".webp");
            $path = '/uploads/personal/' . $imageName . '.' . 'webp';
            if ($path != null) {
                $image = $path;
            }
        }

        // return response()->json($slug_page, 200);
        $personal = Personal::create([
            "position" => $position,
            "name" => $name,
            "body" => $body,
            "visibility" => $visibility,
            "image" => $image,
            "email" => $email,
        ]);
    }

    public function updatePersonal(Request $request)
    {
        // return response()->json(['page' => $request->name]);
        $position = $request->position;
        $name = $request->name;
        $body = $request->body;
        $visibility = $request->visibility;
        $image = $request->image;
        $email = '';
        $id = $request->id;

        if ($request->hasFile("image")) {
            $imageName = time();
            $ext = $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/personal/'), $imageName . "." . $ext);
            $file =  $imageName . '.' . $ext;
            $this->convertImageToWebp($file);
            $this->createPreview($imageName . ".webp");
            $path = '/uploads/personal/' . $imageName . '.' . 'webp';
            if ($path != null) {
                $image = $path;
            }
        }
        // return $body;
        $personal = Personal::where('id', $id)->first();
        // return response()->json($personal, 200);
        $personal->update([
            "position" => $position,
            "name" => $name,
            "body" => $body,
            "visibility" => $visibility,
            "image" => $image,
            "email" => $email,
        ]);

        return response()->json(['personal' => $personal], 201);
    }


    public function getPersonal(Request $request)
    {
        $personal = Personal::where('visibility', 1)->get();
        return response()->json(['personal' => $personal]);
    }

    public function getPersonalsAdmin()
    {
        $items = Personal::all();
        return response()->json(['items' => $items]);
    }

    public function getPersonalAdmin(Request $request)
    {
        $id = $request->id;
        $personal = Personal::where('id', $id)->first();
        return response()->json(['personal' => $personal]);
    }

    public function deletePersonal(Request $request)
    {
        $id = $request->id;
        $personal = Personal::where('id', $id)->first();
        $personal->delete();
        return response()->json(['items' => Personal::all()], 204);
    }

    private function convertImageToWebp($file)
    {
        ini_set('memory_limit', '256M');
        $directory = str_replace('\\', '/', public_path()) . '/' . "uploads/personal/";
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

    private function createPreview($file)
    {
        ini_set('memory_limit', '256M');
        $directory = str_replace('\\', '/', public_path()) . '/' . "uploads/personal/";
        $image = imagecreatefromwebp($directory . $file);

        // Get the current dimensions of the image
        $width = imagesx($image);
        $height = imagesy($image);

        // Calculate the new dimensions
        $new_height = 320; // 50% of the original height or minimum 400 pixels
        $new_width = $new_height * $width / $height; // Maintain the aspect ratio

        // Create a new image with the new dimensions
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Squeeze the original image into the new image
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Save the new image as a .webp file
        imagewebp($new_image, $directory . pathinfo($file, PATHINFO_FILENAME) . '.webp', 80); // 80 is the quality parameter, which can be set between 0 and 100

        // Free up memory
        imagedestroy($image);
        imagedestroy($new_image);
    }
}
