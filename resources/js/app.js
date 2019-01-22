window._ = require('lodash');
window.Popper = require('popper.js').default;
window.Waves = require('node-waves');

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');

    $(document).ready(function () {
        Waves.attach('.btn-primary', ['waves-light']);
        Waves.attach('.btn-secondary', ['waves-light']);
        Waves.attach('.btn-success', ['waves-light']);
        Waves.attach('.btn-danger', ['waves-light']);
        Waves.attach('.btn-warning', ['waves-light']);
        Waves.attach('.btn-info', ['waves-light']);
        Waves.attach('.btn-light', ['waves-dark']);
        Waves.attach('.btn-dark', ['waves-light']);

        Waves.attach('.btn-outline-primary', ['waves-light']);
        Waves.attach('.btn-outline-secondary', ['waves-light']);
        Waves.attach('.btn-outline-success', ['waves-light']);
        Waves.attach('.btn-outline-danger', ['waves-light']);
        Waves.attach('.btn-outline-warning', ['waves-light']);
        Waves.attach('.btn-outline-info', ['waves-light']);
        Waves.attach('.btn-outline-light', ['waves-dark']);
        Waves.attach('.btn-outline-dark', ['waves-light']);

        Waves.attach('.dropdown-item.active', ['waves-light']);
        Waves.attach('.dropdown-item', ['waves-dark']);
        Waves.attach('.nav-item.active > .nav-link', ['waves-light']);
        Waves.attach('.nav-item > .nav-link', ['waves-light']);
        Waves.attach('a.card-header', ['waves-light']);

        Waves.attach('a.page-link', ['waves-dark']);

        Waves.init();

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