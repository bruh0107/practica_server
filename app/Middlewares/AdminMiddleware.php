<?php

namespace Middlewares;

use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request)
    {
        if (!app()->auth::user()->isAdmin()){
            app()->route->redirect('/');
        }
    }
}