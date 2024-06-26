"use strict";

function unwrapExports(e) {
    return e && e.__esModule && Object.prototype.hasOwnProperty.call(e, "default") ? e.default : e;
}

function createCommonjsModule(e, t) {
    return e(t = {
        exports: {}
    }, t.exports), t.exports;
}

var _defined = function(e) {
    if (null == e) throw TypeError("Can't call method on  " + e);
    return e;
}, _toObject = function(e) {
    return Object(_defined(e));
}, hasOwnProperty = {}.hasOwnProperty, _has = function(e, t) {
    return hasOwnProperty.call(e, t);
}, toString = {}.toString, _cof = function(e) {
    return toString.call(e).slice(8, -1);
}, _iobject = Object("z").propertyIsEnumerable(0) ? Object : function(e) {
    return "String" == _cof(e) ? e.split("") : Object(e);
}, _toIobject = function(e) {
    return _iobject(_defined(e));
}, ceil = Math.ceil, floor = Math.floor, _toInteger = function(e) {
    return isNaN(e = +e) ? 0 : (0 < e ? floor : ceil)(e);
}, min = Math.min, _toLength = function(e) {
    return 0 < e ? min(_toInteger(e), 9007199254740991) : 0;
}, max = Math.max, min$1 = Math.min, _toAbsoluteIndex = function(e, t) {
    return (e = _toInteger(e)) < 0 ? max(e + t, 0) : min$1(e, t);
}, _arrayIncludes = function(c) {
    return function(e, t, n) {
        var r, o = _toIobject(e), i = _toLength(o.length), a = _toAbsoluteIndex(n, i);
        if (c && t != t) {
            for (;a < i; ) if ((r = o[a++]) != r) return !0;
        } else for (;a < i; a++) if ((c || a in o) && o[a] === t) return c || a || 0;
        return !c && -1;
    };
}, _core = createCommonjsModule(function(e) {
    var t = e.exports = {
        version: "2.5.7"
    };
    "number" == typeof __e && (__e = t);
}), _core_1 = _core.version, _global = createCommonjsModule(function(e) {
    var t = e.exports = "undefined" != typeof window && window.Math == Math ? window : "undefined" != typeof self && self.Math == Math ? self : Function("return this")();
    "number" == typeof __g && (__g = t);
}), _library = !0, _shared = createCommonjsModule(function(e) {
    var t = "__core-js_shared__", n = _global[t] || (_global[t] = {});
    (e.exports = function(e, t) {
        return n[e] || (n[e] = void 0 !== t ? t : {});
    })("versions", []).push({
        version: _core.version,
        mode: _library ? "pure" : "global",
        copyright: "© 2018 Denis Pushkarev (zloirock.ru)"
    });
}), id = 0, px = Math.random(), _uid = function(e) {
    return "Symbol(".concat(void 0 === e ? "" : e, ")_", (++id + px).toString(36));
}, shared = _shared("keys"), _sharedKey = function(e) {
    return shared[e] || (shared[e] = _uid(e));
}, arrayIndexOf = _arrayIncludes(!1), IE_PROTO = _sharedKey("IE_PROTO"), _objectKeysInternal = function(e, t) {
    var n, r = _toIobject(e), o = 0, i = [];
    for (n in r) n != IE_PROTO && _has(r, n) && i.push(n);
    for (;t.length > o; ) _has(r, n = t[o++]) && (~arrayIndexOf(i, n) || i.push(n));
    return i;
}, _enumBugKeys = "constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(","), _objectKeys = Object.keys || function(e) {
    return _objectKeysInternal(e, _enumBugKeys);
}, _aFunction = function(e) {
    if ("function" != typeof e) throw TypeError(e + " is not a function!");
    return e;
}, _ctx = function(r, o, e) {
    if (_aFunction(r), void 0 === o) return r;
    switch (e) {
      case 1:
        return function(e) {
            return r.call(o, e);
        };

      case 2:
        return function(e, t) {
            return r.call(o, e, t);
        };

      case 3:
        return function(e, t, n) {
            return r.call(o, e, t, n);
        };
    }
    return function() {
        return r.apply(o, arguments);
    };
}, _isObject = function(e) {
    return "object" == typeof e ? null !== e : "function" == typeof e;
}, _anObject = function(e) {
    if (!_isObject(e)) throw TypeError(e + " is not an object!");
    return e;
}, _fails = function(e) {
    try {
        return !!e();
    } catch (e) {
        return !0;
    }
}, _descriptors = !_fails(function() {
    return 7 != Object.defineProperty({}, "a", {
        get: function() {
            return 7;
        }
    }).a;
}), document$1 = _global.document, is = _isObject(document$1) && _isObject(document$1.createElement), _domCreate = function(e) {
    return is ? document$1.createElement(e) : {};
}, _ie8DomDefine = !_descriptors && !_fails(function() {
    return 7 != Object.defineProperty(_domCreate("div"), "a", {
        get: function() {
            return 7;
        }
    }).a;
}), _toPrimitive = function(e, t) {
    if (!_isObject(e)) return e;
    var n, r;
    if (t && "function" == typeof (n = e.toString) && !_isObject(r = n.call(e))) return r;
    if ("function" == typeof (n = e.valueOf) && !_isObject(r = n.call(e))) return r;
    if (!t && "function" == typeof (n = e.toString) && !_isObject(r = n.call(e))) return r;
    throw TypeError("Can't convert object to primitive value");
}, dP = Object.defineProperty, f = _descriptors ? Object.defineProperty : function(e, t, n) {
    if (_anObject(e), t = _toPrimitive(t, !0), _anObject(n), _ie8DomDefine) try {
        return dP(e, t, n);
    } catch (e) {}
    if ("get" in n || "set" in n) throw TypeError("Accessors not supported!");
    return "value" in n && (e[t] = n.value), e;
}, _objectDp = {
    f: f
}, _propertyDesc = function(e, t) {
    return {
        enumerable: !(1 & e),
        configurable: !(2 & e),
        writable: !(4 & e),
        value: t
    };
}, _hide = _descriptors ? function(e, t, n) {
    return _objectDp.f(e, t, _propertyDesc(1, n));
} : function(e, t, n) {
    return e[t] = n, e;
}, PROTOTYPE = "prototype", $export = function(e, t, n) {
    var r, o, i, a = e & $export.F, c = e & $export.G, u = e & $export.S, s = e & $export.P, l = e & $export.B, f = e & $export.W, p = c ? _core : _core[t] || (_core[t] = {}), d = p[PROTOTYPE], _ = c ? _global : u ? _global[t] : (_global[t] || {})[PROTOTYPE];
    for (r in c && (n = t), n) (o = !a && _ && void 0 !== _[r]) && _has(p, r) || (i = o ? _[r] : n[r], 
    p[r] = c && "function" != typeof _[r] ? n[r] : l && o ? _ctx(i, _global) : f && _[r] == i ? function(r) {
        var e = function(e, t, n) {
            if (this instanceof r) {
                switch (arguments.length) {
                  case 0:
                    return new r();

                  case 1:
                    return new r(e);

                  case 2:
                    return new r(e, t);
                }
                return new r(e, t, n);
            }
            return r.apply(this, arguments);
        };
        return e[PROTOTYPE] = r[PROTOTYPE], e;
    }(i) : s && "function" == typeof i ? _ctx(Function.call, i) : i, s && ((p.virtual || (p.virtual = {}))[r] = i, 
    e & $export.R && d && !d[r] && _hide(d, r, i)));
};

