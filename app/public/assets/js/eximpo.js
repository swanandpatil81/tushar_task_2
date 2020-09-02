$(document).ready(function () {
    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
              allPrevBtn = $('.prevBtn');
  
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
    
    allPrevBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
  
            prevStepWizard.removeAttr('disabled').trigger('click');
    });

    
    
    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='file']"),
            isValid = true;
  
        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }
  
        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });
  
    $('div.setup-panel div a.btn-primary').trigger('click');
  });



  $(function(){
    $(document).ready(function(){
      var files;  
      $('input[type=file]').on('change', prepareUpload);
      function prepareUpload(event){
        
        files = event.target.files;

        var formData = new FormData();
        $.each(files, function(key, value){
          formData.append(key, value);
        });
        $.ajax({
          url: 'upload',  
          type: 'POST',
          data: formData,
          success: function(worksheet_response){ 
              
            var worksheet_list = ['<option value=""> Select Worksheet </option>'];
            var response_obj = JSON.parse(worksheet_response)
            if(response_obj.status == true) {
                $.each(response_obj.worksheet_names, function(key, value)
                {
                  worksheet_list.push('<option value="'+ value +'">'+ value +'</option>');
                });
                $('#worksheet_list').html(worksheet_list.join(''));
                alert("File uploaded successfully. Please click next to go ahead.")
                $('.uploadNextBtn').trigger('click');
            }
        }, 
          cache: false,
          contentType: false,
          processData: false
        });
     };

      $('#worksheet_list').on('change', function() {
      
        var formData = new FormData();
        formData.append('selected_worksheet', this.value);
        $.ajax({
            url: 'get_columns',  
            type: 'POST',
            data: formData,
            success: function(worksheet_response){ 
                
              var column_list = [];
              var table_list = ['<option value=""> Select Db Table </option>'];
  
              var response_obj = JSON.parse(worksheet_response)
  
              if(response_obj.status == true) {      
  
                  $.each(response_obj.db_column_names, function(key, value)
                  {
                    column_list.push('<label class="mx-1"><input checked="checked" class="mx-1" type="checkbox" name="worksheet_columns" value="'+ key +'">'+value+'</label>');
                  });
                  $.each(response_obj.table_list, function(key, value)
                  {
                    table_list.push('<option value="'+ value +'">'+ value +'</option>');
                  });
                  $('#column_list').html(column_list.join(''));
                  $('#table_list').html(table_list);  
                  $('#table_list').show();
                 
              }
          }, 
            cache: false,
            contentType: false,
            processData: false
          });
      });
    
      $('.btn-export').on('click', function() {

        var formData = new FormData();
        formData.append('selected_worksheet', $('#worksheet_list'). children("option:selected"). val());

        formData.append('selected_db_table', $('#table_list'). children("option:selected"). val());

        var selected_worksheet_columns = []; 
            $("input:checkbox[name=worksheet_columns]:checked").each(function() { 
               selected_worksheet_columns.push($(this).val()); 
            }); 

        formData.append('selected_worksheet_columns', selected_worksheet_columns);

        $.ajax({
            url: 'import_data',  
            type: 'POST',
            data: formData,
            success: function(worksheet_response){ 
                
              var column_list = [];
              var table_list = ['<option value=""> Select Db Table </option>'];
  
              var response_obj = JSON.parse(worksheet_response)
  
              if(response_obj.status == true) {      
  
                alert('Import operation successful');

              }
              else
              {
                alert('Something went wrong in import');
              }
          }, 
            cache: false,
            contentType: false,
            processData: false
          });








      });

    });
  });