@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome back, ') }} {{ Auth::user()->nama_lengkap }}! {{ __('You are logged in.') }}

                    <!-- Admin Menus -->
                    @if(Auth::user()->role == 0) 
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="/admin/user" class="btn btn-primary w-100">
                                        <i class="fas fa-users"></i> {{ __('Volunteer') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="/admin/cabang" class="btn btn-primary w-100">
                                        <i class="fas fa-map-marker-alt"></i> {{ __('Lokasi') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="/admin/tag" class="btn btn-primary w-100">
                                        <i class="fas fa-tags"></i> {{ __('Tag') }}
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="/admin/bagian" class="btn btn-primary w-100">
                                        <i class="fas fa-sitemap"></i> {{ __('Position') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="/admin/jadwal_ibadah" class="btn btn-primary w-100">
                                        <i class="fas fa-church"></i> {{ __('Services') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="/admin/jadwal" class="btn btn-primary w-100">
                                        <i class="fas fa-calendar-alt"></i> {{ __('Schedule') }}
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="/admin/tim_pelayanan" class="btn btn-primary w-100">
                                        <i class="fas fa-users-cog"></i> {{ __('Team') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="/admin/grading" class="btn btn-primary w-100">
                                        <i class="fas fa-star"></i> {{ __('Grading') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    
                    <!-- Servo Menus -->
                    @elseif (Auth::user()->role == 1)
                        <div class="mt-4">
                            <div class="row">
                                
                            </div>
                        </div>
                    
                    <!-- PIC Menus -->
                    @elseif (Auth::user()->role == 2)
                        <div class="mt-4">
                            <div class="row">

                            </div>
                        </div>
                    
                    <!-- Volunteer Menus -->
                    @elseif (Auth::user()->role == 3)
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="/volunteer" class="btn btn-primary w-100">
                                        <i class="fas fa-calendar-alt"></i> {{ __('Schedule') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
