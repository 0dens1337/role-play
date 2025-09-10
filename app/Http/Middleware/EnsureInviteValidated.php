<?php

namespace App\Http\Middleware;

use App\Models\InviteCode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureInviteValidated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookie = $request->cookie('invite_code');
        if (! $cookie) {
            return response()->json([
                'message' => 'Сначала введите invite code',
            ], Response::HTTP_BAD_REQUEST);
        }

        $code = decrypt($cookie);
        $inviteCode = InviteCode::query()->where('code', $code)->first();
        if (! $inviteCode) {
            return response()->json([
                'message' => 'Не верный invite code',
            ], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
