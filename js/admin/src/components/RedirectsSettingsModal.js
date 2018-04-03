import app from 'flarum/app';
import SettingsModal from 'flarum/components/SettingsModal';
import Select from 'flarum/components/Select';
import Button from 'flarum/components/Button';

const settingsPrefix = 'migratetoflarum-vbulletin-redirects.';
const translationPrefix = 'migratetoflarum-vbulletin-redirects.admin.settings.';

export default class RedirectsSettingsModal extends SettingsModal {
    init() {
        super.init();

        this.showAdvanced = false;
    }

    title() {
        return app.translator.trans(translationPrefix + 'title');
    }

    form() {
        return [
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'field.redirectStatus')),
                Select.component({
                    options: {
                        301: app.translator.trans(translationPrefix + 'option.301'),
                        302: app.translator.trans(translationPrefix + 'option.302'),
                    },
                    value: this.setting(settingsPrefix + 'redirectStatus')() || 302,
                    onchange: this.setting(settingsPrefix + 'redirectStatus'),
                }),
            ]),
            (this.showAdvanced ? [
                m('.Form-group', [
                    Button.component({
                        className: 'Button',
                        onclick: () => {
                            this.showAdvanced = false;
                        },
                        children: app.translator.trans(translationPrefix + 'button.hideAdvanced'),
                    }),
                ]),
                m('.Form-group', [
                    m('.Alert', app.translator.trans(translationPrefix + 'disclaimer')),
                ]),
                m('.Form-group', [
                    m('label', app.translator.trans(translationPrefix + 'field.discussionIncrement')),
                    m('input.FormControl', {
                        type: 'number',
                        bidi: this.setting(settingsPrefix + 'discussionIncrement'),
                        placeholder: '0',
                    }),
                ]),
                m('.Form-group', [
                    m('label', app.translator.trans(translationPrefix + 'field.userIncrement')),
                    m('input.FormControl', {
                        type: 'number',
                        bidi: this.setting(settingsPrefix + 'userIncrement'),
                        placeholder: '0',
                    }),
                ]),
                m('.Form-group', [
                    m('label', app.translator.trans(translationPrefix + 'field.tagIncrement')),
                    m('input.FormControl', {
                        type: 'number',
                        bidi: this.setting(settingsPrefix + 'tagIncrement'),
                        placeholder: '0',
                    }),
                ]),
            ] : [
                m('.Form-group', [
                    Button.component({
                        className: 'Button',
                        onclick: () => {
                            this.showAdvanced = true;
                        },
                        children: app.translator.trans(translationPrefix + 'button.showAdvanced'),
                    }),
                ]),
            ]),
        ];
    }
}
