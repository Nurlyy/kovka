<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regalia;

class RegaliaController extends Controller
{

    public function createRegalia(Request $request)
    {
        if ($request->hasFile('image')) {
            // $path = $request->file('image')->store('public/uploads');
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/regalia'), $imageName);
            // return $imageName;
            // $newPath = $request->image->store('public/uploads', 's3');
            // return $newPath;

            $path = '/uploads/regalia/' . $imageName;
            $title = $request->title;
            $body = $request->body;
            // return $description;

            // return $imageFilters[1];

            if ($path != null && $title != null) {

                $regalia = Regalia::create(['image' => $path, 'title' => $title, 'body' => $body]);
                return response()->json(['regalia' => $regalia]);
            }
        }
    }

    public function updateRegalia(Request $request)
    {
        $regalia = Regalia::find(['id' => $request->id])->first();
        $imageName = $regalia->image;
        if ($request->hasFile('image')) {

            if(file_exists(str_replace('\\', '/', public_path()) . '/' . $regalia->image)){
                unlink(str_replace('\\', '/', public_path()) . '/' . $regalia->image);
            }
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/regalia'), $imageName);
            $imageName = '/uploads/regalia/' . $imageName;


            // return $imageName;
            // $newPath = $request->image->store('public/uploads', 's3');
            // return $newPath;


        }
        $title = $request->title;
        $body = $request->body;
        if ($imageName != null && $title != null) {
            $regalia->update(['image' => $imageName, 'title' => $title, 'body' => $body]);
            return response()->json(['regalia' => $regalia]);
        }
    }

    public function deleteRegalia(Request $request)
    {
        $regalia = Regalia::find(['id' => $request->id])->first();
        if(file_exists(str_replace('\\', '/', public_path()) . '/' . $regalia->image)){
            unlink(str_replace('\\', '/', public_path()) . '/' . $regalia->image);
        }
        $regalia->delete();
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
