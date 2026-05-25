<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use App\Http\Requests\StoreWishRequest;
use Illuminate\Http\RedirectResponse;

class WishController extends Controller
{
    /**
     * Store a newly created wish and redirect with a flash message.
     */
    public function store(StoreWishRequest $request): RedirectResponse
    {
        Wish::create([
            ...$request->validated(),
            'ip_address'  => $request->ip(),
            'is_approved' => false,
            'is_featured' => false,
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Your birthday wish has been sent! May God bless you abundantly.');
    }
}
