<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wish;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with all wishes.
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $query = Wish::latest();

        match ($filter) {
            'featured' => $query->featured(),
            'pending'  => $query->where('is_approved', false),
            'approved' => $query->approved(),
            default    => $query,
        };

        $wishes = $query->paginate(12)->withQueryString();

        $stats = [
            'total'    => Wish::count(),
            'approved' => Wish::approved()->count(),
            'featured' => Wish::featured()->count(),
            'pending'  => Wish::where('is_approved', false)->count(),
        ];

        return view('dashboard', compact('wishes', 'stats', 'filter'));
    }

    /**
     * Toggle the featured status of a wish.
     */
    public function toggleFeature(Wish $wish)
    {
        $wish->update(['is_featured' => ! $wish->is_featured]);

        return back()->with('success', $wish->is_featured
            ? 'Message featured successfully.'
            : 'Message unfeatured.');
    }

    /**
     * Delete a wish from the dashboard.
     */
    public function destroy(Wish $wish)
    {
        $wish->delete();
        return back()->with('success', 'Message deleted successfully.');
    }
}
