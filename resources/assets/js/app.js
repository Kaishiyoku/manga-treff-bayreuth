window._ = require('lodash');
window.Popper = require('popper.js').default;

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');

    $(document).ready(function () {
        $('[data-submit]').each(function () {
            const $this = $(this);

            $this.click(function (event) {
                event.preventDefault();

                $($this.attr('data-submit')).submit();
            });
        });

        $('[data-confirm]').click(function () {
            let confirmationText = $(this).attr('data-confirm');

            if (_.isEmpty(confirmationText) || confirmationText == 1) {
                confirmationText = 'Are you sure?';
            }

            if (!confirm(confirmationText)) {
                return false;
            }
        });

        $('[data-toggle="tooltip"]').tooltip();
    });
} catch (e) {}