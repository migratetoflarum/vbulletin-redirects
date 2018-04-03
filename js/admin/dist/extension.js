'use strict';

System.register('migratetoflarum/vbulletin-redirects/components/RedirectsSettingsModal', ['flarum/app', 'flarum/components/SettingsModal', 'flarum/components/Select', 'flarum/components/Button'], function (_export, _context) {
    "use strict";

    var app, SettingsModal, Select, Button, settingsPrefix, translationPrefix, RedirectsSettingsModal;
    return {
        setters: [function (_flarumApp) {
            app = _flarumApp.default;
        }, function (_flarumComponentsSettingsModal) {
            SettingsModal = _flarumComponentsSettingsModal.default;
        }, function (_flarumComponentsSelect) {
            Select = _flarumComponentsSelect.default;
        }, function (_flarumComponentsButton) {
            Button = _flarumComponentsButton.default;
        }],
        execute: function () {
            settingsPrefix = 'migratetoflarum-vbulletin-redirects.';
            translationPrefix = 'migratetoflarum-vbulletin-redirects.admin.settings.';

            RedirectsSettingsModal = function (_SettingsModal) {
                babelHelpers.inherits(RedirectsSettingsModal, _SettingsModal);

                function RedirectsSettingsModal() {
                    babelHelpers.classCallCheck(this, RedirectsSettingsModal);
                    return babelHelpers.possibleConstructorReturn(this, (RedirectsSettingsModal.__proto__ || Object.getPrototypeOf(RedirectsSettingsModal)).apply(this, arguments));
                }

                babelHelpers.createClass(RedirectsSettingsModal, [{
                    key: 'init',
                    value: function init() {
                        babelHelpers.get(RedirectsSettingsModal.prototype.__proto__ || Object.getPrototypeOf(RedirectsSettingsModal.prototype), 'init', this).call(this);

                        this.showAdvanced = false;
                    }
                }, {
                    key: 'title',
                    value: function title() {
                        return app.translator.trans(translationPrefix + 'title');
                    }
                }, {
                    key: 'form',
                    value: function form() {
                        var _this2 = this;

                        return [m('.Form-group', [m('label', app.translator.trans(translationPrefix + 'field.redirectStatus')), Select.component({
                            options: {
                                301: app.translator.trans(translationPrefix + 'option.301'),
                                302: app.translator.trans(translationPrefix + 'option.302')
                            },
                            value: this.setting(settingsPrefix + 'redirectStatus')() || 302,
                            onchange: this.setting(settingsPrefix + 'redirectStatus')
                        })]), this.showAdvanced ? [m('.Form-group', [Button.component({
                            className: 'Button',
                            onclick: function onclick() {
                                _this2.showAdvanced = false;
                            },
                            children: app.translator.trans(translationPrefix + 'button.hideAdvanced')
                        })]), m('.Form-group', [m('.Alert', app.translator.trans(translationPrefix + 'disclaimer'))]), m('.Form-group', [m('label', app.translator.trans(translationPrefix + 'field.discussionIncrement')), m('input.FormControl', {
                            type: 'number',
                            bidi: this.setting(settingsPrefix + 'discussionIncrement'),
                            placeholder: '0'
                        })]), m('.Form-group', [m('label', app.translator.trans(translationPrefix + 'field.userIncrement')), m('input.FormControl', {
                            type: 'number',
                            bidi: this.setting(settingsPrefix + 'userIncrement'),
                            placeholder: '0'
                        })]), m('.Form-group', [m('label', app.translator.trans(translationPrefix + 'field.tagIncrement')), m('input.FormControl', {
                            type: 'number',
                            bidi: this.setting(settingsPrefix + 'tagIncrement'),
                            placeholder: '0'
                        })])] : [m('.Form-group', [Button.component({
                            className: 'Button',
                            onclick: function onclick() {
                                _this2.showAdvanced = true;
                            },
                            children: app.translator.trans(translationPrefix + 'button.showAdvanced')
                        })])]];
                    }
                }]);
                return RedirectsSettingsModal;
            }(SettingsModal);

            _export('default', RedirectsSettingsModal);
        }
    };
});;
'use strict';

System.register('migratetoflarum/vbulletin-redirects/main', ['flarum/extend', 'flarum/app', 'migratetoflarum/vbulletin-redirects/components/RedirectsSettingsModal'], function (_export, _context) {
    "use strict";

    var extend, app, RedirectsSettingsModal;
    return {
        setters: [function (_flarumExtend) {
            extend = _flarumExtend.extend;
        }, function (_flarumApp) {
            app = _flarumApp.default;
        }, function (_migratetoflarumVbulletinRedirectsComponentsRedirectsSettingsModal) {
            RedirectsSettingsModal = _migratetoflarumVbulletinRedirectsComponentsRedirectsSettingsModal.default;
        }],
        execute: function () {

            app.initializers.add('migratetoflarum-vbulletin-redirects', function (app) {
                app.extensionSettings['migratetoflarum-vbulletin-redirects'] = function () {
                    return app.modal.show(new RedirectsSettingsModal());
                };
            });
        }
    };
});