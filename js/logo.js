var $headline = $('#headline').hide();

var $word1 = $('#arc-wrapper').find('h3').hide();
var $word2 = $('#arc-wrapper').find('h4').hide();

google.load('webfont', '1');

google.setOnLoadCallback(function() {
    WebFont.load({
        google: {
            families: ['Montserrat', 'Concert One']
        },
        fontactive: function(fontFamily, fontDescription) {
            init();
        },
        fontinactive: function(fontFamily, fontDescription) {
            init();
        }
    });
});

function init() {
    $headline.show().arctext({ radius: 100 });
};