k = "切换为暗色模式",
l = "切换为亮色模式";
function cookie_set(a, b) {
    (t = new Date).setTime(t.getTime() + 6048e5)
    document.cookie = a + "=" + b + "; expires=" + t.toGMTString() + "; path=/;"
}
function cookie_get(b) {
    for (var c, f = b + "=", g = document.cookie.split(";"), h = 0; h < g.length; h++)
        if (c = g[h].trim(), 0 == c.indexOf(f)) {
            return c.substring(f.length, c.length);
        }
    return !1
}
function light() {
    cookie_set("DARK_STATUS", "0");
    $("#dark_toggle_icon").html("brightness_4");
    $("#dark_toggle_btn").attr("mdui-tooltip", '{content: "切换为暗色模式"}');
    $(".mdui-tooltip").each(function() {
        l == (v = $(this)).text() && v.text(k)
    });
    $("#color_chrome").attr("content", "#" + cookie_get("THEME_COLOR"));
    $("#color_safari").attr("content", "#" + cookie_get("THEME_COLOR"));
    $("body").removeClass("mdui-theme-layout-dark");
    $("footer").addClass("mdui-color-theme");
    $(".load-indicator").removeClass("load-indicator-dark");
}
function dark() {
    cookie_set("DARK_STATUS", "1");
    $("#dark_toggle_icon").html("brightness_high");
    $("#dark_toggle_btn").attr("mdui-tooltip", '{content: "切换为亮色模式"}');
    $(".mdui-tooltip").each(function() {
        k == (v = $(this)).text() && v.text(l);
    });
    $("#color_chrome").attr("content", "#212121");
    $("#color_safari").attr("content", "#212121");
    $("body").addClass("mdui-theme-layout-dark");
    $("footer").removeClass("mdui-color-theme");
    $(".load-indicator").addClass("load-indicator-dark");
}
function cookie_expire(b) {
    b ? 7 > (e = new Date).getHours() ? cookie_set("DARK_EXPIRE", new Date(e.getFullYear(),e.getMonth(),e.getDate(),7).getTime()) : cookie_set("DARK_EXPIRE", new Date(e.getFullYear(),e.getMonth(),e.getDate() + 1,7).getTime()) : 6 < (e = new Date).getHours() && 20 > e.getHours() ? cookie_set("DARK_EXPIRE", new Date(e.getFullYear(),e.getMonth(),e.getDate(),20).getTime()) : cookie_set("DARK_EXPIRE", (20 <= e.getHours() ? new Date(e.getFullYear(),e.getMonth(),e.getDate() + 1,7) : new Date(e.getFullYear(),e.getMonth(),e.getDate(),7)).getTime())
}

function darkmode_toggle() {
    if ("1" == cookie_get("DARK_STATUS")) {
        light();
        cookie_expire(0);
    } else {
        dark();
        cookie_expire(1)
    }
}

function darkInit() {
    if ((e = new Date).getTime() > cookie_get("DARK_EXPIRE")) {
        cookie_set("DARK_EXPIRE", "0");
        1 == cookie_get("AUTO_DARK") ? 6 < (e = new Date).getHours() && 20 > e.getHours() ? (light(),
        cookie_expire(0)) : (dark(),
        cookie_expire(1)) : (light(),
        cookie_expire(0))
    } else {
        1 == cookie_get("DARK_STATUS") ? dark() : light()
    }
}

window.matchMedia("(prefers-color-scheme: dark)").addListener(function(a) {
    if (1 == cookie_get("AUTO_DARK")) {
        if (a.matches) {
            dark();
        } else {
            light();
        }
        cookie_set("DARK_EXPIRE", "0");
    }
});

$(function() {
    darkInit();
    if (1 == cookie_get("AUTO_DARK") && window.matchMedia("prefers-color-scheme: dark").matches) {
        dark();
        cookie_set("DARK_EXPIRE", "0");
    }
});
