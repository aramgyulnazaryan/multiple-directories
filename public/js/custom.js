$(function () {
   $('.level_one').click(function () {
       var level_id = $(this).data('id')
      $('#myModal .create_level').attr('data-levelid', level_id);
      $('#myModal .create_level').attr('data-leveltype', 'level_two');
       $('#myModal .status').parent('div').show();
   });

    $('body').delegate('.level_two', 'click', function () {
        var level_id = $(this).data('id')
        $('#myModal .create_level').attr('data-levelid', level_id);
        $('#myModal .create_level').attr('data-leveltype', 'level_three');
        $('#myModal .status').parent('div').show();
    });

    $('body').delegate('.level_three', 'click', function () {
        var level_id = $(this).data('id')
        $('#myModal .create_level').attr('data-levelid', level_id);
        $('#myModal .create_level').attr('data-leveltype', 'level_four');
        $('#myModal .status').parent('div').hide();
    });

   $('body').delegate('.create_level', 'click', function () {
      var name = $('#myModal .levelname').val();
      var id = $(this).attr('data-levelid');
      var level_type = $(this).attr('data-leveltype');
      var status;
      var url;

       switch(level_type) {
           case 'level_two':
               url = 'create/leveltwo';
               break;

           case 'level_three':
               url = 'create/levelthree';
               break;
           case 'level_four':
               url = 'create/levelfour';
               break;
       }


       if ($('#myModal .status').is(":checked"))
       {
           status = 1;
       } else {
           status = 0;
       }

       $('#myModal .levelname').val('');
       $('#myModal .status').prop("checked", false );

       if(name != '') {
           $.ajax({
               url: domain + '/' + url,
               type: 'POST',
               data: {id: id, levelname: name, status: status},
               dataType:"json",
               success: function (data) {
                   $('#myModal').modal('hide');
                   $('.msg h3').show();

                   if(data.status == 1) {
                       $('.msg h3').text('directory created');
                       $('.msg h3').addClass('success');
                   } else {
                       $('.msg h3').text('directory not created');
                       $('.msg h3').addClass('error');
                   }

                   setTimeout( function () {
                       $('.msg h3').text('');
                       $('.msg h3').hide();
                   }, 3000);
               }
           });
       }
   });

    $('body').delegate('.getchilddirectories', 'click', function () {
        var level_id = $(this).attr('data-id');
        var level = $(this).attr('data-level');
        var prev_level;
        var next_level;
        if(level == 'level_one') {
            next_level = 'level_two';
        } else if(level == 'level_two') {
            next_level = 'level_three';
        }else if (level == 'level_three') {
            next_level = 'level_four';
        }

        $.ajax({
            url: domain + "/get/child/directory",
            type: 'POST',
            data: {id: level_id, level: next_level},
            dataType:"json",
            success: function (data) {
                $('#'+level+level_id + ' .getchilddirectories').text('-');
                $('#'+level+level_id + ' .getchilddirectories').addClass('open');
                $('#'+level+level_id + ' .getchilddirectories').removeClass('getchilddirectories');

                if(next_level == 'level_four') {
                    $.each(data, function(k, v) {
                        $('#'+level+level_id+' > ul').append('<li id="'+ next_level + v.id+'"><span class="btn btn-default '+ next_level +'" data-id="'+v.id+'">'+v.name+'</span></li>');
                    });
                } else {
                    $.each(data, function(k, v) {
                        if( v.status == 1) {
                            $('#'+level+level_id+' > ul').append('<li id="'+ next_level + v.id+'"><span class="btn btn-default '+ next_level +'" data-id="'+v.id+'">'+v.name+'</span></li>');
                        } else {
                            $('#'+level+level_id+' > ul').append('<li id="'+ next_level + v.id+'"><span class="btn btn-default '+ next_level +'" data-toggle="modal" data-target="#myModal" data-id="'+v.id+'">'+v.name+'</span><span data-id="'+v.id+'" data-level="'+ next_level +'" class="getchilddirectories">+</span><ul></ul></li>');
                        }
                    });
                }

            }
        });
    });

    $('body').delegate('.open', 'click', function () {
        $(this).removeClass('open').addClass('getchilddirectories');
        $(this).closest('li').find('ul > li').remove();
        $(this).text('+');
    });
});