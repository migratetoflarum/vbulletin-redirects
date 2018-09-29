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
            <div className="Form-group">
                <label>{app.translator.trans(translationPrefix + 'field.redirectStatus')}</label>
                {Select.component({
                    options: {
                        301: app.translator.trans(translationPrefix + 'option.301'),
                        302: app.translator.trans(translationPrefix + 'option.302'),
                    },
                    value: this.setting(settingsPrefix + 'redirectStatus')() || 302,
                    onchange: this.setting(settingsPrefix + 'redirectStatus'),
                })}
            </div>,
            this.showAdvanced ? [
                <div className="Form-group">
                    {Button.component({
                        className: 'Button',
                        onclick: () => this.showAdvanced = false,
                        children: app.translator.trans(translationPrefix + 'button.hideAdvanced'),
                    })}
                </div>,
                <div className="Form-group">
                    <label>{app.translator.trans(translationPrefix + 'field.discussionIncrement')}</label>
                    <input type="number" bidi={this.setting(settingsPrefix + 'discussionIncrement')} className="FormControl" placeholder="0"/>
                </div>,
                <div className="Form-group">
                    <label>{app.translator.trans(translationPrefix + 'field.userIncrement')}</label>
                    <input type="number" bidi={this.setting(settingsPrefix + 'userIncrement')} className="FormControl" placeholder="0"/>
                </div>,
                <div className="Form-group">
                    <label>{app.translator.trans(translationPrefix + 'field.tagIncrement')}</label>
                    <input type="number" bidi={this.setting(settingsPrefix + 'tagIncrement')} className="FormControl" placeholder="0"/>
                </div>
            ] : [
                <div className="Form-group">
                    {Button.component({
                        className: 'Button',
                        onclick: () => this.showAdvanced = true,
                        children: app.translator.trans(translationPrefix + 'button.showAdvanced'),
                    })}
                </div>
            ]
        ];
    }
}
