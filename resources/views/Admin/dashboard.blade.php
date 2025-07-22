@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Dashboard</h2>
    <div class="row justify-content-center">
        @php
            $menus = [
                ['name' => 'Volunteer', 'url' => url('/admin/user')],
                ['name' => 'Lokasi', 'url' => url('/admin/cabang')],
                ['name' => 'Tag', 'url' => url('/admin/tag')],
                ['name' => 'Position', 'url' => url('/admin/bagian')],
                ['name' => 'Services', 'url' => url('/admin/jadwal_ibadah')],
                ['name' => 'Schedule', 'url' => url('/admin/jadwal')],
                ['name' => 'Team', 'url' => url('/admin/tim_pelayanan')],
                ['name' => 'Grading', 'url' => url('/admin/grading')],
            ];
        @endphp
        @foreach($menus as $i => $menu)
            <div class="col-6 col-md-3 mb-4 d-flex justify-content-center">
                <a href="{{ $menu['url'] }}" class="dashboard-menu-btn d-flex align-items-center justify-content-center text-decoration-none w-100" style="height: 120px; border-radius: 20px; background: #f8f9fa; box-shadow: 0 2px 8px rgba(0,0,0,0.05); font-size: 1.5rem; font-weight: 600; color: #333; transition: background 0.2s;">
                    {{ $menu['name'] }}
                </a>
            </div>
        @endforeach
    </div>
</div>
<style>
.dashboard-menu-btn:hover {
    background: #e2e6ea !important;
    color: #007bff !important;
    text-decoration: none;
}
</style>
@endsection

