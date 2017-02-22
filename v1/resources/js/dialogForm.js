//GET DATA


function getFormData(url) {
    $.get(url,function (data) {
        console.log(data);
        if(data.status==1){
            formSwalDialog(data.title,data.html);
        }
    }).fail(function (xhr, status, error) {
        alert(error);
    });
    return false;
}

function getFormDataforUpdate(url,datavalues) {
    $.get(url,{"values[]":datavalues},function (data) {
        if(data.status==1){
            console.log(data);
            formSwalDialog(data.title,data.html);
        }
    }).fail(function (xhr, status, error) {
       alert(error);
    });
    return false;
}

//Make Form in Dialog
function formSwalDialog(title, html) {
    swal({
        title: title,
        html: html,
        showCancelButton: false,
        showConfirmButton:false,
        onOpen:function () {
            var form=$(".form-dialog-sw");
            var button=form.find('button[type="submit"]');
            $(form).on('submit',function (e) {
                e.preventDefault();
                button.hide();
                swal.showLoading();
                showHtmlView(form.serialize(),form.attr('action'),button);
            })
        }


    });
}


//Present Data in VIEW
function showHtmlView(data, url, button){
    $.post(url,data,function (response) {
        console.log(response);
        if(response.status==0){
            swal.showValidationError(response.message);
            swal.hideLoading();
            button.show();
        }else{
            if(response.html&&response.element){
                $(response.element).html(response.html);
            }

            swal(
                'Terminado!',
                response.message,
                'success'
            )
        }

    }).fail(function (xhr, status, error) {
        swal(
            'Error',
            error,
            'error'
        );

    });

}


//REMOVE MULTIPLE DATA
function multipleDelete(url,datavalues,elements) {
    //console.log(idObjHtml);
    swal.queue([{
        title: '¿Desea eliminar los registros seleccionados?',
        showCancelButton: true,
        confirmButtonColor: '#f55246',
        confirmButtonText: 'Eliminar',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                $.post(url,{"multiple[]":datavalues},function (data) {
                    if(data.status==0){
                        swal(
                            'Error',
                            data.message,
                            'error'
                        )
                    }else{

                        swal(
                            'Terminado!',
                            data.message,
                            'success'
                        );
                        console.log(elements);
                        $(elements).each(function (i) {
                            console.log(i);
                            this.closest("tr").remove();
                        });
                    }
                }).fail(function(xhr, status, error) {
                    console.log(error);
                    swal(
                        'Error',
                        "No se pudieron eliminar los elementos seleccionados",
                        'error'
                    )
                });
            })
        },
        allowOutsideClick: false
    }]);
    return false;
}




//Image Dialogs
function newImageDialog(url){
    console.log(url);
    swal({
        title: 'Sube un archivo multimedia',
        input: 'file',
        inputAttributes: {
            class:'form-control'
        }
    }).then(function (file) {
        var reader = new FileReader
        reader.onload = function (e) {
            var preview;
            var title='Subir imagen ahora';
            if (file.type.match('image.*')) {
                preview=e.target.result;
            }
            else {
                preview =BASE_URL+"/resources/img/commons/noimage.png";
                title="No se puede mostrar la vista previa, no es una imagen";
            }
            swal({
                title:title,
                input:'text',
                inputPlaceholder:'Añade una breve descripcion',
                imageUrl: preview,
                showCancelButton: true,
                confirmButtonText: 'Subir',
                showLoaderOnConfirm: true,
                preConfirm: function (id) {
                    return new Promise(function (resolve) {
                        uploadFiletoServer(url,file,$(".swal2-input").val());
                    })
                }
            })
        }
        reader.readAsDataURL(file)
    });
    return false;
}
function uploadFiletoServer(url,file,value) {
    var form_data = new FormData();
    form_data.append('file', file);
    form_data.append('alt',value);
    console.log(file);
    $.ajax({
        url: url,
        type: "post",
        dataType:"json",
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success:function (response) {
           location.reload();
        },
        error:function (error) {
            swal(
                'Error',
                error,
                'error'
            )
        }
    })
}