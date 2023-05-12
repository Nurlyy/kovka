<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Pages::where(['is_visible' => 1])->take(3)->get();
        return response()->json(['pages' => $pages]);
    }

    public function updatePage(Request $request)
    {
        $page_id = $request->id;
        $page = Pages::where(['id' => $page_id])->first();
        $image1 = $page->image_1;
        $image2 = $page->image_2;
        $image3 = $page->image_3;
        $image4 = $page->image_4;
        $image5 = $page->image_5;
        $image6 = $page->image_6;
        $header = $request->header;
        $body_text = $request->body_text;
        $title = $request->title;
        $is_visible = $request->is_visible;
        if ($request->hasFile('image1')) {
            if ($page->image1 != null && file_exists(str_replace('\\', '/', public_path()) . '/' . $page->image1)) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $page->image1);
            }
            $imageName = time() . '-image-1' . '.' . $request->image1->getClientOriginalExtension();
            $request->image1->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image1 = $path;
            }
            // var_dump($image1);exit;
                
        }
        if ($request->hasFile('image2')) {
            if ($page->image2 != null && file_exists(str_replace('\\', '/', public_path()) . '/' . $page->image2)) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $page->image2);
            }
            $imageName = time() . '-image-2' . '.' . $request->image2->getClientOriginalExtension();
            $request->image2->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image2 = $path;
            }
        }
        if ($request->hasFile('image3')) {
            if ($page->image3 != null && file_exists(str_replace('\\', '/', public_path()) . '/' . $page->image3)) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $page->image3);
            }
            $imageName = time() . '-image-3' . '.' . $request->image3->getClientOriginalExtension();
            $request->image3->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image3 = $path;
            }
        }
        if ($request->hasFile('image4')) {
            if ($page->image4 != null && file_exists(str_replace('\\', '/', public_path()) . '/' . $page->image4)) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $page->image4);
            }
            $imageName = time() . '-image-4' . '.' . $request->image4->getClientOriginalExtension();
            $request->image4->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image4 = $path;
            }
        }
        if ($request->hasFile('image5')) {
            if ($page->image5 != null && file_exists(str_replace('\\', '/', public_path()) . '/' . $page->image5)) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $page->image5);
            }
            $imageName = time() . '-image-5' . '.' . $request->image5->getClientOriginalExtension();
            $request->image5->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image5 = $path;
            }
        }
        if ($request->hasFile('image6')) {
            if ($page->image6 != null && file_exists(str_replace('\\', '/', public_path()) . '/' . $page->image6)) {
                unlink(str_replace('\\', '/', public_path()) . '/' . $page->image6);
            }
            $imageName = time() . '-image-6' . '.' . $request->image6->getClientOriginalExtension();
            $request->image6->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image6 = $path;
            }
        }

        // var_dump($image1);exit;

        $page->update([
            'image_1' => $image1,
            'image_2' => $image2,
            'image_3' => $image3,
            'image_4' => $image4,
            'image_5' => $image5,
            'image_6' => $image6,
            'header' => $header,
            'body_text' => $body_text,
            'title' => $title,
            'is_visible' => $is_visible,
        ]);
    }

    public function createPage(Request $request)
    {
        // if ($request->hasFile('image1')) {return 'fuck';}
        // else{
        //     return 'shmuck';
        // }
        $image1 = null;
        $image2 = null;
        $image3 = null;
        $image4 = null;
        $image5 = null;
        $image6 = null;
        $header = $request->header;
        $body_text = $request->body_text;
        $title = $request->title;
        $is_visible = $request->is_visible;
        if ($request->hasFile('image1')) {
            $imageName = time() . '-image-1-' . '.' . $request->image1->getClientOriginalExtension();
            $request->image1->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image1 = $path;
            }
            
        }
        if ($request->hasFile('image2')) {
            $imageName = time() . '-image-2-' . '.' . $request->image2->getClientOriginalExtension();
            $request->image2->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image2 = $path;
            }
        }
        if ($request->hasFile('image3')) {
            $imageName = time() . '-image-3-' . '.' . $request->image3->getClientOriginalExtension();
            $request->image3->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image3 = $path;
            }
        }
        if ($request->hasFile('image4')) {
            $imageName = time() . '-image-4-' . '.' . $request->image4->getClientOriginalExtension();
            $request->image4->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image4 = $path;
            }
        }
        if ($request->hasFile('image5')) {
            $imageName = time() . '-image-5-' . '.' . $request->image5->getClientOriginalExtension();
            $request->image5->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image5 = $path;
            }
        }
        if ($request->hasFile('image6')) {
            $imageName = time() . '-image-6-' . '.' . $request->image6->getClientOriginalExtension();
            $request->image6->move(public_path('uploads/pages'), $imageName);
            $path = '/uploads/pages/' . $imageName;
            if ($path != null) {
                $image6 = $path;
            }
        }

        $pages = Pages::create([
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
            'image5' => $image5,
            'image6' => $image6,
            'header' => $header,
            'body_text' => $body_text,
            'title' => $title,
            'is_visible' => $is_visible,
        ]);
    }

    public function getPage(Request $request)
    {
        $page_id = $request->page_id;
        $page = Pages::find(['id' => $page_id])->first();
        return response()->json(['page' => $page]);
    }

    public function getPagesAdmin(Request $request)
    {
        if (isset($request->id)) {
            $pages = Pages::find(['id' => $request->id])->first();
        } else {

            $pages = Pages::all();
        }
        return response()->json(['pages' => $pages]);
    }

    public function deletePage(){

    }
}
