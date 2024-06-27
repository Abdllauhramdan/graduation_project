<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;


class MedicineSearchController extends Controller
{
    /**
     * Search for medicines by name.
     *
     * @param Request $request The HTTP request object containing the query parameter.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the drug and its alternatives.
     */
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

    /**
     * Search for medicines by category.
     *
     * @param Request $request The HTTP request object containing the category_id parameter.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the drugs matching the category.
     */
    public function searchByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        $drugs = Medicine::where('category_id', $categoryId)->get();

        if ($drugs->isEmpty()) {
            return response()->json(['message' => 'No medicines found']);
        }

        return response()->json(['drugs' => $drugs]);
    }

    /**
     * Search for medicines by company.
     *
     * @param Request $request The HTTP request object containing the company parameter.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the drugs matching the company.
     */
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
