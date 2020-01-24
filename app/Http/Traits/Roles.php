<?php


namespace App\Http\Traits;

trait Roles
{
    private $dashboardRoles = ['super-admin', 'admin', 'editor'];

    public function getDashboardRoles()
    {
        return $this->dashboardRoles;
    }
}