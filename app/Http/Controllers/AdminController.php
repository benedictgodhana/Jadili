<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Feedback;
use App\Models\FeedbackCategory;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Notification;
use App\Models\Application;
class AdminController extends Controller
{
    public function index()
{
    $totalUsers = User::count();

    // Count applications for today, this week, and this month
    $applicationsToday = Application::whereDate('created_at', Carbon::today())->count();
    $applicationsThisWeek = Application::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $applicationsThisMonth = Application::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

    // Return data using Inertia
    return Inertia::render('Admin/AdminIndex', [
        'totalUsers' => $totalUsers,
        'applicationsToday' => $applicationsToday,
        'applicationsThisWeek' => $applicationsThisWeek,
        'applicationsThisMonth' => $applicationsThisMonth,
    ]);
}
    public function users(): Response
    {
        $user = auth()->user(); // Assuming you're using Laravel's authentication
        $errors = []; // Example empty errors array

        return Inertia::render('Users', [
            'auth' => [
                'user' => $user,
            ],
            'errors' => $errors,
        ]);
    }

    public function manageRoles(): Response
    {
        return Inertia::render('ManageRoles');
    }

    public function contribution()
    {
        $applications = Application::with(['user', 'applicationType', 'location', 'institution','activity'])->get(); // Fetch all applications with related data

        return Inertia::render('Contributions', [
            'applications' => $applications,
        ]);
    }

    public function dashboard(): Response
    {
        return Inertia::render('Dashboard');
    }

    public function adminProfile(): Response
    {
        return Inertia::render('Admin/Profile');
    }



    public function adminContribution(): Response
    {
        return Inertia::render('Admin/Contribution');
    }

    public function adminNotification(): Response
    {
        $notifications = Notification::with(['feedback.category', 'feedback.subcategory'])->get();
        $feedbacks = Application::with('user', 'applicationType', 'location', 'institution','activity')->get(); // Ensure you have a Feedback model

        return Inertia::render('Admin/Notifications', [
            'notifications' => $notifications,
            'feedbacks' => $feedbacks,
        ]);
    }



    public function adminSetting(): Response
    {
        return Inertia::render('Admin/Settings');
    }


    public function categoryFeedback($id)
    {
        // Fetch feedbacks for a specific category
        $category = FeedbackCategory::findOrFail($id);
        $feedbacks = $category->feedbacks;

        return Inertia::render('Feedback/CategoryFeedback', [
            'category' => $category,
            'feedbacks' => $feedbacks,
        ]);
    }

}