$export.F = 1, $export.G = 2, $export.S = 4, $export.P = 8, $export.B = 16, $export.W = 32, 
$export.U = 64, $export.R = 128;

var _export = $export, _objectSap = function(e, t) {
    var n = (_core.Object || {})[e] || Object[e], r = {};
    r[e] = t(n), _export(_export.S + _export.F * _fails(function() {
        n(1);
    }), "Object", r);
};

_objectSap("keys", function() {
    return function(e) {
        return _objectKeys(_toObject(e));
    };
});

var keys = _core.Object.keys, keys$1 = createCommonjsModule(function(e) {
    e.exports = {
        "default": keys,
        __esModule: !0
    };
}), _Object$keys = unwrapExports(keys$1), classCallCheck = createCommonjsModule(function(e, t) {
    t.__esModule = !0, t.default = function(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
    };
}), _classCallCheck = unwrapExports(classCallCheck);

_export(_export.S + _export.F * !_descriptors, "Object", {
    defineProperty: _objectDp.f
});

var $Object = _core.Object, defineProperty = function(e, t, n) {
    return $Object.defineProperty(e, t, n);
}, defineProperty$1 = createCommonjsModule(function(e) {
    e.exports = {
        "default": defineProperty,
        __esModule: !0
    };
});

unwrapExports(defineProperty$1);

var createClass = createCommonjsModule(function(e, t) {
    t.__esModule = !0;
    var n, o = (n = defineProperty$1) && n.__esModule ? n : {
        "default": n
    };
    t.default = function() {
        function r(e, t) {
            for (var n = 0; n < t.length; n++) {
                var r = t[n];
                r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), 
                (0, o.default)(e, r.key, r);
            }
        }
        return function(e, t, n) {
            return t && r(e.prototype, t), n && r(e, n), e;
        };
    }();
}), _createClass = unwrapExports(createClass);

function getIOSVersion() {
    var e = navigator.appVersion.match(/OS (\d+)_(\d+)_?(\d+)?/);
    return parseInt(e[1], 10);
}

