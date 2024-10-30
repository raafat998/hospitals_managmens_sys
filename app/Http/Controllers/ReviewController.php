<?php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $reviews = Review::with(['user', 'property'])->get();
            return response()->json(['data' => $reviews, 'authenticated_user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve reviews', 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'content' => 'required|string|max:255',

        ]);
    
        // إنشاء مراجعة جديدة
        $review = new Review();
        $review->user_id = $validatedData['user_id'];
        $review->property_id = $validatedData['property_id'];
        $review->content = $validatedData['content'];
       
        // حفظ المراجعة في قاعدة البيانات
        $review->save();
    
        // إعادة التوجيه أو عرض رسالة نجاح
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function show(Review $review)
    {
        try {
            $review->load(['user', 'property']);
            return response()->json(['data' => $review], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve review', 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }

    public function update(Request $request, Review $review)
    {
        try {
            $validatedData = $request->validate([
                'content' => 'sometimes|string',
                'user_id' => 'sometimes|exists:users,id',
                'property_id' => 'sometimes|exists:properties,id',
            ]);

            $review->update($validatedData);

            return response()->json(['data' => $review, 'message' => 'Review updated successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation Error', 'messages' => $e->errors(), 'trace' => $e->getTraceAsString()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update review', 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }

    public function destroy(Review $review)
    {
        try {
            $review->delete();
            return response()->json(['message' => 'Review deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete review', 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }
}
