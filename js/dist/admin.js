module.exports=function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}return n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(r,o,function(e){return t[e]}.bind(null,o));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=5)}([function(t,e){t.exports=flarum.core.compat.app},function(t,e){t.exports=flarum.core.compat["components/Button"]},function(t,e){t.exports=flarum.core.compat["components/SettingsModal"]},function(t,e){t.exports=flarum.core.compat["components/Select"]},function(t,e){t.exports=flarum.core.compat.extend},function(t,e,n){"use strict";n.r(e);n(4);var r=n(0),o=n.n(r);var a=n(2),i=n.n(a),s=n(3),l=n.n(s),u=n(1),c=n.n(u),p="migratetoflarum-vbulletin-redirects.",d="migratetoflarum-vbulletin-redirects.admin.settings.",f=function(t){function e(){return t.apply(this,arguments)||this}!function(t,e){t.prototype=Object.create(e.prototype),t.prototype.constructor=t,t.__proto__=e}(e,t);var n=e.prototype;return n.init=function(){t.prototype.init.call(this),this.showAdvanced=!1},n.title=function(){return o.a.translator.trans(d+"title")},n.form=function(){var t=this;return[m("div",{className:"Form-group"},m("label",null,o.a.translator.trans(d+"field.redirectStatus")),l.a.component({options:{301:o.a.translator.trans(d+"option.301"),302:o.a.translator.trans(d+"option.302")},value:this.setting(p+"redirectStatus")()||302,onchange:this.setting(p+"redirectStatus")})),this.showAdvanced?[m("div",{className:"Form-group"},c.a.component({className:"Button",onclick:function(){return t.showAdvanced=!1},children:o.a.translator.trans(d+"button.hideAdvanced")})),m("div",{className:"Form-group"},m("label",null,o.a.translator.trans(d+"field.discussionIncrement")),m("input",{type:"number",bidi:this.setting(p+"discussionIncrement"),className:"FormControl",placeholder:"0"})),m("div",{className:"Form-group"},m("label",null,o.a.translator.trans(d+"field.userIncrement")),m("input",{type:"number",bidi:this.setting(p+"userIncrement"),className:"FormControl",placeholder:"0"})),m("div",{className:"Form-group"},m("label",null,o.a.translator.trans(d+"field.tagIncrement")),m("input",{type:"number",bidi:this.setting(p+"tagIncrement"),className:"FormControl",placeholder:"0"}))]:[m("div",{className:"Form-group"},c.a.component({className:"Button",onclick:function(){return t.showAdvanced=!0},children:o.a.translator.trans(d+"button.showAdvanced")}))]]},e}(i.a);o.a.initializers.add("migratetoflarum-vbulletin-redirects",function(t){t.extensionSettings["migratetoflarum-vbulletin-redirects"]=function(){return t.modal.show(new f)}})}]);
//# sourceMappingURL=admin.js.map