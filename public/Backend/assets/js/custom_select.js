function custom_select2(modalId) {
    $(modalId).on('show.bs.modal', function (event) {
        $(modalId).find('select').each(function () {
            if (!$(this).hasClass("select2-hidden-accessible")) {
                $(this).select2({
                    dropdownParent: $(modalId),
                    placeholder: "---Select---"
                });
            }
        });
    });
}
