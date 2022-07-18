@extends('backend.layout.base')

@section('title')
    Edition Department
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edition Department</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-outline-light d-none d-md-inline-flex" href="{{ route('admins.academic.departments.index') }}">
                                                <em class="icon ni ni-arrow-left"></em>
                                                <span>Back</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('admins.academic.departments.update', $department->id) }}" method="post" class="form-validate" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Nom</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') ?? $department->name }}"
                                                            placeholder="Enter Name"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $users = \App\Models\User::query()
                                                    ->select(['id', 'name'])
                                                    ->whereHas('roles', function ($query) {
                                                        $query->whereNotIn('name', ['Super Admin', 'Etudiant', 'Parent', 'Comptable']);
                                                    })
                                                    ->get();
                                            @endphp

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="user">Responsable</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('user') error @enderror"
                                                        data-search="on"
                                                        id="user"
                                                        name="user"
                                                        data-placeholder="Select Responsable"
                                                        required>
                                                        <option label="Select Responsable" value=""></option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="campus">Campus</label>
                                                    <select
                                                        class="form-control js-select2 select2-hidden-accessible @error('campus') error @enderror"
                                                        data-search="on"
                                                        id="campus"
                                                        name="campus"
                                                        data-placeholder="Choisir la faculte"
                                                        required>
                                                        <option value="{{ $department->campus->id }}">{{ ucfirst($department->campus->name) }}</option>
                                                        @foreach(\App\Models\Campus::all() as $campus)
                                                            <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="description">Description</label>
                                                    <div class="form-control-wrap">
                                                        <textarea
                                                            class="form-control form-control-sm"
                                                            id="description"
                                                            name="description"
                                                            placeholder="Write the description"
                                                        >{{ old('description') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-md btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
