<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobApplicationDetail;
use App\Models\JobBoard;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobBoardController extends Controller
{
    public function index(Request $request)
    {
        $jobBoards = JobBoard::query()
            ->with('user')
            ->search($request->search)
            ->latest()
            ->paginate(10);

        return view('frontend.job-board.index', [
            'jobBoards' => $jobBoards,
        ]);
    }

    public function show(Request $request, $id)
    {
        $jobBoard = JobBoard::query()->findOrFail($id);

        $isAppliedOnThisJob = $this->isAppliedOnThisJob($id);

        $isDeadlineOver = $this->isDeadlineOver($jobBoard);


        return view('frontend.job-board.single-view', [
            'jobBoard' => $jobBoard,
            'isAppliedOnThisJob' => $isAppliedOnThisJob,
            'isDeadlineOver' => $isDeadlineOver,
        ]);
    }

    public function isAppliedOnThisJob($id): bool
    {
        $userId = Auth::user()->id;
        return JobApplicationDetail::query()
            ->where('job_board_id', $id)
            ->where('applied_by', $userId)
            ->exists();
    }

    public function isDeadlineOver($jobBoard): bool
    {
        $applicationDeadline = Carbon::parse($jobBoard->application_deadline);

        if (now()->gt($applicationDeadline)) {
            return true;
        }
        return false;
    }

    public function applyJobView(Request $request, $id)
    {
        $jobPostId = $id ?? null;
        $userId = $request->get('user_id') ?? null;

        return view('frontend.job-board.apply-job', [
            'jobPostId' => $jobPostId,
            'userId' => $userId,
        ]);
    }

    public function applyJob(Request $request): RedirectResponse
    {
        $request->validate([
            'resume_path' => 'required',
        ],
        [
            'resume_path.required' => 'Resume/Cv must be required'
        ]);

        $resumePath = $request->file("resume_path") ?? null;
        $linkedinUrl = $request->get("linkedin_url") ?? null;
        $githubUrl = $request->get("github_url") ?? null;
        $portfolioUrl = $request->get("portfolio_url") ?? null;
        $jobBoardId = $request->get("job_board_id") ?? null;
        $appliedBy = $request->get("applied_by") ?? null;

        if ($resumePath) {

            try {
                $filename = now()->format('d-m-Y-') . $resumePath->getClientOriginalName();
                $fileNameExpload = explode('.', $filename);
                $getExtension = last($fileNameExpload);

                if ($getExtension != "pdf") {
                    throw new \Exception("File must be a PDF");
                }

                $jobApplication = new JobApplicationDetail();
                $resumePath->move(public_path('/job-application/pdf'), $filename);
                $jobApplication->resume_path = $filename;
                $jobApplication->linkedin_url = $linkedinUrl;
                $jobApplication->github_url = $githubUrl;
                $jobApplication->portfolio_url = $portfolioUrl;
                $jobApplication->job_board_id = $jobBoardId;
                $jobApplication->applied_by = $appliedBy;
                $jobApplication->applied_date = now();
                $jobApplication->save();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'File must be a PDF');
            }

        }

        return redirect()->back()->with('success', 'Job Application Proceed Successfully!');

    }
}
