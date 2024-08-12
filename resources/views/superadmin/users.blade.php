@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')
    <div id="sidebar" class="sidebar">
        <hr class="first-hr">
        <ul class="nav nav-pills flex-column mb-auto mt-9">
            <li class="nav-item">
                <a href="{{ route('appointment.index') }}" class="nav-link link-dark">
                    <i class="fa-solid fa-list-ol me-2"></i> Appointments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('appointment.schedule') }}" class="nav-link link-dark">
                    <i class="fa-solid fa-calendar-check me-2"></i> Book an Appointment
                </a>
            </li>

            @if (Auth::user()->role === 'superadmin')
                <li class="nav-item">
                    <a href="{{ route('superadmin.users') }}" class="nav-link link-dark">
                        <i class="fa-solid fa-users me-2"></i> Admins
                    </a>
                </li>
            @endif
        </ul>


        <div class="user-section">
            <hr class="second-hr">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser1" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow custom-dropdown-menu"
                    aria-labelledby="dropdownUser1">
                    <li>
                        <form id="logout-form-dropdown" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="content">
        <button id="open-sidebar-btn" class="btn btn-primary"><i class="fa-solid fa-bars"></i></button>
        <div class="container mt-2">
            <h1 class="text-center fs-2 mb-4">Admins</h1>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <button type="button" class="btn btn-success create-admin-btn-justify-left" data-bs-toggle="modal"
                    data-bs-target="#createAdminModal">
                    <i class="fa-solid fa-user-plus"></i> Create Admin
                </button>
                <div class="col-md-4">
                    <form action="{{ route('superadmin.search') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="query" id="searchInputAdmin" class="form-control search-input" placeholder="Search by name or email" value="{{ request('query') }}">
                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                    </form>
                </div>
            </div>

            <table class="table table-bordered" style="margin: auto;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="adminTableBody">
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editAdminModal" data-id="{{ $admin->id }}"
                                    data-name="{{ $admin->name }}" data-email="{{ $admin->email }}">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <form action="{{ route('superadmin.destroy', $admin->id) }}" method="POST"
                                    style="display: inline;" id="deleteForm{{ $admin->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-btn" data-id="{{ $admin->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4">
                {{ $admins->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection