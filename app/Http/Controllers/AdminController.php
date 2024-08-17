<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Feedback;
use App\Models\FeedbackCategory;
use App\Models\User;
use Carbon\Carbon;
use App\Models\UssdResponse;
use App\Models\EducationalMaterial;
use App\Models\Notification;
use App\Models\Application;
use App\Models\PublicEngagement;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch counts for users, USSD responses, and educational materials
        $totalUsers = User::count();
        $totalUssdResponses = UssdResponse::count();
        $totalEducationalMaterials = EducationalMaterial::count();

        $usersSubmittedToday = UssdResponse::whereDate('created_at', today())->distinct('user_id')->count('user_id');
        // Count applications for today, this week, and this month
        $engagementsToday = PublicEngagement::whereDate('created_at', today())->count();
        // Return data using Inertia
        return Inertia::render('Admin/AdminIndex', [
            'totalUsers' => $totalUsers,
            'totalUssdResponses' => $totalUssdResponses,
            'totalEducationalMaterials' => $totalEducationalMaterials,
            'usersSubmittedToday' => $usersSubmittedToday,
            'engagementsToday' => $engagementsToday,

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
