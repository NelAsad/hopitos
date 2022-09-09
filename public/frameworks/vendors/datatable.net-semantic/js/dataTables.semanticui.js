/*!
 DataTables Bootstrap 3 integration
 ©2011-2015 SpryMedia Ltd - datatables.net/license
*/
(function (b) {
    "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function (a) {
        return b(a, window, document)
    }) : "object" === typeof exports ? module.exports = function (a, e) {
        a || (a = window);
        if (!e || !e.fn.dataTable) e = require("datatables.net")(a, e).$;
        return b(e, a, a.document)
    } : b(jQuery, window, document)
})(function (b, a, e, m) {
    var c = b.fn.dataTable;
    b.extend(!0, c.defaults, {
        dom: "<'ui stackable grid'<'row'<'eight wide column'l><'right aligned eight wide column'f>><'row dt-table'<'sixteen wide column'tr>><'row'<'seven wide column'i><'right aligned nine wide column'p>>>",
        renderer: "semanticUI"
    });
    b.extend(c.ext.classes, {
        sWrapper: "dataTables_wrapper dt-semanticUI",
        sFilter: "dataTables_filter ui input",
        sProcessing: "dataTables_processing ui segment",
        sPageButton: "paginate_button item"
    });
    c.ext.renderer.pageButton.semanticUI = function (h, a, r, s, j, n) {
        var o = new c.Api(h),
            t = h.oClasses,
            k = h.oLanguage.oPaginate,
            u = h.oLanguage.oAria.paginate || {},
            f, g, p = 0,
            q = function (a, e) {
                var c, i, l, d, m = function (a) {
                    a.preventDefault();
                    !b(a.currentTarget).hasClass("disabled") && o.page() != a.data.action && o.page(a.data.action).draw("page")
                };
                c = 0;
                for (i = e.length; c < i; c++)
                    if (d = e[c], b.isArray(d)) q(a, d);
                    else {
                        g = f = "";
                        switch (d) {
                            case "ellipsis":
                                f = "&#x2026;";
                                g = "disabled";
                                break;
                            case "first":
                                f = k.sFirst;
                                g = d + (0 < j ? "" : " disabled");
                                break;
                            case "previous":
                                f = k.sPrevious;
                                g = d + (0 < j ? "" : " disabled");
                                break;
                            case "next":
                                f = k.sNext;
                                g = d + (j < n - 1 ? "" : " disabled");
                                break;
                            case "last":
                                f = k.sLast;
                                g = d + (j < n - 1 ? "" : " disabled");
                                break;
                            default:
                                f = d + 1, g = j === d ? "active" : ""
                        }
                        l = -1 === g.indexOf("disabled") ? "a" : "div";
                        f && (l = b("<" + l + ">", {
                            "class": t.sPageButton + " " + g,
                            id: 0 === r && "string" === typeof d ?
                                h.sTableId + "_" + d : null,
                            href: "#",
                            "aria-controls": h.sTableId,
                            "aria-label": u[d],
                            "data-dt-idx": p,
                            tabindex: h.iTabIndex
                        }).html(f).appendTo(a), h.oApi._fnBindAction(l, {
                            action: d
                        }, m), p++)
                    }
            },
            i;
        try {
            i = b(a).find(e.activeElement).data("dt-idx")
        } catch (v) {}
        q(b(a).empty().html('<div class="ui stackable pagination menu"/>').children(), s);
        i !== m && b(a).find("[data-dt-idx=" + i + "]").focus()
    };
    b(e).on("init.dt", function (a, e) {
        if ("dt" === a.namespace) {
            var c = new b.fn.dataTable.Api(e);
            b.fn.dropdown && b("div.dataTables_length select",
                c.table().container()).dropdown();
            b("div.dataTables_filter.ui.input", c.table().container()).removeClass("input").addClass("form");
            b("div.dataTables_filter input", c.table().container()).wrap('<span class="ui input" />')
        }
    });
    return c
});