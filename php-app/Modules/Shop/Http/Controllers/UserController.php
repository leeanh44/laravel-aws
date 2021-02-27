<?php

namespace Modules\Shop\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Shop\Contracts\Services\UserService;
use Modules\Shop\Http\Requests\FilterUserRequest;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * List resource
     *
     * @param FilterUserRequest $request
     * @return \Illuminate\View\View
     */
    public function index(FilterUserRequest $request)
    {
        $users = $this->userService->list($request->onlyFields());

        return view('shop::users.index', compact('users'));
    }
}
