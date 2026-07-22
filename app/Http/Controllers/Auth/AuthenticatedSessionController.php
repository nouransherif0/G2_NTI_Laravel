<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('front.auth.login');
    }

    #[OA\Post(
        path: '/login',
        summary: 'Login user',
        description: 'Authenticate a user and create a session.',
        tags: ['Authentication'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 204, description: 'Successfully authenticated (or 302 Redirect)'),
            new OA\Response(response: 422, description: 'Validation error / Invalid credentials')
        ]
    )]
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(route('home', absolute: false));
    }

    #[OA\Post(
        path: '/logout',
        summary: 'Logout user',
        description: 'Destroy the authenticated session.',
        tags: ['Authentication'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 204, description: 'Successfully logged out (or 302 Redirect)')
        ]
    )]
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
