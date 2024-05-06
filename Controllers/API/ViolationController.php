<?php

namespace App\Http\Controllers\API;

use App\Models\ViolationCategory;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    public function getKeywords()
    {
        try {
            $violationCategory = ViolationCategory::firstOrFail();
            $keywords = collect($violationCategory->toArray())
                ->except(['id', 'created_at', 'updated_at'])
                ->values()
                ->filter()
                ->toArray();

            return response()->json($keywords);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch violation keywords', 'error' => $e->getMessage()], 500);
        }
    }
}
