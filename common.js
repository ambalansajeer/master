(function($){
    // this validation if value is isset or not
    $.fn.valIsSet = function(value) {
        if (typeof value === "undefined") {
            return false;
        }
        if(value.length){
            return true;
        }else{
            return false;
        }
    };
    // this value append for
    $.fn.valAppend = function(value,opt="con" ) {
        if (opt === "con") {
            val = $(this).val()
            val = val+value
            $(this).val(val);
        }else{
            return true;
        }
    };

    //disable form
    $.fn.formEnable = function(enable,except=[]){
        form = $(this);

        form.find("select,input,textarea").each(function(ii,ele){
            if($.inArray(ele.id,except) != -1){
                return 0;
            }
            if($(ele).is('select')){
                $(ele).prop("disabled", enable);
            }else if($(ele).is('input')){
                $(ele).prop("disabled", enable);
            }else if($(ele).is('textarea')){
                $(ele).prop("disabled", enable);
            }
        });
    };


    // this ajax
    $.fn.appAjax = function(url,responseFunction="handleappAjax",method="get",dataType="json",data={},async=false) {
        $.ajax({
            url: url,

            type: method,

            dataType: dataType,

            data: data,
            async: async,
            processData: false,
            contentType: false,

            /**
             * A function to be called if the request fails.
             */
            error: function(jqXHR, textStatus, errorThrown) {
                if(jqXHR.status == "403"){
                    $.alert(jqXHR.responseText);
                }else{
                    form = $('form[form-response="'+responseFunction+'"]');
                    if(form.length){
                        val = $.parseJSON(jqXHR.responseText);
                        console.log(val.errors);
                        form.find('div').removeClass("has-error");
                        $.each(val.errors,function(ii,ele){
                            element = form.find('[name="'+ii+'"]').first();
                            console.log(ii,element);
                            if(element.length == 0){
                                element = form.find('[name="'+ii+'[]"]').first();
                            }
                            if(element.data('select2')){
                                element.closest("div").find(".select2").first().attr("data-toggle","tooltip").attr("title",ele[0]).addClass("has-error");
                            }
                            // console.log(element);
                            div = element.closest(".form-group").addClass("has-error");
                            element.attr("data-toggle","tooltip").attr("title",ele[0]);
                        });
                        $('[data-toggle="tooltip"]').tooltip();
                    }

                    // console.log('jqXHR:');
                    // console.log(jqXHR);
                    // console.log('textStatus:');
                    // console.log(textStatus);
                    // console.log('errorThrown:');
                    // console.log(errorThrown);
                }
                return {};
            },

            /**
             * A function to be called if the request succeeds.
             */
            success: function(data1, textStatus, jqXHR) {
                $.fn[responseFunction](data1);
            }
        });
    };


    $.fn.appAjax2 = function(url,responseFunction="handleappAjax",method="get",dataType="json",data={},async=false) {
        $.ajax({
            url: url,

            type: method,

            dataType: dataType,

            data: data,
            async: async,
            // processData: false,
            // contentType: false,

            /**
             * A function to be called if the request fails.
             */
            error: function(jqXHR, textStatus, errorThrown) {
                if(jqXHR.status == "403"){
                    $.alert(jqXHR.responseText);
                }else{
                    $.alert('<div>'+jqXHR.responseText + '</div>');
                    // console.log('jqXHR:');
                    // console.log(jqXHR);
                    // console.log('textStatus:');
                    // console.log(textStatus);
                    // console.log('errorThrown:');
                    // console.log(errorThrown);
                }
                return {};
            },

            /**
             * A function to be called if the request succeeds.
             */
            success: function(data1, textStatus, jqXHR) {
                $.fn[responseFunction](data1);
            }
        });
    };









    //jquery Validator
    if(typeof $.validator  !== "undefined"){
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $.validator.addMethod('filesize', function (value, element, param) {
            size = 0;
            $.each(element.files,function(ii,ele){
                size += ele.size;
            });
            return this.optional(element) || (size <= param)
        },function(params, element) {
            return  'File size must be less than {'+(params/1000000)+'M}';
        });
        $.validator.addMethod('freeUrl', function (value, element, param) {
            var url = value;
            var pattern = /(?:https?:\/\/)?(?:[a-zA-Z0-9.-]+?\.(?:[a-zA-Z])|\d+\.\d+\.\d+\.\d+)/;

            return pattern.test(url);
        },function(params, element) {
            return  'Enter Valid Url';
        });
        $.validator.addMethod('emailvalidate', function (value, element, param) {
            if(param == "comma"){
                str = $(element).val().split(",");
            }else if(param == "one"){
                str = [value]
            }
            flag =true;

            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            $.each(str,function (ii, ele) {
                if (!filter.test(ele)) {
                    flag = false;
                }
            });
            if(!value.length){
                flag =true;
            }
            return flag;
        }, function(params, element) {
            if(params == "one"){
                return "Enter Valid Email"
            }
            return 'Enter valid email with comma Separated';
        });
    }

    $(function(e){
        $('body').on("click",".dt-buttons a",function(es){
            $near = $(this).closest(".dataTables_wrapper").find('table').first();
            $area = ($near.attr("data-area"));
            $type = $(this).text();
            url = window.reportUrl;
            if(url){
                if($area && $type){
                    $.post(url,{area:$area,type:$type},function(data){
                        if(data.status == "Error"){
                            $.alert(data.html);
                        }
                    });
                }else{
                    $.alert("please add DataTable data-area");
                    es.preventDefault();
                }
            }else{
                es.preventDefault();
                $.alert("please add DataTable Report url")
            }

        });
    })

})(jQuery);
