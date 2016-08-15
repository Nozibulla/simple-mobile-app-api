(function($){

	$('#edit_category').modal('hide');

	$('#edit_writer').modal('hide');


	var productManager = {

		init : function(){

			$('.main').on('submit','.add_product form[data-remote]', this.saveProduct);

			$('.main').on('submit','.add_category form[data-remote]', this.saveCategory);

			$('.main').on('submit','#edit_category form[data-remote]', this.saveEditedCategory);

			$('.main').on('click','.editClass', this.editCategory);

			$('.main').on('click','.deleteClass', this.deleteCategory);

			$('.main').on('submit','.add_writer form[data-remote]', this.saveWriter);

			$('.main').on('submit','#edit_writer form[data-remote]', this.saveEditedwriter);

			$('.main').on('click','.edit_writer', this.editWriter);

			$('.main').on('click','.delete_writer', this.deleteWriter);

			$('.main').on('click','.deletebook', this.deleteBook);


		},

		deleteBook: function(e){

			e.preventDefault();

			// alert('hi');

			if (confirm("Do you really want to delete this Book?")) {

				var clickedBook = $(this);

				var clickedBookId = clickedBook.data('id');

				$.ajax({

					type : "POST",

					url  : "/delete_book",

					headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

					data : {id : clickedBookId} 
				})
				.done(function(){

					var currentPageUrl = window.location.href;

					$('.book_list').load(currentPageUrl+' .book_list');
				})
				.fail(function(){

					alert("error");

				});
			}
		},


		deleteWriter: function(e){

			e.preventDefault();

			// alert('hi');

			if (confirm("Do you really want to delete this Writer?")) {

				var clickedWriter = $(this);

				var clickedWriterId = clickedWriter.data('id');

				$.ajax({

					type : "POST",

					url  : "/delete_writer",

					headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

					data : {id : clickedWriterId} 
				})
				.done(function(){

					var currentPageUrl = window.location.href;

					$('.writer_list').load(currentPageUrl+' .writer_list');
				})
				.fail(function(){

					alert("error");

				});
			}
		},

		editWriter: function(e){

			e.preventDefault();

			var clickedWriter = $(this);

			var clickedWriterId = clickedWriter.data('id');

			var clickedWriterName = clickedWriter.data('writer-name');

			$('.writer').val(clickedWriterName);

			$('.writer_id').val(clickedWriterId);

			$('#edit_writer').modal('show');



		},

		saveEditedwriter: function(e){

			e.preventDefault();

			var WriterId = $('.writer_id').val();

			var WriterName = $('.writer').val();

			// alert(CategoryId);

			$.ajax({

				type : "POST",

				url  : "/save_edited_writer",

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : {id : WriterId, writer: WriterName} 
			})
			.done(function(){

				$('#edit_writer').modal('hide');

				var currentPageUrl = window.location.href;

				$('.writer_list').load(currentPageUrl+' .writer_list');

			})
			.fail(function(){

				alert("error");

			});
		},

		saveWriter: function(e){

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

				$('.writer_list').load(currentPageUrl+' .writer_list');

			})
			.fail(function(){

				alert("error");

			});
		},

		deleteCategory: function(e){

			e.preventDefault();

			if (confirm("Do you really want to delete this Category?")) {

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

			var bar = $('.progress-bar');

			$('.progress').show();
			
			$.ajax({

				xhr: function() {

					var percentComplete= 0;

					var xhr = new window.XMLHttpRequest();

					xhr.upload.addEventListener("progress", function(evt) {

						if (evt.lengthComputable) {

							var percentComplete = evt.loaded / evt.total;

							percentComplete = parseInt(percentComplete * 100);

							bar.width(percentComplete+ '%');

							bar.html('Completed ' + percentComplete + '%');


						}
					}, false);

					return xhr;
				},

				type : method,

				url  : url,

				contentType: false,

				processData: false,

				data : dataString,

			})
			.done(function(){

				var currentPageUrl = window.location.href;

				$('body').load(currentPageUrl);

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