@section('title', $title)

@extends('admin.layouts.master')

@section('content')
    <div class="page-title mb-20">
        <div class="row">
            <div class="col-sm-6">
            <h4 class="mb-0 d-flex align-items-center h-100">{{ $title }}</h4>
            </div>
            <div class="col-sm-6 d-flex align-items-center justify-content-end">
            <a class="button black x-small" href="{{ route('admin_roles_new') }}">{{ __('Add new') }} </a>
            </div>
        </div>
    </div>

    <div class="row mb-20">
        <div class="col-sm-12 col-md-6">
          <div class="dataTables_length d-flex align-items-center h-100">
              <p>
                <a id="elem_all" class="text-primary" href="javascript:void(0)">{{ __('All') }}</a> ({{ $roles->total() }})
              </p>
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="widget-search ml-0 clearfix bg-light">
              <i class="fa fa-search"></i>
              <input type="search" class="form-control" placeholder="{{ __('Search....') }}">
            </div>
        </div>
      </div>
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table center-aligned-table mb-0">
                    <thead>
                    <tr class="text-dark">
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Granted') }}</th>
                        <th>{{ __('Permissions') }}</th>
                        <th>{{ __('Date') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td class="lm_hover_container">
                                <b>{{ $role->display_name }}</b>
                                <div class="lm-hover-display">
                                    <a class="text-primary" href="#"><small>{{ __('Edit') }}</small></a> | 
                                    <a class="text-danger" href="#"><small>{{ __('Delete') }}</small></a>
                                </div>
                            </td>
                            <td><p>{{ $role->name }}</p></td>
                            <td><p>{{ count($role->users) }}</p></td>
                            <td><p>{{ count($role->permissions) }}</p></td>
                            <td><p>{{ get_date( $role->created_at ) }}</p></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">{{ __('No data') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr class="text-dark">
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Granted') }}</th>
                        <th>{{ __('Permissions') }}</th>
                        <th>{{ __('Date') }}</th>
                    </tr>
                    </tfoot>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-20">
      {{ $roles->links("pagination::bootstrap-5") }}
    </div>

@endsection