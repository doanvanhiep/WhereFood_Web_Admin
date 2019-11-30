@extends('layouts.index')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h1 id="nameoflistuser" class="m-0 font-weight-bold text-primary">List User</h1>
    <button id="addUser" type="button" class="btn btn-success">ADD</button>
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
        <tr class="edit" data-id="{{$user->UserAccount}}">
            <td id={{$user->UserAccount ."useraccount"}}>{{$user->UserAccount}}</td>
            <td id={{$user->UserAccount ."registertime"}}><?php echo date("d/m/Y", $user->RegisteredTime/1000); ?></td>
            <td id={{$user->UserAccount ."fullname"}}>{{$user->FullName}}</td>
            <td id={{$user->UserAccount ."dateofbirth"}}><?php echo date("d/m/Y", $user->DateOfBirth/1000); ?></td>
            <td id={{$user->UserAccount ."phonenumber"}}>{{$user->PhoneNumber}}</td> 
            <td id={{$user->UserAccount ."status"}}>
                @if ($user->Status == 1)
                <button id={{$user->UserAccount }} type="button" class="btn btn-success btnActive btnChange" value="{{$user->UserAccount}}"data-id="{{$user->UserAccount}}">Active</button>
                @else
                <button id={{$user->UserAccount }} type="button" class="btn btn-warning btnDeActive btnChange" value="{{$user->UserAccount}}"data-id="{{$user->UserAccount}}">Deactive</button>
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
@include('userDetail')
@include('userRegister')
<script>
$(document).ready(function(){
  $(".edit").dblclick(function(){
  var id=$(this).data('id');
  var urlget='http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/user/getuserbyuseraccount/'+id;
  $.ajax({
    type: 'GET',
            url: urlget,
            dataType: 'json',
            success: function(data) {
              $("#txt-useraccount") .val(data.UserAccount);
              $("#txt-fullname")    .val(data.FullName);
              var today = new Date(data.DateOfBirth);
              var year=today.getFullYear();
              var month=today.getMonth()+1;
              var day=today.getDate();
              if(month<10)
              {
                month="0"+month;
              }
              if(day<10)
              {
                day="0"+day;
              }
              today = year+'-'+month+'-'+day; 
              $("#txt-dateofbirth") .val(today);
              $("#txt-phonenumber") .val(data.PhoneNumber);
              $('#edit-modal').modal('show');
              },error: function(data) {
              alert("error server");
              }
        });
    });

    
  $("#btnupdate").click(function(){
    if($("#txt-dateofbirth") .val().toString()=="")
    {
      alert("Insert date of birth");
      return;
    }
    if($("#txt-fullname") .val().toString()=="")
    {
      alert("Insert full name");
      return;
    }
    if($("#txt-phonenumber") .val().toString()=="")
    {
      alert("Insert phone number");
      return;
    }
    $.ajax({
    type: 'POST',
            url: 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/user/updateuserbyuseraccount',
            data: {
            UserAccount:    $("#txt-useraccount") .val(),
            FullName:       $("#txt-fullname") .val(),
            DateOfBirth:    new Date($("#txt-dateofbirth") .val().toString()).getTime(),
            PhoneNumber:    $("#txt-phonenumber") .val(),
            },
            dataType: 'json',
            success: function(data) {
              if(data==-4)
              {
                alert("Phone number existed!");
              }
              else{
                if(data==0)
                {
                  alert("Nothing!");
                }
                else
                {
                  alert("Success!");
                  var useraccount=$("#txt-useraccount") .val();
                  //reload data
                  $("#"+useraccount+"registertime").text($("#txt-registertime") .val());
                  $("#"+useraccount+"fullname").text($("#txt-fullname") .val());
                  var date=$("#txt-dateofbirth") .val().split("-");
                  $("#"+useraccount+"dateofbirth").text(date[2]+"/"+date[1]+"/"+date[0]);
                  $("#"+useraccount+"phonenumber").text($("#txt-phonenumber") .val());
                }
                $('#edit-modal').modal('hide');
              }
              
            },
            error: function(data) {
              alert("Error server");
              $('#edit-modal').modal('hide');
            }
        });
  });



  $("#addUser").click(function(){
    $("#txt-useraccountadd").val("");
    $("#txt-fullnameadd") .val("");
    $("#txt-dateofbirthadd") .val("");
    $("#txt-phonenumberadd") .val("");
    $("#txt-passwordadd") .val("");
    $("#txt-confirmpasswordadd") .val("");
    $('#register-user').modal('show');
  });

  $("#btnAdd").click(function(){
    var useraccount=$("#txt-useraccountadd").val();
    if(useraccount=="")
    {
      alert("User account not empty!");
      return;
    }
    var fullname= $("#txt-fullnameadd") .val();
    if(fullname=="")
    {
      alert("Full name not empty!");
      return;
    }
    var dateofbirth= $("#txt-dateofbirthadd") .val();
    if(dateofbirth=="")
    {
      alert("Date of birth not empty!");
      return;
    }
    var phonenumber= $("#txt-phonenumberadd") .val();
    if(phonenumber=="")
    {
      alert("Phone number not empty and is number !");
      return;
    }
    else{
      if(phonenumber.length!=10 )
      {
        alert("Phone number only have 10 character");
        return;
      }
    }
    var password= $("#txt-passwordadd") .val();
    if(password=="")
    {
      alert("Password not empty!");
      return;
    }
    var confirmpassword= $("#txt-confirmpasswordadd") .val();
    if(confirmpassword=="")
    {
      alert("Confirm password not empty!");
      return;
    }
    if(password!=confirmpassword)
    {
      alert("Password not math confirmpassword!");
      return;
    }
    $.ajax({
    type: 'POST',
            url: 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/user/registeraccount',
            data: {
            UserAccount:useraccount,
            HashPassWord:password,
            RegisteredTime:      new Date().getTime(),
            FullName:fullname,
            DateOfBirth:new Date(dateofbirth).getTime(),
            PhoneNumber:    phonenumber,
            },
            dataType: 'json',
            success: function(data) {
              if(data==-1)
              {
                alert('Add fail');
                return;
              }
              if(data==-5)
              {
                alert("User account existed!");
                return;
              }
              else
              {
                if(data==-4)
              {
                alert("Phone number existed!");
                return;
              }
              else{
                if(data==0)
                {
                  alert("Nothing!");
                }
                else
                {
                  alert("Success!");
                }
                $('#register-user').modal('hide');
              }
              }
            },
            error: function(data) {
              alert("Error server");
              $('#register-user').modal('hide');
            }
        });
  });
});
</script>        
@endsection
