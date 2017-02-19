/**
 * Created by Mario on 09/02/2017.
 */
$(function() {
	$('form').on('submit', function(e) {
		e.preventDefault();
		var url=this.action;
		console.log(url);
		var form=$(this);
		var btn=$(this).find("button[type='submit']");
		var btnvalue=btn.text();
		var errorblock=$(this).find('.error-block');

		$.ajax({
			type:'POST',
			url:url,
			data:form.serialize(),
			dataType : "json",
			beforeSend:function () {
				errorblock.hide();
				btn.text("Espere...");
			},
			success:function (response) {
				console.log(response);
				if(response.status==1){
					if(response.url!=null){
						window.location.href=response.url;
						console.log(response.url);
					}else if(response.html!=null){
						$(response.element).prepend(response.html);
					}
				}else{
					if(response.message!=null){
						console.log(response.message);
						errorblock.show();
						errorblock.html(response.message).slideDown;
						setTimeout(function(){ errorblock.fadeOut('fast'); }, 3000);
					}
				}
				btn.text(btnvalue);
			},
			error:function (response) {
				alert(response.responseText);
			}
		});
	});
});


