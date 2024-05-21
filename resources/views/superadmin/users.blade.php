@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')

    <div id="sidebar" class="sidebar">
        <h5 class="sidebar-username">Logged in as: {{ Auth::user()->name }}</h5>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('appointment.index') }}" class="btn btn-link logout-btn white-text">
                    <i class="fa-solid fa-list-ol"></i> Appointments
                </a>
            </li>
            <li>
                <a href="{{ route('appointment.schedule') }}" class="btn btn-link logout-btn white-text">
                    <i class="fa-solid fa-calendar-check"></i> Book an Appointment
                </a>
            </li>
        </ul>

        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn btn btn-link"><i
                    class="fa-solid fa-right-from-bracket">Logout</i></button>
        </form>
    </div>
    <div id="content">
        <button id="open-sidebar-btn" class="btn btn-primary"><i class="fa-solid fa-bars"></i></button>
        <div class="container">

            <h1 class="text-center fs-2 mb-4">Admins</h1>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="button" class="btn btn-success create-admin-btn" data-bs-toggle="modal"
                        data-bs-target="#createAdminModal">
                        <i class="fa-solid fa-user-plus"></i> Create Admin
                    </button>
                </div>
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control search-input"
                        placeholder="Search by name or email">
                </div>
            </div>

            <table class="table table-bordered" style="margin: auto; width: 70%;">
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
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this admin?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
