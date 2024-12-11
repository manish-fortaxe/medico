<?php

namespace App\Enums\ViewPaths\Admin;

enum MoleculeFAQ
{
    const LIST = [
        URI => 'view',
        VIEW => 'admin-views.molecule-faq.view'
    ];

    const STORE = [
        URI => 'store',
        VIEW => ''
    ];

    const UPDATE = [
        URI => 'update',
        VIEW => 'admin-views.molecule-faq.edit'
    ];

    const DELETE = [
        URI => 'delete',
        VIEW => ''
    ];
}
