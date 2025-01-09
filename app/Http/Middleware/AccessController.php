<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect('login')->with('error', 'You must log in to access this page.');
        }

        $routeName = $request->route()->getName(); // Get the route name
        $roles = $user->roles->pluck('name')->toArray(); // Get the user's roles as an array

        // Define permissions based on roles
        $permissions = [
            'Admin' => [
                'category.*', // Access all category routes
                'bookmark.*',  // Access all bookmark routes
            ],
            'Editor' => [
                'category.list',  // View category list
                'category.show',   // View a single category
                'bookmark.*',       // Access all bookmark routes except delete
            ],
        ];

        // Block 'Editor' from delete routes of bookmarks
        if (in_array('Editor', $roles) && str_contains($routeName, 'bookmark.delete')) {
            return back()->with('error', 'You are not authorized to delete bookmarks.');
        }

        // Block 'Editor' from all category routes if they don't also have the 'Admin' role
        if (in_array('Editor', $roles) && !in_array('Admin', $roles) && str_contains($routeName, 'category')) {
            return back()->with('error', 'You are not authorized to access category routes.');
        }

        // Block 'Admin + Editor' from delete routes of both categories and bookmarks
        if (in_array('Admin', $roles) && in_array('Editor', $roles) && (str_contains($routeName, 'category.delete') || str_contains($routeName, 'bookmark.delete'))) {
            return back()->with('error', 'You are not authorized to delete categories or bookmarks.');
        }

        // Grant access for defined roles and permissions
        foreach ($roles as $role) {
            if (isset($permissions[$role])) {
                foreach ($permissions[$role] as $allowedRoute) {
                    if (fnmatch($allowedRoute, $routeName)) {
                        return $next($request);
                    }
                }
            }
        }

        return back()->with('error', 'You are not authorized to access this route.');
    }
}
