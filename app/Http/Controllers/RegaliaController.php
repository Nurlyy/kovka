<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regalia;

class RegaliaController extends Controller
{

    public function createRegalia(Request $request)
    {
        if ($request->hasFile('image') && $request->hasFile('bg_image')) {
            // $path = $request->file('image')->store('public/uploads');
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $BgImageName = time() . '_bg.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/regalia'), $imageName);
            $request->bg_image->move(public_path('uploads/regalia'), $BgImageName);
            // return $imageName;
            // $newPath = $request->image->store('public/uploads', 's3');
            // return $newPath;

            $path = '/uploads/regalia/' . $imageName;
            $bg_path = '/uploads/regalia/' . $BgImageName;
            $title = $request->title;
            $body = $request->body;
            $page_id = $request->page_id;
            // return $description;

            // return $imageFilters[1];

            if ($path != null && $title != null && $bg_path != null) {

                $regalia = Regalia::create(['image' => $path, 'bg_image' => $bg_path, 'title' => $title, 'body' => $body, 'page_id' => $page_id]);
                return response()->json(['regalia' => $regalia]);
            }
        }
    }

    public function updateRegalia(Request $request)
    {
        $regalia = Regalia::find(['id' => $request->id])->first();
        $imageName = $regalia->image;
        $BgImageName = $regalia->bg_image;
        if ($request->hasFile('image')) {

            if (file_exists(str_replace('\\', '/', public_path()) . '/' . $regalia->image)) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $regalia->image);
            }
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/regalia'), $imageName);
            $imageName = '/uploads/regalia/' . $imageName;


            // return $imageName;
            // $newPath = $request->image->store('public/uploads', 's3');
            // return $newPath;


        }
        if ($request->hasFile('bg_image')) {

            if (file_exists(str_replace('\\', '/', public_path()) . '/' . $regalia->bg_image) && $regalia->bg_image != null) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $regalia->bg_image);
            }
            $BgImageName = time() . '_bg.' . $request->bg_image->getClientOriginalExtension();
            $request->bg_image->move(public_path('uploads/regalia'), $BgImageName);
            $BgImageName = '/uploads/regalia/' . $BgImageName;


            // return $imageName;
            // $newPath = $request->image->store('public/uploads', 's3');
            // return $newPath;


        }
        $title = $request->title;
        $body = $request->body;
        $page_id = $request->page_id;
        if ($imageName != null && $title != null) {
            $regalia->update(['image' => $imageName, 'bg_image' => $BgImageName, 'title' => $title, 'body' => $body, 'page_id' => $page_id]);
            return response()->json(['regalia' => $regalia]);
        }
    }

    public function deleteRegalia(Request $request)
    {
        // return $request->id;
        if ($request->id != null) {
            $regalia = Regalia::find(['id' => $request->id])->first();
            if (file_exists(str_replace('\\', '/', public_path()) . '/' . $regalia->image)) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $regalia->image);
            }
            if (file_exists(str_replace('\\', '/', public_path()) . '/' . $regalia->bg_image)) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $regalia->bg_image);
            }
            $regalia->delete();
        }
    }

    public function getRegalia(Request $request)
    {
        if (isset($request->id)) {
            $regalia = Regalia::find(['id' => $request->id])->first();
        } else {
            $regalia = Regalia::all();
        }
        return response()->json(['regalia' => $regalia]);
    }
}
