
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h1 class="m-0 font-weight-bold text-primary">List Food</h1>
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
                @foreach ($listfood as $food)
                    <tr>
                        <!-- <td>{{$food['FoodID']}}</td> -->
                        <td>{{$food['FoodName']}}</td>
                        <td>{{$food['Prices']}}</td>
                        <td>{{$food['ShortDescription']}}</td>
                        <td>{{$food['LongDescription']}}</td>
                        <td>{{$food['AvgSurvey']}}</td>
                        <td>{{$food['RestaurantID']}}</td>
                        <td><button type="button" class="btn btn-info btnGetPicture" value="{{$food['PictureToken']}}" data-id="{{$food['FoodID']}}">Xem hình</button></td>
                        <td>
                        @if ($food['Status'] == 1)
                        <button  type="button" class="btn btn-success btnActive"  data-id="{{$food['FoodID']}}">Active</button>
                        @else
                          <button type="button" class="btn btn-warning btnDeActive" data-id="{{$food['FoodID']}}">Deactive</button>
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
@include('getPicture')
<script>
$(document).ready(function(){
//Xem hình của food
$(".btnGetPicture").click(function(){
  var id=$(this).data('id');
  var urlget='http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/permalink/getpermalinkbyid/'+id;
  $.ajax({
    type: 'GET',
            url: urlget,
            dataType: 'json',
            success: function(data) {
              console.log(data);
              let html = "";
			        for(let i = 0;i<data.length;i++){
				      html+="<img padding='10' width='463px' src='http://testserver.22domain.com/"+data[i].PicturePermalink+"'>";
              }
              if(html == ""){
                $("#Listfoodpicture").html("<h4 class='text-center'>Không có hình nào!</h4>");
                alert("Món này không có hình");
                $('#request-modal').modal('show');
                return false;
              } else {  
                $("#Listfoodpicture").html(html);
                $('#request-modal').modal('show');
              }
                    },error: function(data) {
                    alert("error server");
                    }
                });
    });
  });
</script>  

