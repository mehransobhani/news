<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewController extends Controller
{

    public function index()
    {
        $news = News::orderBy("id", "desc")->paginate(24);
        return view("admin.new.index", compact("news"));
    }

    public function create()
    {
        return view("admin.new.create");
    }

    public function edit($id)
    {
        $new = News::findOrFail($id);
        return view("admin.new.update", compact("new"));
    }

    public function update(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:256",
            "cover" => "required",
            "text" => "required|string",
            "category_id" => "required|integer"
        ], $request->all());
        News::
        where("id", $request->get("id"))
            ->update([
                "title" => $request->get("title"),
                "cover" =>  $request->get("cover"),
                "text" =>  $request->get("text"),
                "user_id" =>auth()->user()->id,
                "category_id" =>  $request->get("category_id"),
                "status" => $request->get("status",0)
            ]);
        return \response()->json(["message"=>"successfully completed"]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:256",
            "cover" => "required",
            "text" => "required|string",
            "category_id" => "required|integer"
        ], $request->all());

        News::create([
            "title" => $request->get("title"),
            "cover" =>  $request->get("cover"),
            "text" =>  $request->get("text"),
            "user_id" =>auth()->user()->id,
            "category_id" =>  $request->get("category_id"),
            "status" => $request->get("status",0),
            "time" => time(),
        ]);
        return \response()->json(["message"=>"successfully completed"]);

    }
}
