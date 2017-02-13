/**
 * Created by Mario on 09/02/2017.
 */

$(function() {
	$("#error-block").hide();
	$('form').on('submit', function(e) {
		e.preventDefault();
		var url=this.action;
		console.log(url);
		var form=$(this);
		var btn=$(this).find("button[type='submit']");
		var btnvalue=btn.text();
		
		$.ajax({
			type:'POST',
			url:url,
			data:form.serialize(),
			beforeSend:function () {
				$("#error-block").hide();
				btn.text("Enviando...");
			},
			success:function (response) {
				var data=JSON.parse(response);
				console.log(data);
				if(data.status==1){
					console.log(response);
				}else{
					console.log(data.mensaje);
					var dismiss='<button type="button" class="close" data-dismiss="alert">×</button>';
					$("#error-block").html(dismiss+" "+data.mensaje).slideDown();
				}
				btn.text(btnvalue);
			}
		});
	});
});