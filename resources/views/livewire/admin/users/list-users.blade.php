<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex @if( session()->has('message') ) justify-content-between @else justify-content-end @endif mb-2">
                            {{-- Bootstrap alert --}}
                            {{-- @if( session()->has('message') )
                                <div class="alert alert-warning alert-dismissible fade show mr-2" role="alert" style="margin-bottom: 0px;">
                                    <strong> <i class="fa fa-check"></i> Success !!</strong> {{ session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif --}}
                        <button wire:click.prevent="addNewUser" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Add New User</button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td> {{ $user->name }} </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="" wire:click.prevent="editUser({{ $user }})">
                                                    <i class="fa fa-edit mr-2"></i>
                                                </a>

                                                <a href="">
                                                    <i class="fa fa-trash text-red"></i>
                                                </a>
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
    </div>
    
    <!-- Modal -->
    {{-- wire:ignore.self is to make sure the modal doesn't disappear after clicking submit. Otherwise, the black overlay stays and the modal disappears. --}}
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            {{-- {{ $show_edit_modal ? 'createUser' : 'updateUser' }} --}}
            <form autocomplete="off" wire:submit.prevent="@if($show_edit_modal) createUser @else updateUser @endif">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            @if ($show_edit_modal)
                                <span>Add New User</span>
                            @else
                                <span>Edit User</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name {{$name}} </label>
                            {{--  is to prevent multiple requests being sent to the server --}}
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name" aria-describedby="nameHelp"
                            placeholder="Enter full name">
                            @error('name')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email address {{$email}}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.defer="email" aria-describedby="emailHelp" placeholder="Enter email">
                            @error('email')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password {{$password}}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.defer="password" placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmation">Confirm Password {{$password_confirmation}}</label>
                            <input type="password" class="form-control" id="passwordConfirmation" wire:model.defer="password_confirmation" placeholder="Enter Password Again">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Close</button>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save mr-1"></i> 
                            @if ($show_edit_modal)
                                Save
                            @else
                                Update
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
