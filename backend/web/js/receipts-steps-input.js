(function($) {
    const SELECTOR_BUTTON_ADD     = '[data-role="add-step-btn"]';
    const SELECTOR_BUTTON_REMOVE  = '[data-role="remove-step-btn"]';
    const SELECTOR_TEMPLATE_INPUT = '[data-role="step-template"]';

    $(function() {
        $(SELECTOR_BUTTON_ADD).on('click', () => {
            const $clone = $(SELECTOR_TEMPLATE_INPUT).clone();
            $clone.removeAttr('hidden').removeAttr('data-role').appendTo($('.steps-input-wrapper'));
            $clone.find(SELECTOR_BUTTON_REMOVE).on('click', () => {
                $clone.remove();
            });
        });

        $(SELECTOR_BUTTON_ADD).closest('form').on('submit', () => {
            $(SELECTOR_TEMPLATE_INPUT).remove();
        });
    });
})(jQuery);
