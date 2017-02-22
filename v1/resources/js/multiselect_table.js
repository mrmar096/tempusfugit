$(function () {
    var values=[];
    var url;

    $(document).on("change",'.multiselect-checkbox input[type="checkbox"]',function (e) {
        if($(this).data("edit")!=""){
            $(".btn-edit").attr("disabled",!($('.multiselect-checkbox input[type="checkbox"]:checked').length==1));
        }
        if($(this).data("delete")!=""){
            $(".btn-delete").attr("disabled",!($('.multiselect-checkbox input[type="checkbox"]:checked').length>=1));
        }
    });

    $(document).on("click",".btn-edit",function (e) {
        e.preventDefault();
        if(!$(this).attr("disabled")){
            var input=$('.multiselect-checkbox input[type="checkbox"]:checked');
            values=input.data("values").split(',');
            url=this.href;
            url+=input.data("edit");
            getFormDataforUpdate(url,values);
        }

    });
    $(document).on("click",".btn-delete",function (e) {
        e.preventDefault();
        var elements=[];
        if(!$(this).attr("disabled")){
            $('.multiselect-checkbox input[type="checkbox"]:checked').each(function (i) {
                values.push($(this).data("delete"));
                elements.push(this);
            });
            console.log(elements);
            multipleDelete(this.href,values,elements);
            values=[];
        }

    })

});