@extends('layouts.index')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h1 class="m-0 font-weight-bold text-primary">List User</h1>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>User Account</th>
            <th>Registered Time</th>
            <th>Full Name</th>
            <th>Date Of Birth</th>
            <th>Phone Number</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($listuser as $user)
        <tr>
            <td>{{$user->UserAccount}}</td>
            <td><?php echo date("d/m/Y", 898102800000/1000); ?></td>
            <td>{{$user->FullName}}</td>
            <td><?php echo date("d/m/Y", 898102800000/1000); ?></td>
            <td>{{$user->PhoneNumber}}</td> 
            <td>
                @if ($user->Status == 1)
                <button  type="button" class="btn btn-success btnActive" value="{{$user->UserAccount}}"data-id="{{$user->UserAccount}}">Active</button>
                @else
                  <button type="button" class="btn btn-warning btnDeActive" value="{{$user->UserAccount}}"data-id="{{$user->UserAccount}}">Deactive</button>
                @endif
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>        
@endsection
