<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use CodeDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class OAuthCheckRole
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string                   $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $authenticated_id = Authorizer::getResourceOwnerId();
        $user             = $this->userRepository->find($authenticated_id);

        if ($user->role != $role) {
            abort(403, 'Access Forbidden');
        }

        return $next($request);
    }
}
