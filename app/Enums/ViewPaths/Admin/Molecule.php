<?php

namespace App\Enums\ViewPaths\Admin;

enum Molecule
{
    const LIST = [
        URI => 'list',
        VIEW => 'admin-views.molecule.list'
    ];
    const ADD = [
        URI => 'add-new',
        VIEW => 'admin-views.molecule.add-new'
    ];

    const UPDATE = [
        URI => 'update',
        VIEW => 'admin-views.molecule.edit'
    ];

    const DELETE = [
        URI => 'delete',
        VIEW => ''
    ];

    const STATUS = [
        URI => 'status-update',
        VIEW => ''
    ];

    const EXPORT = [
        URI => 'export',
        VIEW => ''
    ];
}
