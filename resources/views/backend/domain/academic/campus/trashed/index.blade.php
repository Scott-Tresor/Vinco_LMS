@extends('backend.layout.base')

@section('title', "Historique du campus")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Historique du demapartements</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.academic.departments.index') }}">
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
                    <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head text-center">
                                <th class="nk-tb-col tb-col-sm">
                                    <span>Image</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Nom</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>Dirigeant</span>
                                </th>
                                <th class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1 my-n1">
                                        <li class="me-n1">
                                            <div>
                                                <a href="#" class="btn btn-icon btn-trigger">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $campus)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col">
                                    <span class="tb-product">
                                        <img
                                            src="{{ asset('storage/'. $campus->images) }}"
                                            alt="{{ $campus->name }}"
                                            class="thumb">
                                    </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $campus->name }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ strtoupper($campus->user->name) }}</span>
                                    </td>
                                    <td class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1 my-n1">
                                            <li class="me-n1">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <form action="{{ route('admins.departments.restore', $campus->key) }}" method="POST">
                                                                    @method('PUT')
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button type="submit" class="btn btn-dim">
                                                                        <em class="icon ni ni-check-circle"></em>
                                                                        <span>Restore</span>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('admins.departments.remove', $campus->key) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button type="submit" class="btn btn-dim text-danger">
                                                                        <em class="icon ni ni-delete"></em>
                                                                        <span>Remove</span>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
