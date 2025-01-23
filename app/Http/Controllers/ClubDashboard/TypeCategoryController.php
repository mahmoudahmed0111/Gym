<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;
use App\Models\TypeCategory;
use Illuminate\Http\Request;
use MultipleIterator;

class TypeCategoryController extends Controller
{

    public function index(Request $request)
    {
        $data = TypeCategory::where("club_id",auth("club")->id())->get();
        return view("club-dashboard.type_category.index", compact("data"));
    }


    public function create()
    {
        $categories =  auth("club")->user()->categories;
        return view("club-dashboard.type_category.create",compact('categories'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price'=>"required",
        ]);
        $data = $request->all();
        $data['club_id'] = auth("club")->id();
        $model = TypeCategory::create($data);

        return redirect(route('club.type_category.index'))->with('success', __('models.added_successfully'));
    }


    public function show($id)
    {
        $data = TypeCategory::find($id);
        return view("club-dashboard.type_category.show", compact("data"));
    }


    public function edit($id)
    {
        $data = TypeCategory::find($id);
        $categories =  auth("club")->user()->categories;
        return view("club-dashboard.type_category.edit",compact('categories','data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price'=>"required",
        ]);
        $model = TypeCategory::find($id);
        $data = $request->all();
        $data['club_id'] = auth("club")->id();
        $model->update($data);
        return redirect(route('club.type_category.index'))->with('success', __('models.edited_successfully'));
    }


    public function destroy($id)
    {
        $model = TypeCategory::find($id);
        $model->delete();
        return redirect(route('club.type_category.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $model = TypeCategory::find($id);
            if ($model) {
                $model->delete();
            }
        }
        return response()->json(['success' => true]);
    }
}
