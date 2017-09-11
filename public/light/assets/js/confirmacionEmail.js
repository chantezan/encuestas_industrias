(function(g, f) {
    function y(a, b, c) {
        function e(a) {
            var b = a || g.event;
            a = b.target || b.srcElement;
            b = b.relatedTarget;
            if (q(l, "visible")) {
                var c = -1;
                if (null !== b) {
                    for (var d = 0; d < n.length; d++)
                        if (b === n[d]) {
                            c = d;
                            break
                        } - 1 === c && a.focus()
                } else r = a
            }
        }
        if (void 0 === a) return g.console.error("sweetAlert expects at least 1 attribute!"), !1;
        var d = z({}, k);
        switch (typeof a) {
            case "string":
                d.title = a;
                d.text = b || "";
                d.type = c || "";
                break;
            case "object":
                if (void 0 === a.title) return g.console.error('Missing "title" argument!'), !1;
                d.title = a.title;
                d.text = a.text || k.text;
                d.type = a.type || k.type;
                d.customClass = a.customClass || d.customClass;
                d.allowOutsideClick = a.allowOutsideClick || k.allowOutsideClick;
                d.showCancelButton = void 0 !== a.showCancelButton ? a.showCancelButton : k.showCancelButton;
                d.closeOnConfirm = void 0 !== a.closeOnConfirm ? a.closeOnConfirm : k.closeOnConfirm;
                d.closeOnCancel = void 0 !== a.closeOnCancel ? a.closeOnCancel : k.closeOnCancel;
                d.timer = a.timer || k.timer;
                d.confirmButtonText = k.showCancelButton ? "Confirm" : k.confirmButtonText;
                d.confirmButtonText = a.confirmButtonText ||
                    k.confirmButtonText;
                d.confirmButtonColor = a.confirmButtonColor || k.confirmButtonColor;
                d.cancelButtonText = a.cancelButtonText || k.cancelButtonText;
                d.imageUrl = a.imageUrl || k.imageUrl;
                d.imageSize = a.imageSize || k.imageSize;
                d.doneFunction = b || null;
                break;
            default:
                return g.console.error('Unexpected type of argument! Expected "string" or "object", got ' + typeof a), !1
        }
        G(d);
        H();
        I();
        var l = p();
        a = function(a) {
            var b = a || g.event,
                c = b.target || b.srcElement;
            a = "confirm" === c.className;
            var e = q(l, "visible"),
                f = d.doneFunction && "true" ===
                    l.getAttribute("data-has-done-function");
            switch (b.type) {
                case "mouseover":
                    a && (c.style.backgroundColor = v(d.confirmButtonColor, -.04));
                    break;
                case "mouseout":
                    a && (c.style.backgroundColor = d.confirmButtonColor);
                    break;
                case "mousedown":
                    a && (c.style.backgroundColor = v(d.confirmButtonColor, -.14));
                    break;
                case "mouseup":
                    a && (c.style.backgroundColor = v(d.confirmButtonColor, -.04));
                    break;
                case "focus":
                    b = l.querySelector("button.confirm");
                    c = l.querySelector("button.cancel");
                    a ? c.style.boxShadow = "none" : b.style.boxShadow = "none";
                    break;
                case "click":
                    a && f && e ? (d.doneFunction(!0), d.closeOnConfirm && t()) : f && e ? (a = String(d.doneFunction).replace(/\s/g, ""), "function(" === a.substring(0, 9) && ")" !== a.substring(9, 10) && d.doneFunction(!1), d.closeOnCancel && t()) : t()
            }
        };
        b = l.querySelectorAll("button");
        for (c = 0; c < b.length; c++) b[c].onclick = a, b[c].onmouseover = a, b[c].onmouseout = a, b[c].onmousedown = a, b[c].onfocus = a;
        A = f.onclick;
        f.onclick = function(a) {
            a = a || g.event;
            var b = a.target || a.srcElement;
            a = l === b;
            a: {
                for (b = b.parentNode; null !== b;) {
                    if (b === l) {
                        b = !0;
                        break a
                    }
                    b =
                        b.parentNode
                }
                b = !1
            }
            var c = q(l, "visible"),
                d = "true" === l.getAttribute("data-allow-ouside-click");
            !a && !b && c && d && t()
        };
        var m = l.querySelector("button.confirm"),
            h = l.querySelector("button.cancel"),
            n = l.querySelectorAll("button:not([type=hidden])");
        B = g.onkeydown;
        g.onkeydown = function(a) {
            a = a || g.event;
            var b = a.keyCode || a.which;
            if (-1 !== [9, 13, 27].indexOf(b)) {
                for (var c = a.target || a.srcElement, e = -1, l = 0; l < n.length; l++)
                    if (c === n[l]) {
                        e = l;
                        break
                    }
                if (9 === b) c = -1 === e ? m : e === n.length - 1 ? n[0] : n[e + 1], "function" === typeof a.stopPropagation ?
                    (a.stopPropagation(), a.preventDefault()) : g.event && g.event.hasOwnProperty("cancelBubble") && (g.event.cancelBubble = !0), c.focus(), C(c, d.confirmButtonColor);
                else if (c = 13 === b || 32 === b ? -1 === e ? m : void 0 : 27 !== b || h.hidden || "none" === h.style.display ? void 0 : h, void 0 !== c)
                    if (a = c, MouseEvent) b = new MouseEvent("click", {
                        view: g,
                        bubbles: !1,
                        cancelable: !0
                    }), a.dispatchEvent(b);
                    else if (f.createEvent) b = f.createEvent("MouseEvents"), b.initEvent("click", !1, !1), a.dispatchEvent(b);
                    else if (f.createEventObject) a.fireEvent("onclick");
                    else if ("function" === typeof a.onclick) a.onclick()
            }
        };
        m.onblur = e;
        h.onblur = e;
        g.onfocus = function() {
            g.setTimeout(function() {
                void 0 !== r && (r.focus(), r = void 0)
            }, 0)
        }
    }

    function G(a) {
        var b = p(),
            c = b.querySelector("h2"),
            e = b.querySelector("p"),
            d = b.querySelector("button.cancel"),
            f = b.querySelector("button.confirm");
        c.innerHTML = (a.title).split("\n").join("");
        e.innerHTML = (a.text || "").split("\n").join("");
        a.text && u(e);
        a.customClass && m(b, a.customClass);
        D(b.querySelectorAll(".icon"));
        if (a.type) {
            c = !1;
            for (e = 0; e <
                E.length; e++)
                if (a.type === E[e]) {
                    c = !0;
                    break
                }
            if (!c) return g.console.error("Unknown alert type: " + a.type), !1;
            c = b.querySelector(".icon." + a.type);
            u(c);
            switch (a.type) {
                case "success":
                    m(c, "animate");
                    m(c.querySelector(".tip"), "animateSuccessTip");
                    m(c.querySelector(".long"), "animateSuccessLong");
                    break;
                case "error":
                    m(c, "animateErrorIcon");
                    m(c.querySelector(".x-mark"), "animateXMark");
                    break;
                case "warning":
                    m(c, "pulseWarning"), m(c.querySelector(".body"), "pulseWarningIns"), m(c.querySelector(".dot"), "pulseWarningIns")
            }
        }
        if (a.imageUrl) {
            c =
                b.querySelector(".icon.custom");
            c.style.backgroundImage = "url(" + a.imageUrl + ")";
            u(c);
            var k = e = 80;
            if (a.imageSize) {
                var h = a.imageSize.split("x")[0],
                    n = a.imageSize.split("x")[1];
                h && n ? (e = h, k = n, c.css({
                    width: h + "px",
                    height: n + "px"
                })) : g.console.error("Parameter imageSize expects value with format WIDTHxHEIGHT, got " + a.imageSize)
            }
            c.setAttribute("style", c.getAttribute("style") + "width:" + e + "px; height:" + k + "px")
        }
        b.setAttribute("data-has-cancel-button", a.showCancelButton);
        a.showCancelButton ? d.style.display = "inline-block" :
            D(d);
        a.cancelButtonText && (d.innerHTML = w(a.cancelButtonText));
        a.confirmButtonText && (f.innerHTML = w(a.confirmButtonText));
        f.style.backgroundColor = a.confirmButtonColor;
        C(f, a.confirmButtonColor);
        b.setAttribute("data-allow-ouside-click", a.allowOutsideClick);
        b.setAttribute("data-has-done-function", a.doneFunction ? !0 : !1);
        b.setAttribute("data-timer", a.timer)
    }

    function v(a, b) {
        a = String(a).replace(/[^0-9a-f]/gi, "");
        6 > a.length && (a = a[0] + a[0] + a[1] + a[1] + a[2] + a[2]);
        b = b || 0;
        var c = "#",
            e, d;
        for (d = 0; 3 > d; d++) e = parseInt(a.substr(2 *
            d, 2), 16), e = Math.round(Math.min(Math.max(0, e + e * b), 255)).toString(16), c += ("00" + e).substr(e.length);
        return c
    }

    function z(a, b) {
        for (var c in b) b.hasOwnProperty(c) && (a[c] = b[c]);
        return a
    }

    function C(a, b) {
        var c;
        c = (c = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(b)) ? parseInt(c[1], 16) + ", " + parseInt(c[2], 16) + ", " + parseInt(c[3], 16) : null;
        a.style.boxShadow = "0 0 2px rgba(" + c + ", 0.8), inset 0 0 0 1px rgba(0, 0, 0, 0.05)"
    }

    function I() {
        var a = p();
        J(f.querySelector(".sweet-overlay"), 10);
        u(a);
        m(a, "showSweetAlert");
        h(a,
            "hideSweetAlert");
        x = f.activeElement;
        a.querySelector("button.confirm").focus();
        setTimeout(function() {
            m(a, "visible")
        }, 500);
        var b = a.getAttribute("data-timer");
        "null" !== b && "" !== b && (a.timeout = setTimeout(function() {
            t()
        }, b))
    }

    function t() {
        var a = p();
        F(f.querySelector(".sweet-overlay"), 5);
        F(a, 5);
        h(a, "showSweetAlert");
        m(a, "hideSweetAlert");
        h(a, "visible");
        var b = a.querySelector(".icon.success");
        h(b, "animate");
        h(b.querySelector(".tip"), "animateSuccessTip");
        h(b.querySelector(".long"), "animateSuccessLong");
        b = a.querySelector(".icon.error");
        h(b, "animateErrorIcon");
        h(b.querySelector(".x-mark"), "animateXMark");
        b = a.querySelector(".icon.warning");
        h(b, "pulseWarning");
        h(b.querySelector(".body"), "pulseWarningIns");
        h(b.querySelector(".dot"), "pulseWarningIns");
        g.onkeydown = B;
        f.onclick = A;
        x && x.focus();
        r = void 0;
        clearTimeout(a.timeout)
    }

    function H() {
        var a = p().style,
            b;
        b = p();
        b.style.left = "-9999px";
        b.style.display = "block";
        var c = b.clientHeight,
            e;
        e = "undefined" !== typeof getComputedStyle ? parseInt(getComputedStyle(b).getPropertyValue("padding"), 10) : parseInt(b.currentStyle.padding);
        b.style.left = "";
        b.style.display = "none";
        b = "-" + parseInt(c / 2 + e) + "px";
        a.marginTop = b
    }
    var E = ["error", "warning", "info", "success"],
        k = {
            title: "",
            text: "",
            type: null,
            allowOutsideClick: !1,
            showCancelButton: !1,
            closeOnConfirm: !0,
            closeOnCancel: !0,
            confirmButtonText: "OK",
            confirmButtonColor: "#AEDEF4",
            cancelButtonText: "Cancel",
            imageUrl: null,
            imageSize: null,
            timer: null
        },
        p = function() {
            return f.querySelector(".sweet-alert")
        },
        q = function(a, b) {
            return (new RegExp(" " + b + " ")).test(" " + a.className + " ")
        },
        m = function(a, b) {
            q(a, b) || (a.className +=
                " " + b)
        },
        h = function(a, b) {
            var c = " " + a.className.replace(/[\t\r\n]/g, " ") + " ";
            if (q(a, b)) {
                for (; 0 <= c.indexOf(" " + b + " ");) c = c.replace(" " + b + " ", " ");
                a.className = c.replace(/^\s+|\s+$/g, "")
            }
        },
        w = function(a) {
            var b = f.createElement("div");
            b.appendChild(f.createTextNode(a));
            return b.innerHTML
        },
        u = function(a) {
            if (a && !a.length) a.style.opacity = "", a.style.display = "block";
            else
                for (var b = 0; b < a.length; ++b) {
                    var c = a[b];
                    c.style.opacity = "";
                    c.style.display = "block"
                }
        },
        D = function(a) {
            if (a && !a.length) a.style.opacity = "", a.style.display =
                "none";
            else
                for (var b = 0; b < a.length; ++b) {
                    var c = a[b];
                    c.style.opacity = "";
                    c.style.display = "none"
                }
        },
        J = function(a, b) {
            if (1 > +a.style.opacity) {
                b = b || 16;
                a.style.opacity = 0;
                a.style.display = "block";
                var c = +new Date,
                    e = function() {
                        a.style.opacity = +a.style.opacity + (new Date - c) / 100;
                        c = +new Date;
                        1 > +a.style.opacity && setTimeout(e, b)
                    };
                e()
            }
            a.style.display = "block"
        },
        F = function(a, b) {
            b = b || 16;
            a.style.opacity = 1;
            var c = +new Date,
                e = function() {
                    a.style.opacity = +a.style.opacity - (new Date - c) / 100;
                    c = +new Date;
                    0 < +a.style.opacity ? setTimeout(e,
                        b) : a.style.display = "none"
                };
            e()
        },
        x, A, B, r;
    g.sweetAlertInitialize = function() {
        var a = f.createElement("div");
        a.innerHTML = '<div class="sweet-overlay"></div><div class="sweet-alert"><div class="icon error"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning"> <span class="body"></span> <span class="dot"></span> </div> <div class="icon info"></div> <div class="icon success"> <span class="line tip"></span> <span class="line long"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <div class="icon custom"></div> <h2>Title</h2><p>Text</p><button class="cancel">Cancel</button><button class="confirm">OK</button></div>';
        f.body.appendChild(a)
    };
    g.sweetAlert = g.swal = function() {
        var a = arguments;
        if (null !== p()) y.apply(this, a);
        else var b = setInterval(function() {
            null !== p() && (clearInterval(b), y.apply(this, a))
        }, 100)
    };
    g.swal.setDefaults = function(a) {
        if (!a) throw Error("userParams is required");
        if ("object" !== typeof a) throw Error("userParams has to be a object");
        z(k, a)
    };
    (function() {
        "complete" === f.readyState || "interactive" === f.readyState && f.body ? g.sweetAlertInitialize() : f.addEventListener ? f.addEventListener("DOMContentLoaded", function() {
            f.removeEventListener("DOMContentLoaded",
                arguments.callee, !1);
            g.sweetAlertInitialize()
        }, !1) : f.attachEvent && f.attachEvent("onreadystatechange", function() {
            "complete" === f.readyState && (f.detachEvent("onreadystatechange", arguments.callee), g.sweetAlertInitialize())
        })
    })()
})(window, document);