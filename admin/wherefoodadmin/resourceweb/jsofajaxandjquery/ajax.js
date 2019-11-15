$(document).ready(function(){
    //active
    $('.btnActive').click(function(){
    var user=$(this).data('id');
    $.ajax({
            type: 'POST',
            url: 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/user/updatestatusfalse',
            data: {
            UserAccount: user,
            },
            dataType: 'json',
            success: function(data) {
            if(data==0)
            {
                alert("Thất bại");
            }else
            {
                window.location.reload();
                alert("Thành công");
            }
            },error: function(data) {
            alert("Lỗi rồi");
            }
        });
    });

    //deactive
    $('.btnDeActive').click(function(){
    var user=$(this).data('id');
    $.ajax({
            type: 'POST',
            url: 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/user/updatestatustrue',
            data: {
            UserAccount: user,
            },
            dataType: 'json',
            success: function(data) {
            if(data==0)
            {
                alert("Thất bại");
            }else
            {
                window.location.reload();
                alert("Thành công");
            }
            },error: function(data) {
            alert("Lỗi rồi");
            }
        });
    });
    //get list food active and deactive
    $("#listfood").click(function(){
        alert('Bạn đã chọn list food');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/food/getallfoodactiveanddeactive',
            dataType: 'json',
            success: function(data) {
                $.ajax({
                    type: 'POST',
                    url: './listfood',
                    data: {
                    listfood: data,
                    },
                    dataType: 'json',
                    success: function(data) {
                    $('.main').html(function(){
                        return data;
                    });
                    },error: function(data) {
                        console.log(data);
                    alert("error client rồi");
                    }
                });
            },error: function(data) {
            alert("error server");
            }
        });
    });
    
});

