<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::whereNull('sub_category_id')->get();
        return view('categories' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($category)
    {
        try {
            $data =[];
            for ( $i=0; $i <=1; $i++){
                $num = $i + 1;
                $data[] = ['name'=>"Sub ".explode(" " ,$category->name)[1]."-".$num , 'sub_category_id'=>$category->id];
            }
            $storeSubCategory = Category::query()->insert($data);
            return response()->json(['data'=>"$storeSubCategory" , 'status'=>200 , 'meesage'=>'Store Sub Category Success']);
        }catch (\Exception $exception){
            return response()->json(['data'=>'' , 'status'=>500 , 'meesage'=>'Store Sub Category Failed : ' .$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function getSubCategory($id) :  JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            $this->store($category);

            $categoriesWithSubCateogry = $category->subCategories;

            return response()->json(['data'=>$categoriesWithSubCateogry , 'status'=>200 , 'meesage'=>'Get Sub Category Success']);
        }catch (\Exception $exception){
            return response()->json(['data'=>'' , 'status'=>500 , 'meesage'=>'Get Sub Category Failed : ' .$exception->getMessage()]);
        }
    }
}
