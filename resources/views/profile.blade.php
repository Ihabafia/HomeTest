@extends('layouts.app')

@section('content')

<style>
.email_tr { cursor: pointer; }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <div class="alert message" role="alert"></div>
                    </div>

                    <div class="col-md-12">
                    <form class="form-horizontal" method="post" id="add">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user->id }}" />
                        <div class="form-group">
                            <label class="col-lg-3 control-label">First name:</label>
                            <div class="col-lg-12">
                                <input class="form-control userinfo" type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Last name:</label>
                            <div class="col-lg-12">
                                <input class="form-control userinfo" type="text" id="last_name" name="last_name" value="{{ $user->last_name }}">
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="col-md-12 p-4">
                        <h4>Email(s) List</h4>
                        <table class="table table-bordered text-center">
                            <tr>
                                <th width="90%">Email Address</th>
                                <th>Action</th>
                            </tr>
                            @foreach($user->emails as $rec)
                            <tr style="cursor: pointer;{{ $rec->is_default=='1' ? 'background-color: #3490dc; color: white !important;' : '' }}">
                                <td class="email">{{ $rec->email }}</td>
                                <td>
                                    @if($rec->is_default == '1')
                                        Default
                                    @else
                                        <a class="remove" data-email="{{ $rec->email }}" href="#">Remove</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-12 px-4">
                        <button class="btn btn-primary float-right" onclick="javascript:newEmail();">Add an Email</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Set Email</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>

                </div>
                <div class="modal-body" style="padding-top: 30px; padding-bottom: 30px;">
                    <div class="form-group">
                        <label class="col-lg-6 control-label">Email address:</label>
                        <div class="col-lg-12">
                            <input class="form-control" type="text" id="email_address" autofocus>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function newEmail(){
        $('#myModal').modal();
    }
</script>
@endsection
