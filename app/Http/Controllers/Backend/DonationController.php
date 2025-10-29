<?php

namespace App\Http\Controllers\Backend;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BackendDonationRequest;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'sometimes|required|string',
        ]);

        $query = Donation::query()->search($request->search);

        // Filter donations for alumni to show only their own
        if (auth()->user()->role->id == \App\Models\Role::ROLE_ALUMNI) {
            $query->where('user_id', auth()->id());
        }

        $donations = $query->latest()->paginate(15);

        $donations->getCollection()->transform(function ($donation) {
            $donation->create_date = date('d M Y', strtotime($donation->created_at));
            $donation->status_label = $donation->status_label;
            return $donation;
        });

        return view('backend.donation.index', compact('donations'));
    }

    public function create()
    {
        return view('backend.donation.create_update', [
            'donation' => null,
        ]);
    }

    public function store(BackendDonationRequest $request, Donation $donation)
    {
        $donation->fill($request->validated() + [
            'user_id' => auth()->id(),
            'created_by' => auth()->id(),
        ])->save();

        $route = auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? 'donations.index' : 'alumni.donations.index';

        return redirect()
            ->route($route)
            ->with('success', 'Donation created successfully');
    }

    public function show(Donation $donation)
    {
        if (auth()->user()->role->id == \App\Models\Role::ROLE_ALUMNI && $donation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('backend.donation.show', [
            'donation' => $donation,
        ]);
    }

    public function edit(Donation $donation)
    {
        if (auth()->user()->role->id == \App\Models\Role::ROLE_ALUMNI && $donation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('backend.donation.create_update', [
            'donation' => $donation,
        ]);
    }

    public function update(BackendDonationRequest $request, Donation $donation)
    {
        if (auth()->user()->role->id == \App\Models\Role::ROLE_ALUMNI && $donation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $donation->update($request->validated() + [
            'updated_by' => auth()->id(),
        ]);

        $route = auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? 'donations.index' : 'alumni.donations.index';

        return redirect()
            ->route($route)
            ->with('success', 'Donation updated successfully');
    }

    public function destroy(Donation $donation)
    {
        if (auth()->user()->role->id == \App\Models\Role::ROLE_ALUMNI && $donation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $donation->delete();

        $route = auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? 'donations.index' : 'alumni.donations.index';

        return redirect()
            ->route($route)
            ->with('success', 'Donation deleted successfully');
    }
}