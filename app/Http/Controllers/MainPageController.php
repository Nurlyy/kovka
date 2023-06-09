<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainPage;

class MainPageController extends Controller
{

    public function saveMainPage(Request $request){
        // return $request;
        $header = $request->header;
        $title = $request->title;
        $body = $request->body;
        $description = $request->description;
        $mainPage = MainPage::first();
        $mainPage->update([
            'header' => $header,
            'title' => $title,
            'body' => $body,
            "description" => $description
        ]);
        return response()->json(['mainPage' => $mainPage]);
    }

    public function getMainPage(){
        return response()->json(['mainPage' => MainPage::first()]);
    }

    public function getPersonalStatus(){
        return response()->json(['visibility' => MainPage::first()->personal_status]);
    }

    public function setPersonalStatus(){
        $mainPage = MainPage::first();
        $personal_status = $mainPage->personal_status == 1 ? true : false;
        $personal_status = !$personal_status;
        $personal_status = $personal_status == true ? 1 : 0;
        $mainPage->update(['personal_status' => $personal_status]);
        
        return response()->json(['visibility' => $personal_status]);
    }


}