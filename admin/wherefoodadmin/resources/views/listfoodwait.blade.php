
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
                    <tr class="editFood" data-id={{$food['FoodID']}}>
                        <!-- <td>{{$food['FoodID']}}</td> -->
                        <td>{{$food['FoodName']}}</td>
                        <td>{{$food['Prices']}}</td>
                        <td>{{$food['ShortDescription']}}</td>
                        <td>{{$food['LongDescription']}}</td>
                        <td>{{$food['AvgSurvey']}}</td>
                        <td>{{$food['RestaurantName']}}</td>
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
      var id=$("#txt-foodID") .val();
      var foodname=$("#txt-foodname") .val();
      var price=$("#txt-price") .val();
      var shortdescription=$("#txt-shortdescription") .val();
      var longdescription=$("#txt-longdescription") .val();
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
                alert("Fail Active");
            }else
            {
                alert("Success");
                $('#edit-food').modal('hidden');
                return;
            }
            },error: function(data) {
            alert("Error");
            }
        });
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
    var id=$(this).data('id');
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
                alert("Thất bại");
            }else
            {
              $('#'+id).remove();
                alert("Thành công");
            }
            },error: function(data) {
            alert("Lỗi rồi");
            }
        });
    });

    //deny
    $('.btnDeActive').click(function(){
    var id=$(this).data('id');
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
                alert("Thất bại");
            }else
            {
                $('#'+id).remove();
                alert("Thành công");
            }
            },error: function(data) {
            alert("Lỗi rồi");
            }
        });
    });


  });
</script>  

