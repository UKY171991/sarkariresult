<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['role'])) {
            $user = auth()->user();
            
            if (!$user) {
                return false;
            }
            
            // Check if user has the required role
            if ($item['role'] === 'admin' && $user->role !== 'admin') {
                return false;
            }
            
            if ($item['role'] === 'user' && $user->role === 'admin') {
                return false;
            }
        }
        
        return $item;
    }
}
