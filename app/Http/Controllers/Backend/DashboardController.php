<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\JobApplicationDetail;
use App\Models\JobBoard;
use App\Models\Like;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $registeredAlumniCount = User::query()
            ->where('role_id', Role::ROLE_ALUMNI)
            ->count();

        $registeredStudentCount = User::query()
            ->where('role_id', Role::ROLE_STUDENT)
            ->count();

        $totalJobPostCount = JobBoard::query()
            ->when(isAlumni(), function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->count();

        $totalJobApplicationCount = JobApplicationDetail::query()
            ->with('jobBoard')
            ->when(isAlumni(), function ($query) {
                $query->whereRelation('jobBoard', 'user_id', auth()->user()->id);
            })
            ->when(isStudent(), function ($query) {
                $query->where('applied_by', auth()->user()->id);
            })
            ->count();

            $postCount = Post::query()
            ->when(isAlumni() || isStudent(), function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->count();

            $commentCount = Comment::query()
            ->when(isAlumni() || isStudent(), function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->count();

            $reactCount = Like::query()
            ->when(isAlumni() || isStudent(), function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->count();

        return view('dashboard', [
            'registeredAlumniCount' => $registeredAlumniCount,
            'registeredStudentCount' => $registeredStudentCount,
            'totalJobPostCount' => $totalJobPostCount,
            'totalJobApplicationCount' => $totalJobApplicationCount,
            'postCount' => $postCount,
            'commentCount' => $commentCount,
            'reactCount' => $reactCount,
        ]);
    }

    public function jobApplicationList()
    {
        $userId = auth()->user()->id;

        $jobApplications = JobApplicationDetail::query()
            ->with(['jobBoard'])
            ->where('applied_by', $userId)
            ->latest()
            ->paginate(10);

        return view('backend.job-board.job-applications-list', compact('jobApplications'));
    }
}
