<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::orderBy("id", "desc")->paginate(24);
        return view("admin.category.index", compact("categorys"));
    }

    public function create()
    {
        return view("admin.category.create");
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view("admin.category.update", compact("category"));
    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:256",
            "id" => "required|integer",
        ], $request->all());
        Category::
        where("id", $request->get("id"))
            ->update([
                "name" => $request->get("name"),
                "status" => $request->get("status", 0)
            ]);
        return \response()->json(["message"=>"successfully completed"]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:256",
        ], $request->all());

        Category::create([
            "name" => $request->get("name"),
            "status" => $request->get("status", 0)
        ]);
        return \response()->json(["message"=>"successfully completed"]);

    }
}
