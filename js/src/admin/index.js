import {extend} from 'flarum/extend';
import app from 'flarum/app';
import RedirectsSettingsModal from './components/RedirectsSettingsModal';

app.initializers.add('migratetoflarum-vbulletin-redirects', app => {
    app.extensionSettings['migratetoflarum-vbulletin-redirects'] = () => app.modal.show(new RedirectsSettingsModal());
});
