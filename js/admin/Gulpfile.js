const gulp = require('flarum-gulp');

gulp({
    modules: {
        'migratetoflarum/vbulletin-redirects': 'src/**/*.js'
    }
});
