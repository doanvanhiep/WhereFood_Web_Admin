$(document).ready(function(){
    $('.btnChange').click(function(){
    var user=$(this).data('id');
    var urlChange='http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/user/updatestatustrue';
    if($('#'+user).hasClass('btnActive'))
    {
        urlChange='http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/user/updatestatusfalse';
    }
    
    $.ajax({
            type: 'POST',
            url: urlChange,
            data: {
            UserAccount: user,
            },
            dataType: 'json',
            success: function(data) {
            if(data==0)
            {
                alert("Fail Active");
            }else
            {
                if($('#'+user).hasClass('btnActive'))
                {
                    $('#'+user).addClass('btn-warning btnDeactive');
                    $('#'+user).text("Deactive");
                    $('#'+user).removeClass("btn-success btnActive");
                }
                else{
                    $('#'+user).addClass('btn-success btnActive');
                    $('#'+user).text("Active");
                    $('#'+user).removeClass("btn-warning btnDeactive");
                }
                alert("Success");
                return;
            }
            },error: function(data) {
            alert("Error");
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
            url: 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/food/getallfoodactiveanddeactivewithinforestaurant',
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
                    alert("error client");
                    }
                });
            },error: function(data) {
            alert("error server");
            }
        });
    });
    
    //get list waitting food accept or deny
    $("#listfoodwait").click(function(){
        alert('Bạn đã chọn list food waitting');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: 'http://localhost:81/WhereFood-API-Server/api/wherefood/public/api/food/getallfoodwaittingwithinforestaurant',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $.ajax({
                    type: 'POST',
                    url: './listfoodwaitting',
                    data: {
                    listfoodwait: data,
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

