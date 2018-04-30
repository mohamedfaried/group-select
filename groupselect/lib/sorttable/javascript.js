$("select").on('change', function () {
    var thisForm = $(this).closest('form');
    $.get($thisForm.attr('action'), $thisForm.serialize());
});