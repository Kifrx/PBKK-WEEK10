@extends('adminlte::page')

@section('content_top_nav_right')
    <li class="nav-item d-flex align-items-center">
        <span class="academic-role">Role Anda: {{ auth()->user()->hasRole('admin') ? 'Admin' : 'Staf' }}</span>
    </li>
@stop

@section('css')
    <style>
        .app-wrapper {
            --lte-sidebar-width: 218px;
            --bs-body-color: #17232d;
            background: #edf2f5;
        }

        .academic-topbar { background: #fff; border-bottom: 1px solid #dbe4eb; }
        .app-wrapper .academic-sidebar {
            --lte-sidebar-color: #111827;
            --lte-sidebar-hover-color: #111827;
            --lte-sidebar-menu-active-color: #111827;
            --lte-sidebar-menu-active-bg: #d2f3df;
            background: #eaf0f4;
            border-right: 1px solid #dbe4eb;
        }
        .academic-sidebar .sidebar-brand { border-bottom: 1px solid #dbe4eb; }
        .academic-sidebar .brand-link,
        .academic-sidebar .brand-link .brand-text { color: #111827; font-size: .98rem; }
        .academic-sidebar .brand-image { width: 32px; height: 32px; object-fit: contain; }
        .academic-sidebar .sidebar-menu .nav-link { border-radius: .45rem; }
        .academic-sidebar .sidebar-menu .nav-link:hover { background: #dfe8ef; }
        .academic-sidebar .sidebar-menu .nav-link.active { font-weight: 600; }

        .academic-role {
            border-radius: 999px;
            background: #d2f3df;
            color: #17553c;
            padding: .3rem .7rem;
            font-size: .8rem;
            white-space: nowrap;
        }

        .app-content-header h1 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 650; }
        .app-content .card { border: 1px solid #dbe4eb; border-radius: .75rem; box-shadow: 0 2px 5px #17232d12; }
        .academic-list { overflow: hidden; }
        .academic-list .table > thead > tr > th { background: #f3f6f8; white-space: nowrap; }
        .academic-list .table > :not(caption) > * > * { padding: .55rem .75rem; }
        .academic-list .btn-outline-primary { background: #e9f3fd; }
        .academic-list .btn-outline-danger { background: #fcebec; }
        .academic-list .btn-outline-primary:hover { color: #fff; background: var(--bs-primary); }
        .academic-list .btn-outline-danger:hover { color: #fff; background: var(--bs-danger); }
        .academic-list .badge.text-bg-success { color: #17553c !important; background: #d2f3df !important; }
    </style>
@stop