function getBrowser() {
    var e = window.navigator.userAgent || "", t = /android/i.test(e), n = /iphone|ipad|ipod/i.test(e);
    return {
        isAndroid: t,
        isIos: n,
        isWechat: /micromessenger\/([\d.]+)/i.test(e),
        isWeibo: /(weibo).*weibo__([\d.]+)/i.test(e),
        isQQ: /qq\/([\d.]+)/i.test(e),
        isQzone: /qzone\/.*_qz_([\d.]+)/i.test(e),
        isOriginalChrome: /chrome\/[\d.]+ Mobile Safari\/[\d.]+/i.test(e) && t && e.indexOf("Version") < 0,
        isSafari: /safari\/([\d.]+)$/i.test(e) && n && e.indexOf("Crios") < 0 && 0 === e.indexOf("Mozilla")
    };
}

var iframe = null;

function createEvent() {
    var e = void 0;
    return window.CustomEvent ? e = new window.CustomEvent("click", {
        canBubble: !0,
        cancelable: !0
    }) : (e = document.createEvent("HTMLEvents")).initEvent("click", !1, !1), e;
}

function evokeByTagA(e) {
    var t = document.createElement("a"), n = createEvent();
    t.setAttribute("href", e), t.style.display = "none", document.body.appendChild(t), 
    t.dispatchEvent(n);
}

function evokeByLocation(e) {
    window.top.location.href = e;
}

function evokeByIFrame(e) {
    iframe || ((iframe = document.createElement("iframe")).frameborder = "0", iframe.style.cssText = "display:none;border:0;width:0;height:0;", 
    document.body.appendChild(iframe)), iframe.src = e;
}

function checkOpen(e) {
    setTimeout(function() {
        document.hidden || document.webkitHidden || e();
    }, 2500);
}

var CallApp = function() {
    function s(e) {
        _classCallCheck(this, s), this.options = e || {};
    }
    return _createClass(s, [ {
        key: "buildScheme",
        value: function(e) {
            var t = e.path, n = e.param, r = void 0 !== n ? _Object$keys(n).map(function(e) {
                return e + "=" + n[e];
            }).join("&") : "";
            return this.options.protocol + "://" + t + "?" + r;
        }
    }, {
        key: "generateScheme",
        value: function(e) {
            var t = this.options.outChain, n = this.buildScheme(e);
            void 0 !== t && t && (n = t.protocal + "://" + t.path + "?" + t.key + "=" + encodeURIComponent(n));
            return n;
        }
    }, {
        key: "generateIntent",
        value: function(e) {
            var t = e.outChain, n = this.options, r = n.intent, o = n.fallback, i = _Object$keys(r).map(function(e) {
                return e + "=" + r[e] + ";";
            }).join(""), a = this.buildScheme(e);
            if (void 0 !== t && !t) {
                var c = e.outChain;
                return "intent://" + c.path + "?" + c.key + "=" + encodeURIComponent(a) + "/\n        #Intent;" + i + ";S.browser_fallback_url=" + o + ";end;";
            }
            return "intent://" + (a = a.slice(a.indexOf("//") + 2)) + "/#Intent;" + i + ";end;";
        }
    }, {
        key: "generateUniversalLink",
        value: function(e) {
            var t = this.options.universal, n = t.host, r = t.pathKey, o = e.path, i = e.param, a = void 0 !== i ? _Object$keys(i).map(function(e) {
                return e + "=" + i[e];
            }).join("&") : "";
            return "//" + n + "?" + r + "=" + o + (a ? "&" : "") + a;
        }
    }, {
        key: "generateYingYongBao",
        value: function(e) {
            var t = this.generateScheme(e);
            return this.options.yingyongbao + "&android_schema=" + encodeURIComponent(t);
        }
    }, {
        key: "fallToAppStore",
        value: function() {
            var e = this;
            checkOpen(function() {
                evokeByLocation(e.options.appstore);
            });
        }
    }, {
        key: "fallToFbUrl",
        value: function() {
            var e = this;
            checkOpen(function() {
                evokeByLocation(e.options.fallback);
            });
        }
    }, {
        key: "open",
        value: function(e) {
            var t = getBrowser(), n = this.options, r = n.universal, o = n.appstore, i = n.logFunc, a = e.callback, c = void 0 !== r, u = null;
            void 0 !== i && i(), t.isIos ? t.isWechat ? evokeByLocation(o) : getIOSVersion() < 9 ? (evokeByIFrame(this.generateScheme(e)), 
            u = this.fallToAppStore) : evokeByLocation(c ? this.generateUniversalLink(e) : this.generateScheme(e)) : t.isWechat ? evokeByLocation(this.generateYingYongBao(e)) : t.isOriginalChrome ? evokeByTagA(this.generateIntent(e)) : (evokeByIFrame(this.generateScheme(e)), 
            u = this.fallToFbUrl), void 0 === a ? u && u.call(this) : s.fallToCustomCb(a);
        }
    } ], [ {
        key: "fallToCustomCb",
        value: function(e) {
            checkOpen(function() {
                e();
            });
        }
    } ]), s;
}();

module.exports = CallApp;