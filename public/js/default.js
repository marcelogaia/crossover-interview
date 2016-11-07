(function($, window, document) {
	$(function(){ // document.ready

		$('[data-toggle="tooltip"]').tooltip(); 

		$('.report-list, .patient-list').on('click','.item td:not(:last-child), .edit',function(){
			window.document.location =  $(this).parents('tr').data('href');
		})
		
		$('.report-list').on('click','.remove',function(){
			// TODO: REMOVE AJAX
		})
		
		$('.patient-list').on('click','.remove',function(){
			// TODO: REMOVE AJAX
		})

		$('.dtpickr').datepicker({autoclose: true});

		$('.generate').click(function(){ // TODO: Ajax to check for uniqueness
			var input = $(this).parents('.input-group').find('input');

			var pass = "";
			var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890";

			for (var x = 0; x < 10; x++) {
				var i = Math.floor(Math.random() * chars.length);
				pass += chars.charAt(i);
			}

			input.val(pass);
		});

		var newCount = 0;
		$('.add-row').click(function(){
			var blankRow = $(this).parents('table').find('tr.blank').clone();
			blankRow.removeClass('blank');
			blankRow.html(blankRow.html().replace(/\[x\]/g,'[new-'+newCount+']'));
			blankRow.find('.dtpickr').datepicker({autoclose: true});

			$(this).parents('tr').before(blankRow);

			newCount++;
		});

		$(document).on('change','.test-select',function(){
			console.log('change');
			var str = "";
			$(this).find("option:selected" ).each(function() {
				str += $(this).data('expected');
			});
			$(this).parents('tr').find('.expected').html(str);
		});

		$('select.patients').on('change',function(){
			var ajaxUrl = $(this).data('url');

			$(this).find("option:selected" ).each(function() {
				patientId = $(this).val();
				ajaxUrl += patientId;

				$.ajax({
				    type: "GET",
					url: ajaxUrl,
					complete: function(returnData){
						var patient = returnData.responseJSON;
						$('.dob .data').html(patient.dob);
						$('.sex .data').html(patient.sex);
					}
				})
			});

		});

		$('button.remove').click(function(){
			var table 		= $(this).parents('table');
			var tr 			= $(this).parents('tr');
			var object 		= table.data('object');
			var id 			= tr.data('id');
			var pseudoName 	= tr.find('td').eq(1).text();
			var deleteUrl 	= table.data('delete-url');

			if(confirm('Are you sure you want to delete the '+object+': '+pseudoName)){
				$.ajax({
					url: deleteUrl + id,
					complete: function(returnData){
						if(returnData.responseText == ""){
							tr.fadeOut();
						}
					}
				})
			}
		});

	})
}(window.jQuery, window, document));
