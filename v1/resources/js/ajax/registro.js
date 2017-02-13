/**
 * Created by Mario on 09/02/2017.
 */


$(function() {

    $("#error-block").hide();
	$('#form-registro-user').on('submit', function(e) {
		e.preventDefault();
		var url=this.action;
		console.log(url);
        var form=$(this);
		$.ajax({
			type:'POST',
			url:url,
			data:form.serialize(),
			beforeSend:function () {
				$("#error-block").hide();
                $("#registerbtn").val("Registrando...");
			},
			success:function (response) {
                var data=JSON.parse(response);
				if(data.status==1){
                    console.log(response);
				}else{
                    console.log(data.mensaje);
                    var dismiss='<button type="button" class="close" data-dismiss="alert">×</button>';
					$("#error-block").html(dismiss+" "+data.mensaje).slideDown();
				}
                $("#registerbtn").val("Registrar");
			}
		});

	});
});
