
$(document).ready(function(){

	//Password Update
	$('#new_pwd').click(function () {
		var current_password = $('#current_pwd').val();
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_password:current_password},
			success:function (resp) {
				// alert(resp);
				if (resp == "false"){
					$('#chkPwd').html("<span class='badge badge-important'>Current Password is Incorrect</span>");
				} else if(resp == "true"){
					$('#chkPwd').html("<span class='badge badge-success'>Current Password is Correct</span>");
				}
            }, error:function () {
				alert('Error');
            }
		})
    });
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();

    // Add Category Validations
    $("#add_category").validate({
        rules:{
            category_name:{
                required:true
            },
            description:{
                required:true
            },
            url:{
                required:true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // Edit Category Validations
    $("#edit_category").validate({
        rules:{
            category_name:{
                required:true
            },
            description:{
                required:true
            },
            url:{
                required:true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // Add Product Validations
    $("#add_product").validate({
        rules:{
            category_id:{
                required:true
            },
            product_name:{
                required:true
            },
			product_code:{
            	required:true
			},
            product_color:{
                required:true
            },
			price:{
            	required:true,
				number:true
			},
			image:{
            	required:true
			}
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // Edit Product Validations
    $("#edit_category").validate({
        rules:{
            category_id:{
                required:true
            },
            product_name:{
                required:true
            },
            product_code:{
                required:true
            },
            product_color:{
                required:true
            },
            price:{
                required:true,
                number:true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength: 6,
				maxlength: 20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

    // Add Product Attributes Validations
    $('#add_attribute').validate({
        rules:{
            sku:{
                required: true
            },
            size:{
                required: true
            },
            price:{
                required: true
            },
            stock:{
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
          $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

	// Delete Category
	$('#delCat').click(function () {
		if (confirm('Are you sure to delete this category?')){
			return true;
		} else {
			return false;
		}
    });

	// Delete Product
    $('#delProduct').click(function () {
        if (confirm('Are you sure to delete this product?')){
            return true;
        } else {
            return false;
        }
    });

    // Delete Image
    $('#delImage').click(function () {
        if (confirm('Are you sure to delete this image?')){
            return true;
        } else {
            return false;
        }
    });

    // Delete Product Attribute
    $('#delProductAttribute').click(function () {
        if (confirm('Are you sure to delete this product attribute?')){
            return true;
        } else {
            return false;
        }
    });

    // Add/Remove Jquery
    $(document).ready(function () {
       var maxField = 10;
       var addButton = $('.add_button');
       var wrapper = $('.field_wrapper');
       var fieldHtml = '<div class="after-add-remove-style"><input type="text" name="sku[]" id="sku" placeholder="Sku" class="add-remove-style">' +
           '<input type="text" name="size[]" id="size" placeholder="Size" class="add-remove-style">' +
           '<input type="text" name="price[]" id="price" placeholder="Price" class="add-remove-style">' +
           '<input type="text" name="stock[]" id="stock" placeholder="Stock" class="add-remove-style">' +
           '<a href="javascript:void(0);" class="remove_button" title="Remove field"> Remove</a></div>';
       var x = 1;
       $(addButton).click(function () {
           if (x < maxField){
               x++;
               $(wrapper).append(fieldHtml);
           }
       });
       $(wrapper).on('click', '.remove_button', function (e) {
           e.preventDefault();
           $(this).parent('div').remove();
           x--;
       });
    });
});
