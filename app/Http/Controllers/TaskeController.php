<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskeRequest;
use App\Models\Category;
use App\Models\Taske;
use Illuminate\Http\Request;

class TaskeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json([
                'error' => 'Category not found',
                'message' => 'Category undifin'
            ], 404);
        }

        $tasks = $category->taskes;

        return response()->json($tasks);
    }



    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
   public function store(TaskeRequest $request, $categoryId)
{
    $user = $request->user();
    $category = $user->categories()->findOrFail($categoryId);

    
    $task = $category->taskes()->create($request->validated() + ['user_id' => $user->id]);

    return response()->json([
        'message' => 'Task created successfully',
        'task' => $task,
    ], 201);
}

    /**
     * Display the specified resource.
     */
    public function show($categoryId, Taske $taske)
    {
        if ($taske->category_id != $categoryId) {
            return response()->json(
                ['error' => 'This task does not belong to the given category'],
                404
            );
        }

        return response()->json($taske);
    }



    /** 
     * Show the form for editing the specified resource.
     */
    public function edit(Taske $taske)
    {
        return response()->json($taske);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskeRequest $request, Taske $taske)
    {
        $data = $request->validated();


        // dd($category);

       $taske->update(  $data);

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Taske $taske)
    {
        
        if ($taske->category_id !== $category->id) {
            return response()->json([
                'message' => 'This task does not belong to the given category'
            ], 400);
        }

     
        $taske->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ], 200);
    }
}
