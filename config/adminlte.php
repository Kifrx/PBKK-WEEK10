<?php

return [
    'title' => 'Portal Akademik ITS',
    'logo' => 'Portal Akademik ITS',
    'logo_img' => 'logo-its.png',
    'logo_img_alt' => 'Lambang ITS',
    'logo_img_class' => 'brand-image',
    'classes_brand_text' => 'fw-semibold',
    'classes_sidebar' => 'academic-sidebar',
    'classes_topnav' => 'academic-topbar',
    'color_mode' => [
        'enabled' => false,
        'default' => 'light',
        'remember' => false,
        'routes' => false,
    ],
    'dashboard_url' => 'admin/dashboard',
    'logout_url' => 'logout',
    'logout_method' => 'POST',
    'menu' => [
        ['text' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'bi bi-speedometer2', 'can' => 'lihat-data'],
        ['text' => 'Mahasiswa', 'route' => 'admin.mahasiswa.index', 'icon' => 'bi bi-mortarboard', 'can' => 'lihat-data'],
        ['text' => 'Dosen', 'route' => 'admin.dosen.index', 'icon' => 'bi bi-person-badge', 'can' => 'lihat-data'],
        ['text' => 'Tugas', 'route' => 'admin.tugas.index', 'icon' => 'bi bi-list-task', 'can' => 'lihat-data'],
        ['text' => 'Departemen', 'route' => 'admin.departemen.index', 'icon' => 'bi bi-building', 'can' => 'lihat-data'],
    ],
];
