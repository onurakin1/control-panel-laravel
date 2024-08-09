<?php

namespace App\Http\Controllers;

use App\Models\CategoryMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CategoryMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryMenu::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'branch_id' => 'required',
            'name' => 'required|max:255',
            'language_id' => 'required',
            'image' => 'required',
            'created_date' => 'nullable|date',
        ]);
        $today = Carbon::today();

        $fields['created_date'] = $today;

        $categoryMenu = CategoryMenu::create([
            'language_id' => $request->language_id,
            'branch_id' => $request->branch_id,
            'image' => $request->image,
            'name' => $request->name,
            'created_date' => $today

        ]);


        return $categoryMenu;
    }

    /**
     * Display the specified resource.
     */
    public function show($branch_id)
    {
        $categoryMenu = CategoryMenu::where('branch_id', $branch_id)
            ->get();

        return response()->json($categoryMenu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $categoryMenu = CategoryMenu::findOrFail($id);
        $categoryMenu->update($request->all());
        return response()->json($categoryMenu);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoryMenu = CategoryMenu::findOrFail($id);
        $categoryMenu->delete();

        return response()->json(['message' => 'Menu Deleted']);
    }
}
