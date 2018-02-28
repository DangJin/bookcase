define(["jquery", "template"], function ($, template) {

    var display = function (container, data, callback) {
        if ($("#" + container).length !== 0) {
            var h = template(container, {data: data});
            if ($("." + container).length !== 0) {
                $("." + container).html(h);
                if (typeof callback === "function") {
                    callback.call(this);
                }
            } else {
                throw new Error("容器不存在");
            }
        } else {
            throw new Error("模板不存在");
        }
    };

    var getUrlParams = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null)
            return unescape(r[2]);
        return null;
    };

    return {
        display: display,
        getUrlParams: getUrlParams
    };
});