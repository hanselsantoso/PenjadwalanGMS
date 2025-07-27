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
                                    <a href="{{ route('user.index') }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-users" style="margin-right: 10px;"></i> {{ __('Users') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('cabang.index') }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i> {{ __('Cabang') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('tag.index') }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-tags" style="margin-right: 10px;"></i> {{ __('Tag') }}
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('bagian.index') }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-sitemap" style="margin-right: 10px;"></i> {{ __('Bagian') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('mapping.index') }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-map-pin" style="margin-right: 10px;"></i> {{ __('Mapping') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('jadwal_ibadah.index') }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-church" style="margin-right: 10px;"></i> {{ __('Jadwal Ibadah') }}
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('jadwal.index') }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-calendar-alt" style="margin-right: 10px;"></i> {{ __('Jadwal Tugas') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('tim_pelayanan.index') }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-users-cog" style="margin-right: 10px;"></i> {{ __('Tim Pelayanan') }}
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('grading.index') }}" class="btn btn-primary w-100" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-star" style="margin-right: 10px;"></i> {{ __('Grading') }}
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
                                
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
