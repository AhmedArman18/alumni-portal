<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JobApplicationDetail;
use App\Models\JobBoard;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class AdminJobBoardController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role->name == 'Admin') {
            $jobBoardList = JobBoard::query()
                ->search($request->search)
//            ->where('user_id', auth()->user()->id)
                ->latest()
                ->paginate(10);
        } else {
            $jobBoardList = JobBoard::query()
                ->search($request->search)
                ->where('user_id', auth()->user()->id)
                ->latest()
                ->paginate(10);
        }


        return view('backend.job-board.index', [
            'jobBoardList' => $jobBoardList,
        ]);
    }

    public function create()
    {
        return view('backend.job-board.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "company_name" => 'required',
            "title" => 'required',
            "description" => 'required',
            "job_type" => 'required',
            "salary" => 'required|numeric',
            "location" => 'required',
            "application_deadline" => 'required',
        ]);

        JobBoard::query()
            ->create($request->all() + ['user_id' => auth()->user()->id]);

        return redirect()->back()->with('success', 'Job Post Created Successfully!');
    }

    public function edit($id)
    {
        if (auth()->user()->role->name == 'Admin') {
            $jobBoard = JobBoard::query()
                ->where('id', $id)
                ->first();
        } else {
            $jobBoard = JobBoard::query()
                ->where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();
        }

        return view('backend.job-board.edit', [
            'jobBoard' => $jobBoard,
        ]);
    }

    public function show()
    {

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "company_name" => 'required',
            "title" => 'required',
            "description" => 'required',
            "job_type" => 'required',
            "salary" => 'required|numeric',
            "location" => 'required',
            "application_deadline" => 'required',
        ]);

        if (auth()->user()->role->name == 'Admin') {
            $jobBoard = JobBoard::query()
                ->where('id', $id)
                ->first();
        } else {
            $jobBoard = JobBoard::query()
                ->where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();
        }


        $jobBoard->update($request->all() + ['user_id' => auth()->user()->id]);

        return redirect()->back()->with('success', 'Job Post Updated Successfully!');
    }

    public function destroy($id): RedirectResponse
    {
        if (auth()->user()->role->name == 'Admin') {
            $jobBoard = JobBoard::query()
                ->where('id', $id)
                ->first();
        } else {
            $jobBoard = JobBoard::query()
                ->where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();
        }


        if($jobBoard) {
            $jobBoard->delete();
            return redirect()->back()->with('success', 'Job Post Deleted Successfully!!');
        }
        else {
            return redirect()->back()->with('error', 'Job Post Delete Failed!!');
        }
    }

    public function applicantsIndex(Request $request)
    {
        $users = User::all();
        $jobApplicantsList = JobApplicationDetail::query()
            ->with([
                'user',
            ])
            ->whereHas('jobBoard', function ($query) {
                $query->where('approve_status', 'yes')
                    ->where('user_id', auth()->user()->id);;
            })
//
            ->get()
            ->map(function ($jobApplication) use ($users) {

                $applicantsName = collect($users)->where('id', $jobApplication->applied_by)->first();

                return [
                    'id' => $jobApplication->id,
                    'company_name' => $jobApplication->jobBoard->company_name,
                    'job_title' => $jobApplication->jobBoard->title,
                    'application_deadline' => Carbon::parse($jobApplication->jobBoard->application_deadline)->format('d-m-Y'),
                    'applicants_name' => $applicantsName->name,
                    'applied_date' => Carbon::parse($jobApplication->applied_date)->format('d-m-Y g:i:s a'),
                    'resume_path' => $jobApplication->resume_path,
                ];
            });

//        dd($jobApplicantsList);

        return view('backend.job-board.applicants', [
            'jobApplicantsList' => $jobApplicantsList,
        ]);
    }


    public function applicantsIndexForAdmin()
    {
        $users = User::all();
        $jobApplicantsList = JobApplicationDetail::query()
            ->with([
                'user',
            ])
            ->whereHas('jobBoard', function ($query) {
                $query->where('approve_status', 'yes')
                    ->where('user_id', auth()->user()->id);;
            })
//
            ->get()
            ->map(function ($jobApplication) use ($users) {

                $applicantsName = collect($users)->where('id', $jobApplication->applied_by)->first();

                return [
                    'id' => $jobApplication->id,
                    'company_name' => $jobApplication->jobBoard->company_name,
                    'job_title' => $jobApplication->jobBoard->title,
                    'application_deadline' => Carbon::parse($jobApplication->jobBoard->application_deadline)->format('d-m-Y'),
                    'applicants_name' => $applicantsName->name,
                    'applied_date' => Carbon::parse($jobApplication->applied_date)->format('d-m-Y g:i:s a'),
                    'resume_path' => $jobApplication->resume_path,
                ];
            });

        return view('backend.job-board.applicantslist-for-admin', [
            'jobApplicantsList' => $jobApplicantsList,
        ]);
    }


    /**
     * @throws FileNotFoundException
     */
    public function downloadCV(Request $request)
    {
        return Response::download(public_path("/job-application/pdf/".$request->get('file')));
    }

    public function downloadCVForAdmin(Request $request)
    {
        return Response::download(public_path("/job-application/pdf/".$request->get('file')));
    }
}
