<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AdminDashboardController extends Controller
{
    public function stats(): JsonResponse
    {
        $totalCourses = Course::count();
        $publishedCourses = Course::where('is_published', true)->count();
        $totalCategories = Category::count();
        $totalStudents = User::where('role', 'free')->orWhere('role', 'premium')->count();
        $premiumStudents = User::where('role', 'premium')->count();
        $totalRevenue = Transaction::where('payment_status', 'settlement')->sum('amount');
        $pendingTransactions = Transaction::where('payment_status', 'pending')->count();
        $recentTransactions = Transaction::with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'data' => [
                'total_courses' => $totalCourses,
                'published_courses' => $publishedCourses,
                'unpublished_courses' => $totalCourses - $publishedCourses,
                'total_categories' => $totalCategories,
                'total_students' => $totalStudents,
                'premium_students' => $premiumStudents,
                'total_revenue' => $totalRevenue,
                'pending_transactions' => $pendingTransactions,
                'recent_transactions' => $recentTransactions->map(fn ($t) => [
                    'id' => $t->id,
                    'order_id' => $t->order_id,
                    'amount' => $t->amount,
                    'payment_status' => $t->payment_status,
                    'user_name' => $t->user->name ?? 'N/A',
                    'course_title' => $t->course->title ?? 'N/A',
                    'created_at' => $t->created_at,
                ]),
            ],
        ]);
    }
}
