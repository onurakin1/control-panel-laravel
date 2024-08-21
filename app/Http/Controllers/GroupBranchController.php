<?php

namespace App\Http\Controllers;

use App\Models\GroupBranch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GroupBranch::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'branch_name' => 'required|max:255',
            'branch_name_summary' => 'required',
            'branch_price_type' => 'required',
            'branch_city' => 'required',
            'branch_address' => 'required',
            'branch_phone' => 'required',
            'branch_mail' => 'required',

        ]);

        $fields['branch_group_id'] = GroupBranch::max('branch_group_id') + 1;

        $groupBranch = GroupBranch::create($fields);

        return $groupBranch;
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupBranch $groupBranch)
    {
        return $groupBranch;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupBranch $groupBranch)
    {
        $fields = $request->validate([
            'branch_name' => 'required|max:255',
            'branch_name_summary' => 'required',
            'branch_price_type' => 'required',
            'branch_city' => 'required',
            'branch_address' => 'required',
            'branch_phone' => 'required',
            'branch_mail' => 'required',
        ]);

        $groupBranch->update($fields);

        return $groupBranch;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupBranch $groupBranch)
    {
        $groupBranch->delete();

        return ['message' => 'Group Branch Deleted'];
    }
}
