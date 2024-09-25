  function handleSubmit(formSelector) {
    $(formSelector).submit(function(e) {
        e.preventDefault();

        /* Get the submit button */
        var submitBtn = $(this).find('button[type="submit"]');
        var originalBtnText = submitBtn.html();

        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden"></span>');
        submitBtn.prop('disabled', true);

        var form = $(this);
        var formData = new FormData(this);

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    form[0].reset();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) { 
                     /* Validation error*/
                    var errors = xhr.responseJSON.errors;

                    /* Loop through the errors and show them using toastr*/
                    $.each(errors, function(field, messages) {
                        $.each(messages, function(index, message) {
                            /* Display each error message*/
                            toastr.error(message); 
                        });
                    });
                } else {
                    /*General error message*/ 
                    toastr.error('An error occurred. Please try again.');
                }
            },
            complete: function() {
                submitBtn.html(originalBtnText);
                submitBtn.prop('disabled', false);
            }
        });
    });
}