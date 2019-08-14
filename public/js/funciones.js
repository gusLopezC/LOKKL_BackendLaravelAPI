$(document).ready(function() {
    $('.test-popup-link').magnificPopup({
        type: 'image',
        closeBtnInside: false,
        closeOnContentClick: false,

        callbacks: {
            open: function() {
                var self = this;
                self.wrap.on('click.pinhandler', 'img', function() {
                    self.wrap.toggleClass('mfp-force-scrollbars');
                });
            },
            beforeClose: function() {
                this.wrap.off('click.pinhandler');
                this.wrap.removeClass('mfp-force-scrollbars');
            }
        },

        image: {
            verticalFit: false
        }

    });
});