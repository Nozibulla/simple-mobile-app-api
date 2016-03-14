(function($){


	var productManager = {

		init : function(){

			$('.container').on('submit','.add_product form[data-remote]', this.saveProduct);

		},

		saveProduct: function(e){

			e.preventDefault();

			// alert('hi');
			
			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = new FormData(this);
			
			$.ajax({

				type : method,

				url  : url,

	            contentType: false,

	            processData: false,

				data : dataString,

			
			})
			.done(function(){

				form.trigger('reset');

				var message = form.data('remote-success');

				alert(message);


			})
			.fail(function(){

				alert("error");

			});


		},
	};

	$(function(){

		productManager.init();

	});

})(jQuery);