$( document ).ready(function() {

    CKEDITOR.replace( 'description', {
        filebrowserBrowseUrl: '/ckfinder/browser',

    } );

    CKEDITOR.replace( 'description_vn', {
        filebrowserBrowseUrl: '/ckfinder/browser',

    } );
});


$(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
})

setTimeout(function() {
    $('#notify_success').remove();
}, 5000);


$('#btn_add_columns').on('click',function(){
    $('table.configuration').append(
        '    <tr>' +
        '        <td><input class="form-control" name=\'configuration[]\' type=\'text\' /></td>\n' +
        '    </tr>'
    );
});


$('#btn_add_columns_vn').on('click',function(){
    $('table.configuration_vn').append(
        '    <tr>' +
        '        <td><input class="form-control" name=\'configuration_vn[]\' type=\'text\' /></td>\n' +
        '    </tr>'
    );
});

//show list image - buuton del image
$('img.listimage-edit').each(function(){
    $(this).after('<button type="button" class="btn btn-danger glyphicon glyphicon-remove del"></button>');
});
var list_id = [];
$('button.del').on('click',function(){
    $(this).parent().remove();
    var id = $(this).parent().attr('id');
    list_id.push(id);
    $('#id_del_image').val(list_id);
});


jQuery(function($){
    var fileDiv = document.getElementById("upload");
    var fileInput = document.getElementById("upload-input");
    var btnSelect = document.getElementById('btn_select');
    fileInput.addEventListener("change",function(e){
        var files = this.files
        console.log(files);
        showThumbnail(files)
    },false)

    btnSelect.addEventListener("click",function(e){
        $(fileInput).show().focus().click().hide();
        e.preventDefault();
    },false)


    fileDiv.addEventListener("dragenter",function(e){
        e.stopPropagation();
        e.preventDefault();
    },false);

    fileDiv.addEventListener("dragover",function(e){
        e.stopPropagation();
        e.preventDefault();
    },false);

    fileDiv.addEventListener("drop",function(e){
        e.stopPropagation();
        e.preventDefault();
        var dt = e.dataTransfer;
        var files = dt.files;
        console.log(files);
        fileInput.files = files;
        showThumbnail(files)
    },false);

    function showThumbnail(files){
        $('.box-image').remove();
        for(var i=0;i<files.length;i++){
            var file = files[i]

            var container = document.createElement('div');
            container.classList.add('box-image');

            var image = document.createElement("img");
            image.classList.add("img-thumbnail");
            image.file = file;
            container.appendChild(image);

            var thumbnail = document.getElementById("thumbnail");
            thumbnail.appendChild(container);

            var reader = new FileReader()
            reader.onload = (function(aImg){
                return function(e){
                    aImg.src = e.target.result;
                };
            }(image))
            var ret = reader.readAsDataURL(file);
            var canvas = document.createElement("canvas");
            ctx = canvas.getContext("2d");
            image.onload= function(){
                ctx.drawImage(image,100,100)
            }
        }
    };
});

jQuery(function($){
    var fileDiv = document.getElementById("upload_1");
    var fileInput = document.getElementById("upload-input_1");
    var btnSelect = document.getElementById('btn_select123');
    fileInput.addEventListener("change",function(e){
        var files = this.files
        console.log(files);
        showThumbnail123(files)
    },false)

    btnSelect.addEventListener("click",function(e){
        $(fileInput).show().focus().click().hide();
        e.preventDefault();
    },false)


    fileDiv.addEventListener("dragenter",function(e){
        e.stopPropagation();
        e.preventDefault();
    },false);

    fileDiv.addEventListener("dragover",function(e){
        e.stopPropagation();
        e.preventDefault();
    },false);

    fileDiv.addEventListener("drop",function(e){
        e.stopPropagation();
        e.preventDefault();
        var dt = e.dataTransfer;
        var files = dt.files;
        console.log(files);
        fileInput.files = files;
        showThumbnail123(files)
    },false);

    function showThumbnail123(files){
        $('.box-image123').remove();
        for(var i=0;i<files.length;i++){
            var file = files[i]

            var container = document.createElement('div');
            container.classList.add('box-image123');

            var image = document.createElement("img");
            image.classList.add("img-thumbnail123");
            image.file = file;
            container.appendChild(image);

            var thumbnail = document.getElementById("thumbnail123");
            thumbnail.appendChild(container);

            var reader = new FileReader()
            reader.onload = (function(aImg){
                return function(e){
                    aImg.src = e.target.result;
                };
            }(image))
            var ret = reader.readAsDataURL(file);
            var canvas = document.createElement("canvas");
            ctx = canvas.getContext("2d");
            image.onload= function(){
                ctx.drawImage(image,100,100)
            }
        }
    };
});

$(document).ready(function () {
    var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');
          allPreviousBtn = $('.PreviousBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
         var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    allPreviousBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });


    $('div.setup-panel div a.btn-primary').trigger('click');
});

$(document).ready(function(){
    var timeout = null;
    $('#search').on('keyup',function(){
        clearTimeout(timeout);
        timeout = setTimeout(function(){
            callAjax();
        },500);
    });

    $('#status').change(function(){
        clearTimeout(timeout);
        timeout = setTimeout(function(){
            callAjax();
        },500);
    });

    $('#category').change(function(){
        clearTimeout(timeout);
        timeout = setTimeout(function(){
            callAjax();
        },500);
    });


    $(function() {
      $('input[name="datetimes"]').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
          format: 'YYYY-MM-DD HH:mm:ss'
        }
      });
    });

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        $('input[name=daterangepicker_start]').val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
        $('input[name=daterangepicker_end]').val(picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
        callAjax();
    });

    $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
        $('input[name=daterangepicker_start]').val('');
        $('input[name=daterangepicker_end]').val('');
        callAjax();
    });
});


