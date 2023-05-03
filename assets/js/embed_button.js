(function(){
    tinymce.create('tinymce.plugins.edisound_embed_plugin', {
        getInfo: function() {
            return {
                longname: 'Add Edisoud player ShortCode',
                author: 'Erwan Nader',
                authorurl: 'https://www.edisound.com',
                version: "0.1.1"
            };
        },
        init: function (ed, url) {

            // button options
            ed.addButton('edisound_button', {
                title: 'Add Edisoud player',
                cmd: 'edisound_insert_shortcode',
                image : url+'/img/edisound.png'
            });

            ed.addCommand('edisound_insert_shortcode', function () {

                const selected = ed.selection.getContent();
                let content;

                // if text is selected use that as the video source
                // remove this if it doesn't apply
                if (selected) {
                    content = '[edisound_player tag=' + selected + ']';
                    tinymce.execCommand('mceInsertContent', false, content);
                } else {
                    ed.windowManager.open({
                        title: 'Insert player tag', // localize this if necessary
                        body: [{
                            type: 'textbox',
                            name: 'tag',
                            label: 'Tag',
                            class: 'toto',
                        }],
                        onsubmit: function (e) {
                            // generate shortcode to be inserted
                            const shortcode = '[edisound_player tag=' + e.data.tag + ']';

                            ed.insertContent(shortcode);
                        }
                    });
                }

            });
        }
    });

    // Add button
    tinymce.PluginManager.add('edisound_button', tinymce.plugins.edisound_embed_plugin);
})();
