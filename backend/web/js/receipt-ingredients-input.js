(function($) {
    const SELECTOR_BUTTON_ADD         = '[data-role="add-ingredient-btn"]';
    const SELECTOR_BUTTON_CREATE      = '[data-role="create-ingredient-btn"]';
    const SELECTOR_TEMPLATE_INPUT     = '[data-role="ingredient-template"]';
    const SELECTOR_BUTTON_REMOVE      = '[data-role="remove-ingredient-btn"]';
    const SELECTOR_INGREDIENTS_SELECT = '[data-role="ingredients-select"]';

    $(function() {
        $(SELECTOR_BUTTON_ADD).on('click', () => {
            const $clone = $(SELECTOR_TEMPLATE_INPUT).clone().removeAttr('data-role').removeAttr('hidden');
            $clone.appendTo($('.ingredients-input-wrapper'));

            $clone.find(SELECTOR_BUTTON_REMOVE).on('click', () => {
                $clone.remove();
            });
        });

        $(SELECTOR_BUTTON_REMOVE).on('click', function() {
            $(this).closest('.form-inline').remove();
        });

        $(document.body).on('click', SELECTOR_BUTTON_CREATE, (e) => {
            e.preventDefault();

            $.ajax(
                {
                    'url': e.target.href,
                    'data': {title: $('.ingredient-title').val()},
                    'method':  'POST',
                    'success': function(response) {
                        $('#create-ingredient-modal').modal('hide');

                        const option = '<option value="' + response.id + '">' + response.title + '</option>';
                        $(SELECTOR_INGREDIENTS_SELECT).append(option);
                    },
                }
            );
        });

        $(SELECTOR_BUTTON_ADD).closest('form').on('submit', () => {
            $(SELECTOR_TEMPLATE_INPUT).remove();
        });
    });
})(jQuery);
