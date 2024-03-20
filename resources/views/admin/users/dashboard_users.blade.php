@section('title', $title)
<meta name="csrf-token" content="{{ csrf_token() }}">

@extends('admin.layouts.master')

@section('content')
<div class="page-title mb-20">
    <div class="row">
        <div class="col-sm-6">
        <h4 class="mb-0 d-flex align-items-center h-100">{{ $title }}</h4>
        </div>
        <div class="col-sm-6 d-flex align-items-center justify-content-end">
          <a class="button black x-small" href="{{ route('dashboard_users_new') }}">{{ __('Add new') }} </a>
        </div>
    </div>
</div>

    @if ($errors->any())
      <div class="alert alert-warning fade show" role="alert">
        {{ __('The given data was invalid.') }}
      </div>
    @endif

    @if ($message = Session::get('success'))

      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    @endif

    @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="row mb-20">
      <div class="col-sm-12 col-md-6">
        <div class="dataTables_length d-flex align-items-center h-100">
            <p>
              <a id="elem_all" class="{{ $user_role === null || $user_role == 'all' ? 'text-body bold' : 'text-primary' }}" href="?role=all">{{ __('All') }}</a> ({{ $all }}) | 
              <a id="elem_admin" class="{{ $user_role === 'admin' ? 'text-body' : 'text-primary' }}" href="?role=admin">{{ __('Admin') }}</a> ({{ $admins }}) | 
              <a id="elem_editor" class="{{ $user_role === 'editor' ? 'text-body' : 'text-primary' }}" href="?role=editor">{{ __('Editor') }}</a> ({{ $editors }}) | 
              <a id="elem_author" class="{{ $user_role === 'author' ? 'text-body' : 'text-primary' }}" href="?role=author">{{ __('Author') }}</a> ({{ $authors }}) |
              <a id="elem_author" class="{{ $user_role === 'client' ? 'text-body' : 'text-primary' }}" href="?role=client">{{ __('Client') }}</a> ({{ $clients }}) |
              <a id="elem_author" class="{{ $user_role === 'user' ? 'text-body' : 'text-primary' }}" href="?role=user">{{ __('Potential client') }}</a> ({{ $users_c }})
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
            <div class="card-body py-0">
              <div class="table-responsive">
                <table class="table center-aligned-table mb-0">
                  <thead>
                    <tr class="text-dark">
                      <th>{{ __('User') }}</th>
                      <th>{{ __('Email') }}</th>
                      <th>{{ __('Role') }}</th>
                      <th>{{ __('Date') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                        <tr id="user_{{ $user->id }}">
                          <td class="lm_hover_container user-info">
                              <a href="{{ route('dashboard_users_update', [$user->id, $user->email]) }}">
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                <b>{{ $user->name }}</b>
                              </a>

                            <div class="lm-hover-display">
                                <a class="text-primary" href="/1"><small>{{ __('Display') }}</small></a> | 
                                <a class="text-primary" href="{{ route('dashboard_users_update', [$user->id, $user->email]) }}"><small>{{ __('Edit') }}</small></a>
                                @if ( $user->id !== 1 && $user->id !== Auth::user()->id )
                                  | <a class="text-danger" href="javascript:void(0);" onclick="startCheckUserDelete('{{ route('validate_dashboard_users_delete', [$user->id, $user->email]) }}')"><small>{{ __('Delete') }}</small></a>
                                @endif
                            </div>
                          </td>
                          <td><a class="text-primary" href="mailto:{{ $user->email }}">{{ $user->email }}</a> {!! $user->hasVerifiedEmail() ? '<i class="ti-check-box text-success" title="تم التحقق"></i>' : '' !!}</td>
                          <td>
                            @foreach ($user->roles as $role)
                                <p>{{ $role->display_name }}</p>
                            @endforeach
                          </td>
                          <td>{{ get_date( $user->created_at ) }}</td>
                        </tr>
                    @empty
                        <tr>
                          <td colspan="5">{{ __('No data') }}</td>
                        </tr>
                    @endforelse
                  </tbody>
                  <tfoot>
                    <tr class="text-dark">
                      <th>{{ __('User') }}</th>
                      <th>{{ __('Email') }}</th>
                      <th>{{ __('Role') }}</th>
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
      {{ $users->links("pagination::bootstrap-5") }}
    </div>
    
    
@endsection

<script>

  function startCheckUserDelete( url ) {
    swal({
        title: "{{ __('Are you sure?') }}",
        text: "{{ __('You won\'t be able to revert this!') }}",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "{{ __('Cancel') }}",
        confirmButtonText: "{{ __('Yes, delete it!') }}"
      }).then((result) => {
        
        if (result.value === true) {
          
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      
          $.ajax({
            global: false,
            type: 'delete',
            url: url,
            dataType: 'html',
            success: function (response)
            {
                let res = JSON.parse(response);

                $(`#user_${res.id}`).remove();

                swal(
                  "{{ __('Deleted!') }}",
                  `${res.msg}`,
                  'success',
                )
            },
            error: function(xhr) {

              console.log('xxxxxxxxxxxxx', xhr)
                if(xhr.status === 400){

                  swal(
                    "{{ __('There was a problem executing the action.') }}",
                    `${ xhr.responseText }`,
                    'error',
                  )
          
                }else{
                  swal(
                    "{{ __('Oops...!') }}",
                    "{{ __('Something went wrong!') }}",
                    'error',
                  )
                }
      
          }
          });


        }
      })
  }
  // document.addEventListener('readystatechange', event => {
  //   $(document).ready(function(){
      

  //     $('#sweetalert').click( function () {


  //     })
  //   });
  // })

</script>