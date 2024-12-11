<?php

namespace App\Enums\ViewPaths\Admin;

enum Department
{
    const LIST = [
        URI => 'view',
        VIEW => 'admin-views.department.view'
    ];

    const STORE = [
        URI => 'store',
        VIEW => ''
    ];

    const UPDATE = [
        URI => 'update',
        VIEW => 'admin-views.department.edit'
    ];

    const DELETE = [
        URI => 'delete',
        VIEW => ''
    ];
}
