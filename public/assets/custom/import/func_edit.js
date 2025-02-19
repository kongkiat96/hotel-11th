$("#saveEditBlacklist").on("click", function (e) {
    e.preventDefault();
    removeValidationFeedback();
    const form = $("#formEditBlacklist")[0];
    const id = $('#id').val();
    const fv = setupFormValidationBlacklist(form);
    const formData = new FormData(form);

    fv.validate().then(function (status) {
        if (status === 'Valid') {
            postFormData("/import/edit-blacklist/" + id, formData)
                .done(onSaveEditBlacklistSuccess)
                .fail(handleAjaxSaveError);
        }
    });
});

function onSaveEditBlacklistSuccess(response) {
    handleAjaxEditResponse(response);
    closeAndResetModal("#editBlacklistModal", "#formEditBlacklist");
}