<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineSearchController extends Controller
{
    public function searchByName(Request $request)
    {
        $query = $request->input('query');
        $drugs = Medicine::search($query)->get();

        if ($drugs->isEmpty()) {
            return response()->json(['message' => 'No medicines found']);
        }

        $drug = $drugs->first();
        $alternatives = Medicine::search($drug->name)
            ->where('id', '!=', $drug->id)
            ->get();

        return response()->json([
            'drug' => $drug,
            'alternatives' => $alternatives
        ]);
    }

    public function searchByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        $drugs = Medicine::where('category_id', $categoryId)->get();

        if ($drugs->isEmpty()) {
            return response()->json(['message' => 'No medicines found']);
        }

        return response()->json(['drugs' => $drugs]);
    }

    public function searchByCompany(Request $request)
    {
        $company = $request->input('company');
        $drugs = Medicine::search($company)->get();

        if ($drugs->isEmpty()) {
            return response()->json(['message' => 'No medicines found']);
        }

        return response()->json(['drugs' => $drugs]);
    }
}
