<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\View\View;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index(): View
    {
        $donations = Donation::where('status', 'active')->with('user')->paginate(10);
        $donations->getCollection()->transform(function ($donation) {
            $avatar = $donation->user->avatar ? asset('img/profile/' . $donation->user->avatar) : asset('img/avatar.jpg');
            
            $donation->description = substr($donation->description, 0, 200) . '...' ?? '';
            $donation->created_by = $donation->user->name ?? 'No Name Specified';
            $donation->create_time = $donation->created_at->diffForHumans() ?? '';
            $donation->created_by_avatar = $avatar;
            $donation->status_label = $donation->status_label ?? ucfirst($donation->status);
            $donation->amount_formatted = $donation->amount ? 'BDT ' . number_format($donation->amount, 2) : 'N/A';
            return $donation;
        });

        return view('public.donation.index', compact('donations'));
    }

    public function show(Donation $donation): View
    {
        $donation->load('user');
        $donation->created_by = $donation->user->name ?? 'No Name Specified';
        $donation->created_by_avatar = $donation->user->avatar ? asset('img/profile/' . $donation->user->avatar) : asset('img/avatar.jpg');
        $donation->create_time = $donation->created_at->diffForHumans() ?? '';
        $donation->status_label = $donation->status_label ?? ucfirst($donation->status);
        $donation->amount_formatted = $donation->amount ? 'BDT ' . number_format($donation->amount, 2) : 'N/A';
        return view('public.donation.show', compact('donation'));
    }
}