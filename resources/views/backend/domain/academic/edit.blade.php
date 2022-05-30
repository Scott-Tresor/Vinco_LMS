@extends('backend.layout.base')

@section('title', "Administration")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">
                                Session
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $academic->startDate)->format('Y') }}
                                -
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $academic->endDate)->format('Y') }}
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic-years.index') }}">
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
                            <form action="{{ route('admins.academic-years.update', $academic->key) }}" method="post" class="form-validate" novalidate="novalidate">
                                @csrf
                                @method('PUT')
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="startDate">Annee debut</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control date-picker-alt @error('startDate') error @enderror"
                                                    id="startDate"
                                                    name="startDate"
                                                    value="{{ old('startDate' ) ?? $academic->startDate }}"
                                                    data-date-format="yyyy-mm-dd"
                                                    placeholder="Saisir le debut de l'annee"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="endDate">Annee de fin</label>
                                            <div class="form-control-wrap">
                                                <input
                                                    type="text"
                                                    class="form-control date-picker-alt @error('endDate') error @enderror"
                                                    id="endDate"
                                                    name="endDate"
                                                    value="{{ old('endDate' ) ?? $academic->endDate }}"
                                                    data-date-format="yyyy-mm-dd"
                                                    placeholder="Saisir la fin de l'annee"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-primary">Update academic years</button>
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
