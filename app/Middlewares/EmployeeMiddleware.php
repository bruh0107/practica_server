<?php

namespace Middlewares;

use Src\Request;

class EmployeeMiddleware
{
    public function handle(Request $request)
    {
        if (!app()->auth::user()->isEmployee()){
            app()->route->redirect('/');
        }
    }
}