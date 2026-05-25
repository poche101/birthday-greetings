<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Throttle settings
    |--------------------------------------------------------------------------
    */
    protected int $maxAttempts  = 5;
    protected int $decaySeconds = 60;

    /*
    |--------------------------------------------------------------------------
    | Error messages (hardcoded — no lang file dependency)
    |--------------------------------------------------------------------------
    */
    private const MSG_INVALID     = 'The email address or password you entered is incorrect.';
    private const MSG_THROTTLED   = 'Too many failed attempts. Please wait :seconds seconds before trying again.';
    private const MSG_FIELD_EMAIL = 'Please check your email address.';
    private const MSG_FIELD_PASS  = 'Please check your password.';

    // =========================================================================

    /**
     * GET /admin/login  →  admin.login
     *
     * Renders resources/views/admin/login.blade.php
     * The view expects:
     *   $errors->any()           → single banner at the top
     *   $errors->has('email')    → is-invalid on the email input
     *   $errors->has('password') → is-invalid on the password input
     */
    public function showLogin(): View
    {
        return view('login');
    }

    // =========================================================================

    /**
     * POST /admin/login  →  admin.login.post
     *
     * Form fields (from admin/login.blade.php):
     *   name="email"    — required, valid e-mail
     *   name="password" — required
     *   name="remember" — checkbox (boolean: "on" | null)
     */
    public function login(Request $request): RedirectResponse
    {
        // ── Step 1: Field-level validation ───────────────────────────────────
        // Errors here immediately highlight the relevant input with is-invalid
        // and show the message inside $errors->first() in the top banner.
        $request->validate([
            'email'    => ['required', 'string', 'email:rfc'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'Your email address is required.',
            'email.email'       => 'Please enter a valid email address.',
            'password.required' => 'Your password is required.',
        ]);

        // ── Step 2: Rate limiting (brute-force protection) ────────────────────
        $key = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            $message = str_replace(':seconds', $seconds, self::MSG_THROTTLED);

            // Highlight both fields + fill the banner
            throw ValidationException::withMessages([
                'email'    => $message,
                'password' => $message,
            ]);
        }

        // ── Step 3: Attempt login against the 'admin' guard ──────────────────
        $success = Auth::guard('admin')->attempt(
            [
                'email'    => $request->string('email')->lower()->trim()->toString(),
                'password' => $request->input('password'),
            ],
            $request->boolean('remember')  // converts checkbox "on" / null → true / false
        );

        // ── Step 4a: Wrong credentials ────────────────────────────────────────
        if (! $success) {
            RateLimiter::hit($key, $this->decaySeconds);

            // Both fields get is-invalid in the view.
            // The banner shows $errors->first() which will be MSG_INVALID.
            // We attach the same message to 'email' (shown in banner) and a
            // shorter hint to 'password' (highlights the field silently).
            throw ValidationException::withMessages([
                'email'    => self::MSG_INVALID,
                'password' => self::MSG_FIELD_PASS,
            ]);
        }

        // ── Step 4b: Authenticated successfully ───────────────────────────────
        RateLimiter::clear($key);
        $request->session()->regenerate();   // prevent session-fixation

        return redirect()
            ->intended(route('admin.dashboard'))
            ->with('success', 'Welcome back! You are now signed in.');
    }

    // =========================================================================

    /**
     * POST /admin/logout  →  admin.logout
     *
     * Sidebar form:
     *   <form method="POST" action="{{ route('admin.logout') }}">@csrf</form>
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();        // destroy session data
        $request->session()->regenerateToken();   // rotate CSRF token

        return redirect()
            ->route('admin.login')
            ->with('success', 'You have been signed out successfully.');
    }

    // =========================================================================
    // Helpers
    // =========================================================================

    /**
     * Unique throttle key = lowercase(email) + "|" + client IP.
     *
     * Lowercasing + transliterating prevents bypass via casing tricks
     * e.g. "Admin@..." vs "admin@..." treated as the same account.
     */
    private function throttleKey(Request $request): string
    {
        $email = Str::lower(
            Str::transliterate((string) $request->input('email', ''))
        );

        return $email . '|' . $request->ip();
    }
}
