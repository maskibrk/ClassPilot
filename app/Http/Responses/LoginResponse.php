<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }elseif (auth()->user()->isTeacher()) {
            return redirect()->route('teacher.dashboard');
        }elseif (auth()->user()->isParent()) {
            return redirect()->route('parent.dashboard');
        }elseif (auth()->user()->isStudent()) {
            return redirect()->route('student.dashboard');
        }

        return redirect()->route('dashboard');
    }
}
