@extends('backend.layout.base')

@section('title')
    Fees Listen
@endsection

@section('content')
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Fees Listen</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <a class="btn btn-dim btn-primary btn-sm" href="{{ route('admins.accounting.fees.create') }}">
                                                <em class="icon ni ni-plus"></em>
                                                <span>Create</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row g-gs">
                        <table class="datatable-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head text-center">
                                <th class="nk-tb-col">
                                    <span>USER INFORMATION</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>TRANSACTION NO</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>AMOUNT</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>DUE DATE</span>
                                </th>
                                <th class="nk-tb-col">
                                    <span>PAY DATE</span>
                                </th>
                                <th class="nk-tb-col nk-tb-col-tools text-center">
                                    <span>ACTION</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($fees as $fee)
                                    <tr class="nk-tb-item text-center">
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">
                                                <span class="title">
                                                    Student:
                                                    <a href="{{ route('admins.users.student.show', $fee->student->id) }}">
                                                        {{ ucfirst($fee->student->firstname) }} {{ ucfirst($fee->student->lastname) }}
                                                    </a>
                                                </span>
                                                <span class="title">
                                                    Parent:
                                                    <a href="{{ route('admins.users.guardian.show', $fee->student->id) }}">
                                                        {{ ucfirst($fee->student->firstname) }} {{ ucfirst($fee->student->lastname) }}
                                                    </a>
                                                </span>
                                            </span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">{{ $fee->transaction_no ?? 0 }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">{{ $fee->amount ?? "" }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">{{ $fee->due_date ?? "" }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">{{ $fee->pay_date ?? "" }} </span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('admins.accounting..fees.edit', $fee->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                        <em class="icon ni ni-check"></em>
                                                        Confirmed
                                                    </a>
                                                    <a href="{{ route('admins.accounting..fees.edit', $fee->id) }}" class="btn btn-dim btn-primary btn-sm ml-1">
                                                        <em class="icon ni ni-edit"></em>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('admins.accounting..fees.destroy', $fee->id) }}" method="POST" class="ml-3" onsubmit="return confirm('Voulez vous supprimer');">
                                                        @method('DELETE')
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-dim btn-danger btn-sm">
                                                            <em class="icon ni ni-trash"></em>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
