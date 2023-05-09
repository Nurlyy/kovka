<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $pages = Pages::where(['is_visible' => 1])->take(3)->get();
        return $pages;
    }

    public function updatePage(Request $request){
        $page_id = $request->page_id;
        $page = Pages::where(['id' => $page_id])->first();
        
    }

    public function getPage(Request $request){
        $page_id = $request->page_id;
        $page = Pages::where(['id' => $page_id])->first();
        return $page;
    }

    public function getAllPages(){
        $pages = Pages::all();
        return $pages;
    }
}
