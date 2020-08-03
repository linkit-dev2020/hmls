// The following code for to appear the name of file in select
$(".imageField").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".imageFieldLabel").addClass("selected").css("direction", "rtl").html(fileName).append('<i class="fa fa-upload pull-left" aria-hidden="true" style="margin-top:3px;"></i>');
});

// Ajax dropdown 
jQuery(document).ready(function ()
    {
            jQuery('select[name="linkable_type"]').on('change',function(){
               var type = jQuery(this).val();
               if(type)
               {
                  jQuery.ajax({
                     url : 'dropdownlist/getdata/' +type,
                     type : "GET",
                     dataType : "json",
                     data: type,
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[linkable_id=""]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="linkable_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="linkable_id"]').empty();
               }
            });
    });

// Create Lesson
jQuery(document).ready(function () {
   jQuery('select[id="lesson_type"]').on('change', function() {
      var lesson_type = jQuery(this).val();
      if((lesson_type == "image") || (lesson_type == "word") || (lesson_type == "pdf")) {
         $("#lesson_file").show();
         $("#lesson_url").hide();
         $("#lesson_url").attr("disabled", "disabled");
         $("#embaded_code").hide();
         $("#embaded_code").attr("disabled", "disabled");
      } 
      if((lesson_type == "url")) {
         $("#lesson_url").show();
         $("#lesson_file").hide();
         $("#lesson_file").attr("disabled");
         $("#embaded_code").hide();
         $("#embaded_code").attr("disabled", "disabled");
       }
       if((lesson_type == "video")) {
         $("#embaded_code").show();
         $("#lesson_url").hide();
         $("#lesson_url").attr("disabled", "disabled");
         $("#lesson_file").hide();
         $("#lesson_file").attr("disabled");
       }
      
   });
});


// Deneme create
jQuery(document).ready(function () {
   jQuery('select[id="deneme_type"]').on('change', function() {
      var deneme_type = jQuery(this).val();
      if((deneme_type == "image") || (deneme_type == "word") || (deneme_type == "pdf")) {
         $("#deneme_file").show();
         $("#deneme_url").hide();
         $("#deneme_url").attr("disabled", "disabled");
      } if((deneme_type == "url") || (deneme_type == "video")) {
         $("#deneme_url").show();
         $("#deneme_file").hide();
         $("#deneme_file").attr("disabled");
       }
      
   });
});