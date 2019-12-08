$(document).ready(function(){
    
    //get list food active and deactive
    $("#listfood").click(function(){
        alert('You clicked list food');
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
        alert('You clicked list food waitting');
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
                    alert("error client");
                    }
                });
            },error: function(data) {
            alert("error server");
            }
        });
    });
});

