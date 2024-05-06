<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    // Method to fetch categories with optional filtering by name
    public function index(Request $request)
    {
        $name = $request->query('name');
        $categories = Category::where('name', 'like', "%$name%")->get();
        return response()->json($categories);
    }

    // Method to save a new category
    public function save(Request $request)
    {
        // Validate request data if necessary
        $request->validate([
            'name' => 'required|string|max:255', // Add more validation rules if needed
        ]);

        // Create a new category with the provided name
        $category = Category::create(['name' => $request->name]);
        return response()->json($category, 201); // Return the newly created category as JSON response with status 201 (Created)
    }

    // Method to update an existing category
    public function update($id, Request $request)
    {
        // Validate request data if necessary
        $request->validate([
            'name' => 'required|string|max:255', // Add more validation rules if needed
        ]);

        // Find the category by id and update its name
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        return response()->json($category, 200); // Return the updated category as JSON response with status 200 (OK)
    }

    // Method to delete an existing category
    public function delete($id)
    {
        // Find the category by id and delete it
        $category = Category::find($id);
        $category->delete();
        return response()->json(null, 204); // Return empty response with status 204 (No Content) indicating successful deletion
    }

    // Method to fetch a single category by ID
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($category, Response::HTTP_OK);
    }
}
