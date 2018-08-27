/*
validate.js 多用于表单验证
*/
// export function isEmail (text) {
//     var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     return reg.test(text);
// }

// export function  isPassword (text) {
//     var reg = /^[a-zA-Z0-9]{6,20}$/;
//     return reg.test(text);
// }


export class AbstractView {
    constructor(opts) {
        opts = opts || {};
        this.wrapper = opts.wrapper || $('body');
        //事件集合
        this.events = {};
        this.isCreate = false;
    }
    on(type, fn) {
        if (!this.events[type]) this.events[type] = [];
        this.events[type].push(fn);
    }
    trigger(type) {
        if (!this.events[type]) return;
        for (var i = 0, len = this.events[type].length; i < len; i++) {
            this.events[type][i].call(this)
        }
    }
    createHtml() {
        throw '必须重写';
    }
    create() {
        this.root = $(this.createHtml());
        this.wrapper.append(this.root);
        this.trigger('onCreate');
        this.isCreate = true;
    }
    show() {
        if (!this.isCreate) this.create();
        this.root.show();
        this.trigger('onShow');
    }
    hide() {
        this.root.hide();
    }
}
export class Alert extends AbstractView {
    createHtml() {
        return '<div class="alert">这里是alert框</div>';
    }
}
export class AlertTitle extends Alert {
    constructor(opts) {
        super(opts);
        this.title = '';
    }
    createHtml() {
        return '<div class="alert"><h2>' + this.title + '</h2>这里是带标题alert框</div>';
    }
    setTitle(title) {
        this.title = title;
        this.root.find('h2').html(title)
    }
}
export class  AlertTitleButton extends AlertTitle {
    constructor(opts) {
        super(opts);
        this.on('onShow', function () {
            var bt = $('<input type="button" value="点击我" />');
            bt.click($.proxy(function () {
                alert(this.title);
            }, this));
            this.root.append(bt)
        });
    }
}