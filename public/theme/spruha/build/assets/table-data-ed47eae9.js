$(function () {
    // Inisialisasi DataTable untuk tabel pertama
    var c1 = $("#exportexample1").DataTable({
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf", "colvis"]
    });
    c1.buttons().container().appendTo("#exportexample1_wrapper .col-md-6:eq(0)");

    // Inisialisasi DataTable untuk tabel kedua
    var c2 = $("#exportexample2").DataTable({
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf", "colvis"]
    });
    c2.buttons().container().appendTo("#exportexample2_wrapper .col-md-6:eq(0)");

    // Konfigurasi DataTable yang lainnya
    $("#example1").DataTable({
        language: {
            searchPlaceholder: "Search...",
            sSearch: "",
            lengthMenu: "_MENU_ items/page"
        }
    });

    $("#example2").DataTable({
        responsive: !0,
        language: {
            searchPlaceholder: "Search...",
            sSearch: "",
            lengthMenu: "_MENU_ items/page"
        }
    });

    $("#example3").DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (t) {
                        var e = t.data();
                        return "Details for " + e[0] + " " + e[1]
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: "table"
                })
            }
        }
    });

    var c = $("#example-input").DataTable({
        columnDefs: [{
            targets: [1, 2, 3, 4, 5],
            render: function (t, e, o, l) {
                if (e === "display") {
                    var n = new $.fn.dataTable.Api(l.settings),
                        a = $("input, select, textarea", n.cell({row: l.row, column: l.col}).node()),
                        r = $(t).wrap("<div/>").parent();
                    a.prop("tagName") === "INPUT" ? ($("input", r).attr("value", a.val()), a.prop("checked") && $("input", r).attr("checked", "checked")) :
                        a.prop("tagName") === "TEXTAREA" ? $("textarea", r).html(a.val()) :
                            a.prop("tagName") === "SELECT" && ($("option:selected", r).removeAttr("selected"), $("option", r).filter(function () {
                                return $(this).attr("value") === a.val();
                            }).attr("selected", "selected")),
                        t = r.html();
                }
                return t;
            }
        }],
        responsive: !0
    });

    $("#example-input tbody").on("keyup change", ".child input, .child select, .child textarea", function (t) {
        var e = $(this),
            o = e.closest("ul").data("dtr-index"),
            l = e.closest("li").data("dtr-index"),
            n = c.cell({row: o, column: l}).node();
        $("input, select, textarea", n).val(e.val()),
            e.is(":checked") ? $("input", n).prop("checked", !0) : $("input", n).removeProp("checked");
    });

    $(".select2").select2({
        placeholder: "Choose one",
        searchInputPlaceholder: "Search",
        minimumResultsForSearch: 1 / 0,
        width: "100%"
    });
});
