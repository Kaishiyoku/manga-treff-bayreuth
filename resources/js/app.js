window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');

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
    });
} catch (e) {
    //
}
