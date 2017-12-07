$(document).ready(function(){
    function get_items(){
        $('#list_items').fadeOut();
        $('#list_items').html('');
        //Get done tasks
        $.get( "../api/index.php/todo_list?order=date_updated&sort=DESC&done=1", function( data ) {
            for (var i = 0; i < data.results.length; i++) {
                $('#list_items').append('<li class="list-group-item">' +
                    '<label class="form-check-label">' +
                    '<input class="form-check-input" type="checkbox" class="done-item" checked ' +
                    'data-item-id="'+data.results[i].list_item_id+'">' +
                    '<del>'+data.results[i].label+'</del>' +
                '</label>' +
                '<span class="pull-right">' +
                '<button class="btn btn-xs btn-default" data-item-id="'+data.results[i].list_item_id+'">' +
                '<i class="fa fa-trash del-item" aria-hidden="true"></i>' +
                '</button>'+
                    '</span>'+
                '</li>').hide().fadeIn();
            }
        });
        //Get open Tasks
        $.get( "../api/index.php/todo_list?order=date_updated&sort=DESC&done=0", function( data ) {
            for (var i = 0; i < data.results.length; i++) {
                $('#list_items').append('<li class="list-group-item">' +
                    '<label class="form-check-label">' +
                    '<input class="form-check-input" type="checkbox" class="done-item" ' +
                    'data-item-id="'+data.results[i].list_item_id+'">' +
                    data.results[i].label +
                    '</label>' +
                    '<span class="pull-right">' +
                    '<button class="btn btn-xs btn-default" data-item-id="'+data.results[i].list_item_id+'">' +
                    '<i class="fa fa-trash del-item" aria-hidden="true"></i>' +
                    '</button>'+
                    '</span>'+
                    '</li>').hide().fadeIn();
            }
        });
    }

    function post_item(){
        $.post( "../api/index.php/todo_list", { label: $("#new_item").val(), done: "0" })
        .done(function( data ) {
            if(data.status){
                $('#list_items').append('<li class="list-group-item">' +
                    '<label class="form-check-label">' +
                    '<input class="form-check-input" type="checkbox" class="done-item" ' +
                    'data-item-id="'+data.results.list_item_id+'">' +
                    $("#new_item").val() +
                    '</label>' +
                    '<span class="pull-right">' +
                    '<button class="btn btn-xs btn-default" data-item-id="'+data.results.list_item_id+'" >' +
                    '<i class="fa fa-trash del-item" aria-hidden="true"></i>' +
                    '</button>'+
                    '</span>'+
                    '</li>').hide().fadeIn();
            }
            $("#new_item").val('');
        });
    }

    function delete_item(item_id){
        $.ajax({
            url: '../api/index.php/todo_list?list_item_id='+item_id,
            type: 'DELETE',
            success: function(result) {
                get_items();
            }
        });
    }

    function put_item(item_id, done){
        $.ajax({
            url: '../api/index.php/todo_list?list_item_id='+item_id+'&done='+done,
            type: 'PUT',
            success: function(result) {
                get_items();
            }
        });
    }

    //on load
    get_items();

    $( ".btn-add" ).click(function() {
        if( !$("#new_item").val() ) {
        }else{
            post_item();
        }
    });

    $( "#list_items" ).on( "click", "button", function() {
        delete_item($(this).attr('data-item-id'));
    });

    $( "#list_items" ).on( "click", "input", function() {
        if($(this).is(":checked")){
            put_item($(this).attr('data-item-id'), '1');
        }else{
            put_item($(this).attr('data-item-id'), '0');
        }
    });
});
