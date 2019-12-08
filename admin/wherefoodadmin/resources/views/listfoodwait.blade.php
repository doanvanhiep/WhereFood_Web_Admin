
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h1 class="m-0 font-weight-bold text-primary">List Food Waitting</h1>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
                    <tr>
                        <!-- <th>Food ID</th> -->
                        <th>Food Name</th>
                        <th>Prices</th>
                        <th>Short Description</th>
                        <th>Long Description</th>
                        <th>Avg Survey</th>
                        <th>Restaurant Name</th>
                        <th>Pictures</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($listfoodwait as $food)
                    <tr id={{$food['FoodID']}} class="editFood" data-id={{$food['FoodID']}}>
                        <!-- <td>{{$food['FoodID']}}</td> -->
                        <td id={{$food['FoodID'] ."foodname"}}>{{$food['FoodName']}}</td>
                        <td id={{$food['FoodID'] ."prices"}}>{{$food['Prices']}}</td>
                        <td id={{$food['FoodID'] ."short"}}>{{$food['ShortDescription']}}</td>
                        <td id={{$food['FoodID'] ."long"}}>{{$food['LongDescription']}}</td>
                        <td id={{$food['FoodID'] ."avg"}}>{{$food['AvgSurvey']}}</td>
                        <td id={{$food['FoodID'] ."resname"}}>{{$food['RestaurantName']}}</td>
                        <td><button type="button" class="btn btn-info btnGetPicturewait" value="{{$food['PictureToken']}}" data-id="{{$food['FoodID']}}">Xem hình</button></td>
                        <td>
                        <button type="button" class="btn btn-success btnActive"  data-id="{{$food['FoodID']}}">Accept</button>
                        <button type="button" class="btn btn-warning btnDeActive" data-id="{{$food['FoodID']}}">Deny</button>
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
@include('getPicture')
@include('foodDetail')
<script>
$(document).ready(function(){
  $('#btnupdatefood').click(function(){
      id=$("#txt-foodID") .val();
      foodname=$("#txt-foodname") .val();
      price=$("#txt-price") .val();
      shortdescription=$("#txt-shortdescription") .val();
      longdescription=$("#txt-longdescription") .val();
      state=8;
      $('#titlemessage').text("Update food");
      $('#content-message').text("Do you want update food");
      $('#messagebox').modal('show');
    });

  //edit food
  $(".editFood").dblclick(function(){
    var id=$(this).data('id');
    var urlget="http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/food/getfoodbyidnostatus/"+id;
    $.ajax({
      type: 'GET',
              url: urlget,
              dataType: 'json',
              success: function(data) {
                $("#txt-foodID") .val(data.FoodID);
                $("#txt-foodname") .val(data.FoodName);
                $("#txt-price") .val(data.Prices);
                $("#txt-shortdescription") .val(data.ShortDescription);
                $("#txt-longdescription") .val(data.LongDescription);
                $("#cb-restaurantname") .val(data.RestaurantID);
                $('#edit-food').modal('show');
                },
                error: function(data) {
                alert("error server");
                }
            });
    });
//Xem hình của food
$(".btnGetPicturewait").click(function(){
  var id=$(this).data('id');
  var urlget='http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/permalink/getpermalinkbyid/'+id;
  $.ajax({
    type: 'GET',
            url: urlget,
            dataType: 'json',
            success: function(data) {
              let html = "";
			        for(let i = 0;i<data.length;i++){
              html+="<div class=\"column\">";
              html+="<img width=\"180px\" height=\"180px\" src=\"http://testserver.22domain.com/"+data[i].PicturePermalink+"\" onclick=\"myFunction(this);\">";
				      // html+="<img padding='10' width='463px' src='http://testserver.22domain.com/"+data[i].PicturePermalink+"'>";
              html+="</div>";
              }
              if(html == ""){
                $(".row").html("<h4 class='text-center'>No Picture!</h4>");
                alert("No Picture");
                $('#viewpicture').modal('show');
                return false;
              } else {  
                $(".row").html(html);
                $('#viewpicture').modal('show');
              }
                    },error: function(data) {
                    alert("error server");
                    }
              });
    });

    //accept
    $('.btnActive').click(function(){
    id=$(this).data('id');
    state=6;
    $('#titlemessage').text("Change active");
    $('#content-message').text("Do you want accept food");
    $('#messagebox').modal('show');
    });

    //deny
    $('.btnDeActive').click(function(){
    id=$(this).data('id');
    state=7;
    $('#titlemessage').text("Change active");
    $('#content-message').text("Do you want deny food");
    $('#messagebox').modal('show');
    });
    function acceptFood()
    {
      $.ajax({
            type: 'POST',
            url: 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/food/updatestatusactive',
            data: {
            FoodID: id,
            },
            dataType: 'json',
            success: function(data) {
            if(data==0)
            {
              alert("Nothing");
            }else
            {
              $('#'+id).remove();
              alert("Success");
            }
            },error: function(data) {
            alert("Fail");
            }
        });
    }

    function denyFood(){
      $.ajax({
            type: 'POST',
            url: 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/food/updatestatusdeactive',
            data: {
            FoodID: id,
            },
            dataType: 'json',
            success: function(data) {
            if(data==0)
            {
                alert("Nothing");
            }else
            {
                $('#'+id).remove();
                alert("Success");
            }
            },error: function(data) {
            alert("Fail");
            }
        });
    }
    function updateFoodWait()
    {
      $.ajax({
            type: 'POST',
            url: "http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/food/updatefood",
            data: {
              FoodID: id,
              FoodName:foodname,
              Prices:price,
              ShortDescription:shortdescription,
              LongDescription:longdescription
            },
            dataType: 'json',
            success: function(data) {
            if(data==0)
            {
                alert("Nothing");
                $('#edit-food').modal('hide');
            }else
            {
                alert("Success");
                $('#edit-food').modal('hide');
                //reload data
                $("#"+id+"foodname").text($("#txt-foodname") .val());
                $("#"+id+"prices").text($("#txt-price") .val());
                $("#"+id+"short").text($("#txt-shortdescription") .val());
                $("#"+id+"long").text($("#txt-longdescription") .val());
                return;
            }
            },error: function(data) {
            alert("Error");
            }
        });
    }
    function btnOKFoodWait(state)
    {
      if(state<6)
      return;
      if(state==6)
      {
        acceptFood();
      }
      if(state==7)
      {
        denyFood();
      }
      if(state==8)
      {
        updateFoodWait();
      }
      state=0;
    }
    $('#btnOK').click(function(){
        $('#messagebox').modal('hide');
        btnOKFoodWait(state);
    });
  });
</script>  

