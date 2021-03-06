@extends('backend.layout.base')

@section('title')
    Edit Student
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Student</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm"
                                               href="{{ route('admins.users.student.index') }}">
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
                                <div class="col-md-7">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('admins.users.student.update', $student->id) }}" method="post" class="form-validate mt-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-gs">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Nom Etudiant</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('name') error @enderror"
                                                            id="name"
                                                            name="name"
                                                            value="{{ old('name') ?? $student->name }}"
                                                            placeholder="Enter Name"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="firstname">Post-Nom Etudiant</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control @error('firstname') error @enderror"
                                                            id="firstname"
                                                            name="firstname"
                                                            value="{{ old('firstname') ?? $student->firstname }}"
                                                            placeholder="Enter First Name"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="email"
                                                            class="form-control @error('email') error @enderror"
                                                            id="email"
                                                            name="email"
                                                            value="{{ old('email') ?? $student->email }}"
                                                            pattern="\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b"
                                                            placeholder="Enter Email"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="department">Departement</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 select2-hidden-accessible @error('department') error @enderror"
                                                            id="department"
                                                            name="department"
                                                            data-search="on"
                                                            data-placeholder="Select Department"
                                                            required>
                                                            <option value="{{ $student->department->id }}">{{ ucfirst($student->department->name) }}</option>
                                                            @foreach(\App\Models\Department::all() as $department)
                                                                <option
                                                                    value="{{ $department->id }}"
                                                                >{{ ucfirst($department->name ) ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="filiaire">Filiaire</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 select2-hidden-accessible @error('filiaire') error @enderror"
                                                            id="filiaire"
                                                            name="filiaire"
                                                            data-search="on"
                                                            data-placeholder="Select Filiaire"
                                                            required>
                                                            <option value="{{ $student->subsidiary->id }}">{{ ucfirst($student->subsidiary->name) }}</option>
                                                            @foreach(\App\Models\Subsidiary::all() as $filiaire)
                                                                <option
                                                                    value="{{ $filiaire->id }}"
                                                                >{{ ucfirst($filiaire->name ) ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="promotion">Promotion</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 select2-hidden-accessible @error('class') error @enderror"
                                                            id="promotion"
                                                            name="promotion"
                                                            data-search="on"
                                                            data-placeholder="Select Promotion"
                                                            required>
                                                            <option value="{{ $student->promotion->id }}">{{ ucfirst($student->promotion->name) }}</option>
                                                            @foreach(\App\Models\Promotion::all() as $promotion)
                                                                <option
                                                                    value="{{ $promotion->id }}"
                                                                >{{ ucfirst($promotion->name ) ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="parent">Parent</label>
                                                    <div class="form-control-wrap">
                                                        <select
                                                            class="form-control js-select2 select2-hidden-accessible @error('parent') error @enderror"
                                                            id="parent"
                                                            name="parent"
                                                            data-search="on"
                                                            data-placeholder="Select Parent"
                                                            required>
                                                            <option label="parent" value="{{ $student->parent->id }}">{{ ucfirst($student->parent->name_guardian) }}</option>
                                                            @foreach(\App\Models\Guardian::all() as $parent)
                                                                <option
                                                                    value="{{ $parent->id }}"
                                                                >{{ ucfirst($parent->name_guardian ) ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="admission">Admission Date</label>
                                                    <div class="form-control-wrap">
                                                        <input
                                                            type="text"
                                                            class="form-control date-picker @error('admission') error @enderror"
                                                            id="admission"
                                                            name="admission"
                                                            data-date-format="yyyy-mm-dd"
                                                            value="{{ old('admission') ?? $student->adminssion_date }}"
                                                            placeholder="Select Admission Date"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="gender">Gender</label> <br>
                                                    <ul class="custom-control-group g-3 align-center flex-wrap">
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input
                                                                    type="radio"
                                                                    class="custom-control-input"
                                                                    checked=""
                                                                    name="gender"
                                                                    value="male"
                                                                    id="male">
                                                                <label class="custom-control-label" for="male">Homme</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-radio checked">
                                                                <input
                                                                    type="radio"
                                                                    class="custom-control-input"
                                                                    name="gender"
                                                                    value="female"
                                                                    id="female">
                                                                <label class="custom-control-label" for="female">Femme</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
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
