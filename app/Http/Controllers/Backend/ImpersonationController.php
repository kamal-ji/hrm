<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ImpersonationController extends Controller
{
    // Only admins can impersonate
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Start impersonation
     */
    public function impersonate(User $user)
    {
        $admin = Auth::user();

        // Prevent self impersonation
        if ($admin->id === $user->id) {
            return back()->with('error', 'You cannot impersonate yourself.');
        }

        // Prevent nested impersonation
        if (app('impersonate')->isImpersonating()) {
            return back()->with('error', 'Already impersonating another user.');
        }

        // Permission check (important)
        if (!$admin->canImpersonate() || !$user->canBeImpersonated()) {
            abort(403);
        }

        // Start impersonation
        $admin->impersonate($user);

        return redirect()->route('dashboard')
            ->with('success', "Now impersonating {$user->first_name}");
    }

    /**
     * Stop impersonation and return to admin
     */

    public function stopImpersonation()
    {
        if (!app('impersonate')->isImpersonating()) {
            return redirect()->back()->with('error', 'You are not impersonating anyone.');
        }

        app('impersonate')->leave();

        return redirect()->route('dashboard')->with('success', 'You have stopped impersonation.');
    }
}
