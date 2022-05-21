@extends('backend.layout.base')

@section('title', "Gestion des personnelles")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Personnels</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.professors.index') }}">
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
                            <form action="{{ route('admins.personnel.store') }}" method="post" class="form-validate" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Votre nom</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('name') error @enderror"
                                                    id="name"
                                                    name="name"
                                                    value="{{ old('name') }}"
                                                    placeholder="Saisir votre nom"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="firstName">Votre post-nom</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('firstName') error @enderror"
                                                    id="firstName"
                                                    name="firstName"
                                                    value="{{ old('firstName') }}"
                                                    placeholder="Saisir votre post-nom"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="lastName">Votre prenom</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('lastName') error @enderror"
                                                    id="lastName"
                                                    name="lastName"
                                                    value="{{ old('lastName') }}"
                                                    placeholder="Saisir votre prenom"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email address</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="email"
                                                    class="form-control @error('email') error @enderror"
                                                    id="email"
                                                    name="email"
                                                    value="{{ old('email') }}"
                                                    pattern="\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b"
                                                    placeholder="Saisir votre adresse email"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phones">Telephone</label>
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <input
                                                        type="text"
                                                        class="form-control @error('phones') error @enderror"
                                                        name="phones"
                                                        id="phones"
                                                        value="{{ old('phones') }}"
                                                        placeholder="Saisir votre numero de telephone"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="nationality">Nationalite</label>
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <input
                                                        type="text"
                                                        class="form-control @error('nationality') error @enderror"
                                                        name="nationality"
                                                        id="nationality"
                                                        value="{{ old('nationality') }}"
                                                        placeholder="Saisir votre nationalite"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="address">Adresse</label>
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <input
                                                        type="text"
                                                        class="form-control @error('address') error @enderror"
                                                        name="address"
                                                        id="address"
                                                        value="{{ old('address') }}"
                                                        placeholder="Saisir votre adresse"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="identityCard">N Identite (carte ou passposrt)</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control @error('identityCard') error @enderror"
                                                    id="identityCard"
                                                    name="identityCard"
                                                    value="{{ old('identityCard') }}"
                                                    placeholder="Saisir votre numero de carte d'identite"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Photo profile</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="file"
                                                    class="form-control @error('images') error @enderror"
                                                    name="images"
                                                    value="{{ old('images') }}"
                                                    placeholder="Selectionnez une image"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="user">Select gestionnaire</label>
                                            <div class="form-control-wrap">
                                                <select
                                                    class="form-control js-select2 @error('user') error @enderror"
                                                    id="user"
                                                    name="user"
                                                    data-placeholder="Choisir le gestionnaire"
                                                    required>
                                                    <option label="role" value=""></option>
                                                    @foreach(\App\Models\User::query()->where('role_id', '!=', \App\Enums\RoleEnum::STUDENT)->where('status', '=', \App\Enums\StatusEnum::TRUE)->get() as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->firstName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="birthdays">Date de naissance</label>
                                                <div class="form-control-wrap">
                                                    <input
                                                        type="text"
                                                        class="form-control date-picker @error('birthdays') error @enderror"
                                                        id="birthdays"
                                                        name="birthdays"
                                                        value="{{ old('birthdays') }}"
                                                        data-date-format="yyyy-mm-dd"
                                                        placeholder="Saisir votre date de naissance"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="academic">Annee academique</label>
                                                <div class="form-control-wrap">
                                                    <select
                                                        class="form-control js-select2 @error('academic') error @enderror"
                                                        data-value="{{ old('academic') }}"
                                                        id="academic"
                                                        name="academic"
                                                        data-placeholder="Select a academic year"
                                                        required>
                                                        <option label="genre" value=""></option>
                                                        @foreach($academicYear as $year)
                                                            <option value="{{ $year->id }}">
                                                                {{  \Carbon\Carbon::createFromFormat('Y-m-d', $year->startDate)->format('Y') }}
                                                                -
                                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $year->endDate)->format('Y') }}
                                                            </option>
                                                        @endforeach>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="gender">Genre</label>
                                                <div class="form-control-wrap">
                                                    <select
                                                        class="form-control js-select2 @error('gender') error @enderror"
                                                        data-value="{{ old('gender') }}"
                                                        id="gender"
                                                        name="gender"
                                                        data-placeholder="Select a gender"
                                                        required>
                                                        <option label="genre" value=""></option>
                                                        <option value="masculin">Masculin</option>
                                                        <option value="feminin">Feminin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-primary">Create personnel</button>
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
@endsection
