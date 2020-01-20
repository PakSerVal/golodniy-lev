/**
 * Страница редактирования рецепта.
 *
 * @author Pak Sergey
 */
(function($) {
    const SELECTOR_DELETE_STEP_BTN = '[data-role="delete-step-btn"]';
    const SELECTOR_DELETE_TAG_BTN  = '[data-role="delete-tag-btn"]';

    $(function() {
        /**
         * Обработка клика по кнопке удаления шага.
         *
         * @author Pak Sergey
         */
        $(SELECTOR_DELETE_STEP_BTN).on('click', (e) => {
            e.preventDefault();

            const $step = $(e.target).closest('.receipt-step');

            $.ajax(
                {
                    'url': e.target.href,
                    'type': 'POST',
                    'success': function(response) {
                        console.log(response);

                        if (true === response.result) {
                            $step.remove();
                        }
                    },
                }
            );
        });

        /**
         * Обработка клика по кнопке удаления шага.
         *
         * @author Pak Sergey
         */
        $(SELECTOR_DELETE_TAG_BTN).on('click', (e) => {
            e.preventDefault();

            const $tag = $(e.target).closest('.receipt-tag');

            $.ajax(
                {
                    'url': e.target.href,
                    'type': 'POST',
                    'success': function(response) {
                        console.log(response);

                        if (true === response.result) {
                            $tag.remove();
                        }
                    },
                }
            );
        });
    });
})(jQuery);
