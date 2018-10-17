(function (window) {
    function auiTpl(el, data, callback) {
        if(!document.querySelector(el))return 'NO TPL T.T';
        var fn = compileTpl(el);
        var tplData = new Array();
        tplData.at = data;
        return data ? fn(tplData) : fn;
    }
    auiTpl.before = '<#';
    auiTpl.after = '#>';
    function compileTpl(el) {
        el = el || '';
        tplHtml = document.querySelector(el).innerHTML;
        var v = auiTpl.variable,
            arg1 = v || "$",
            str = "var "+ arg1 +"="+ arg1 +"||this,__='',___,\
            inTpl=function(t,d){__+=auiTpl(t).call(d||"+ arg1 +")};"+ (v?"":"with($||{}){"),
            _blen = auiTpl.before.length, _elen = auiTpl.after.length,
            _before = tplHtml.indexOf(auiTpl.before),_end,_skip,_tmp,
            trim = function(str) {
                return str.trim ? str.trim() : str.replace(/^\s*|\s*$/g, '');
            },
            ecp = function(str){
                return str.replace(/('|\\|\r?\n)/g, '\\$1');
            };

        while(_before != -1) {
            _end = _skip ? _before + _blen : tplHtml.indexOf(auiTpl.after);
            if(_end < _before) break;
            str += "__+='" + ecp(tplHtml.substring(0, _before)) + "';";
            if (_skip) {
                tplHtml = tplHtml.substring(_blen+_elen+1);_skip--;
            } else {
                _tmp = trim(tplHtml.substring(_before+_blen, _end));
                if (_tmp === '#') {
                    _skip = 1;
                } else if( _tmp.indexOf('=') === 0 ) {
                    _tmp = _tmp.substring(1);
                    str += "___=" + _tmp + ";typeof ___!=='undefined'&&(__+=___);";
                } else {
                    str += "\n" + _tmp + "\n";
                }
            }
            tplHtml = tplHtml.substring(_end + _elen);
            _before = tplHtml.indexOf( auiTpl.before + (_skip ? '#'+auiTpl.after : '') );
        }
        str += "__+='" + ecp(tplHtml) + "'"+ (v?";":"}") +"return __";
        return new Function(arg1, str);
    }

    window.auiTpl = auiTpl;
    typeof define === 'function' && define('auiTpl',[],function(){return auiTpl});
})(this);