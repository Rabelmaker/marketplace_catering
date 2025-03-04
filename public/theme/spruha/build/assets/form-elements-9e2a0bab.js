$(function () {
    $(".main-toggle").on("click", function () {
        $(this).toggleClass("on")
    }), $("#dateMask").mask("99/99/9999"), $("#phoneMask").mask("(999) 999-9999"), $("#phoneExtMask").mask("(999) 999-9999? ext 99999"), $("#ssnMask").mask("999-99-9999"), $("#colorpicker").spectrum({color: "#17A2B8"}), $("#showAlpha").spectrum({
        color: "rgba(23,162,184,0.5)",
        showAlpha: !0
    }), $("#showPaletteOnly").spectrum({
        showPaletteOnly: !0,
        showPalette: !0,
        color: "#DC3545",
        palette: [["#1D2939", "#fff", "#0866C6", "#23BF08", "#F49917"], ["#DC3545", "#17A2B8", "#6610F2", "#fa1e81", "#72e7a6"]]
    }), $(".fc-datepicker").datepicker({
        showOtherMonths: !0,
        selectOtherMonths: !0
    }), $("#datepickerNoOfMonths").datepicker({
        showOtherMonths: !0,
        selectOtherMonths: !0,
        numberOfMonths: 2
    }), $(".rangeslider1").ionRangeSlider(), $(".rangeslider2").ionRangeSlider({
        min: 100,
        max: 1e3,
        from: 550
    }), $(".rangeslider3").ionRangeSlider({
        type: "double",
        grid: !0,
        min: 0,
        max: 1e3,
        from: 200,
        to: 800,
        prefix: "$"
    }), $(".rangeslider4").ionRangeSlider({
        type: "double",
        grid: !0,
        min: -1e3,
        max: 1e3,
        from: -500,
        to: 500,
        step: 250
    }), $(document).on("change", ":file", function () {
        var e = $(this), t = e.get(0).files ? e.get(0).files.length : 1,
            r = e.val().replace(/\\/g, "/").replace(/.*\//, "");
        e.trigger("fileselect", [t, r])
    }), $(document).ready(function () {
        $(":file").on("fileselect", function (e, t, r) {
            var o = $(this).parents(".input-group").find(":text"), a = t > 1 ? t + " files selected" : r;
            o.length ? o.val(a) : a && alert(a)
        })
    }), $("#datepicker-date").bootstrapdatepicker({
        format: "dd-mm-yyyy",
        viewMode: "date",
        multidate: !0,
        multidateSeparator: "-"
    }), $("#datepicker-month").bootstrapdatepicker({
        format: "MM",
        viewMode: "months",
        minViewMode: "months",
        multidate: !0,
        multidateSeparator: "-"
    }), $("#datepicker-year").bootstrapdatepicker({
        format: "yyyy",
        viewMode: "year",
        minViewMode: "years",
        multidate: !0,
        multidateSeparator: "-"
    }), $("#datetimepicker").datetimepicker({format: "yyyy-mm-dd hh:ii:ss", autoclose: !0})
});
