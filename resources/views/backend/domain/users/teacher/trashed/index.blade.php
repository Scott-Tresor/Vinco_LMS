@extends('backend.layout.base')

@section('title', "Historiques des professeurs")

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Historiques</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.users.teacher.index') }}">
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
                                <span>name</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Email</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Phones</span>
                            </th>
                            <th class="nk-tb-col">
                                <span>Matricule</span>
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
                            @foreach($professors as $professor)
                                <tr class="nk-tb-item text-center">
                                    <td class="nk-tb-col tb-col-sm">
                                    <span class="tb-product">
                                        <img
                                            src="{{ asset('storage/'. $professor->images) }}"
                                            alt="{{ $professor->firstName }}"
                                            class="thumb">
                                    </span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ strtoupper($professor->username) ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $professor->email ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $professor->phones ?? "" }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $professor->matriculate ?? "" }}</span>
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
                                                                <form action="{{ route('admins.teacher.restore', $professor->key) }}" method="POST">
                                                                    @method('PUT')
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <button type="submit" class="btn btn-dim">
                                                                        <em class="icon ni ni-check-circle"></em>
                                                                        <span>Restore</span>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('admins.teacher.remove', $professor->key) }}" method="POST" onsubmit="return confirm('Voulez vous supprimer');">
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
