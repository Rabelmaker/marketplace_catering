$(function () {
    $(".select2").select2({
        placeholder: "Choose one",
        searchInputPlaceholder: "Search",
        minimumResultsForSearch: 1 / 0,
        width: "100%"
    }), $(".select2-with-search").select2({placeholder: "Choose one", searchInputPlaceholder: "Search", width: "100%"});

    function t(e) {
        if (!e.id) return e.text;
        var s = $('<span><img src="https://laravelui.spruko.com/spruha/build/assets/plugins/flag-icon-css/flags/4x3/' + e.element.value.toLowerCase() + '.svg" class="img-flag" /> ' + e.text + "</span>");
        return s
    }

    $(".select2-flag-search").select2({
        templateResult: t, templateSelection: t, escapeMarkup: function (e) {
            return e
        }
    })
});
