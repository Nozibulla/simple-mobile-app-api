(function($){

	$('#edit_category').modal('hide');


	var productManager = {

		init : function(){

			$('.main').on('submit','.add_product form[data-remote]', this.saveProduct);

			$('.main').on('submit','.add_category form[data-remote]', this.saveCategory);

			$('.main').on('submit','#edit_category form[data-remote]', this.saveEditedCategory);

			$('.main').on('click','.editClass', this.editCategory);

			$('.main').on('click','.deleteClass', this.deleteCategory);


		},

		deleteCategory: function(e){

			e.preventDefault();

			// alert('hi');

			if (confirm("Do you really want to delete this Student?")) {

		var clickedcategory = $(this);

		var clickedcategoryId = clickedcategory.data('id');

		$.ajax({

			type : "POST",

			url  : "/deletecategory",

			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

			data : {id : clickedcategoryId} 
		})
		.done(function(){

			var currentPageUrl = window.location.href;

			$('.category_list').load(currentPageUrl+' .category_list');

		})
		.fail(function(){

			alert("error");

		});
	}
		},

		saveEditedCategory: function(e){

			e.preventDefault();

			var CategoryId = $('.category_id').val();

			var CategoryName = $('.category').val();

			// alert(CategoryId);

			$.ajax({

				type : "POST",

				url  : "/save_edited_category",

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : {id : CategoryId, name: CategoryName} 
			})
			.done(function(){

				$('#edit_category').modal('hide');

				var currentPageUrl = window.location.href;

				$('.category_list').load(currentPageUrl+' .category_list');

			})
			.fail(function(){

				alert("error");

			});
		},

		editCategory: function(e){

			e.preventDefault();

			var clickedCategory = $(this);

			var clickedCategoryId = clickedCategory.data('id');

			var clickedCategoryName = clickedCategory.data('category-name');


			$('.category').val(clickedCategoryName);

			$('.category_id').val(clickedCategoryId);

			$('#edit_category').modal('show');



		},

		saveCategory: function(e){

			e.preventDefault();

			var form = $(this);

			var method = form.find('input[name="_method"]').val() || 'POST';

			var url = form.prop('action');

			var dataString = form.serialize();

			// alert(dataString);
			
			$.ajax({

				type : method,

				url  : url,

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : dataString 
			})
			.done(function(){

				form.trigger('reset');

				var message = form.data('remote-success');

				alert(message);

				var currentPageUrl = window.location.href;

				$('.category_list').load(currentPageUrl+' .category_list');

			})
			.fail(function(){

				alert("error");

			});


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