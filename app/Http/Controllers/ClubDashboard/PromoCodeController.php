<?php

namespace App\Http\Controllers\ClubDashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\TypeCategory;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
    {
        $data = PromoCode::where('owner_type', get_class(auth("club")->user()))->where('owner_id', auth("club")->user()->id)->where('start_date', '<=', now())->where('end_date', '>=', now())->latest()->get();
        return view('club-dashboard.promo_codes.index', compact('data'));
    }

    public function create()
    {
        $categories = auth('club')->user()->categories;
        $products = Product::all(); // Assuming you have a Product model
        $typeCategories = TypeCategory::where("club_id",auth("club")->user()->id)->get(); // Assuming you have a TypeCategory model

        return view('club-dashboard.promo_codes.create', compact('categories', 'products', 'typeCategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:promo_codes,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'nullable|exists:categories,id',
            // 'product_id' => 'nullable|exists:products,id',
            'type_category_id' => 'nullable|exists:type_categories,id',
            // 'applicable_scope' => 'nullable|in:booking,product',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $validatedData["applicable_scope"]="booking";
        $validatedData["owner_type"]=get_class(auth("club")->user());
        $validatedData["owner_id"]=auth("club")->user()->id;
        $promoCode =  PromoCode::create($validatedData);

        // Handle file upload if exists
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = UploadImage($file ,"PromoCodes");
            $promoCode->img = $filename;
        }
        $promoCode->save();
        return redirect()->route('club.promo_codes.index')
                        ->with('success', 'Promo code created successfully!');
    }


    public function edit($id)
    {
        $data = PromoCode::findOrFail($id);
        $categories = auth('club')->user()->categories;
        $products = Product::all(); // Assuming you have a Product model
        $typeCategories = TypeCategory::where("club_id",auth("club")->user()->id)->get(); // Assuming you have a TypeCategory model

        return view('club-dashboard.promo_codes.edit', compact('data', 'categories',"typeCategories" ,"products"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:promo_codes,code,'. $id,
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'nullable|exists:categories,id',
            'product_id' => 'nullable|exists:products,id',
            'type_category_id' => 'nullable|exists:type_categories,id',
            'applicable_scope' => 'nullable|in:booking,product',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $PromoCode = PromoCode::findOrFail($id);
        $data = $request->all();
        $data["applicable_scope"]="booking";
        $data["owner_type"]=get_class(auth("club")->user());
        $data["owner_id"]=auth("club")->user()->id;
        if ($request->hasFile('img')) {
            $data['img'] = UploadImage($request->file('img'), 'PromoCodes');
        }

        $PromoCode->update($data);

        return redirect()->route('club.promo_codes.index')->with('success', __('models.edited_successfully'));
    }


    public function destroy($id)
    {
        $admin = PromoCode::find($id);
        $admin->delete();
        return redirect(route('club.promo_codes.index'))->with('success', __('models.deleted_successfully'));

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        // return response()->json(['success' => true ,"ids"=> $ids]);
        foreach ($ids as $id) {
            $admin = PromoCode::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json(['success' => true]);
    }

    public function toggleActivation(Request $request)
    {
        $model = PromoCode::findOrFail($request->id);
        $model->is_active = !$model->is_active;
        $model->save();

        return response()->json(['success' => true, 'is_active' => $model->is_active]);
    }

}
