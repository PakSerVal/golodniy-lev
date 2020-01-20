(function($) {
    const SELECTOR_ADD_TAG_INPUT      = '[data-role="add-tag-input"]';
    const SELECTOR_ADD_TAG_BUTTON     = '[data-role="add-tag-btn"]';
    const SELECTOR_TAG_INPUT_TEMPLATE = '[data-role="tag-input-template"]';
    const SELECTOR_SUGGESTS_WRAPPER   = '[data-role="suggests"]';

    $(function() {
        const $addInput  = $(SELECTOR_ADD_TAG_INPUT);
        const $addButton = $(SELECTOR_ADD_TAG_BUTTON);
        const $suggestWrapper = $(SELECTOR_SUGGESTS_WRAPPER);
        const searchUrl = $addInput.data('url');

        const $clone = $(SELECTOR_TAG_INPUT_TEMPLATE).clone().removeAttr('data-role');
        $(SELECTOR_TAG_INPUT_TEMPLATE).remove();

        const showSuggests = (suggests) => {
            for (const suggest of suggests) {
                $suggestWrapper.append('<div class="suggest">' + suggest + '</div>');
            }

            $suggestWrapper.removeClass('hidden');

            $suggestWrapper.find('.suggest').on('click', function() {
                $addInput.val($(this).text());
                closeSuggests();
            });
        };

        const closeSuggests = () => {
            $suggestWrapper.html('');
            $suggestWrapper.addClass('hidden');
        };

        $addInput.on('keyup', function(e) {
            const q = e.target.value;

            $.ajax({
                method: 'GET',
                data: {q: q},
                url: searchUrl,
                success: function(response) {
                    $suggestWrapper.html('');

                    if (response.suggests.length !== 0) {
                        showSuggests(response.suggests);
                    }
                }
            });
        });

        $addButton.on('click', () => {
            const $container = $(document.createElement('div'));
            const $tag = $(document.createElement('div'));
            $tag.html('<span class="tag">' + $addInput.val() + '</span>');
            $container.append($tag);
            $container.append($clone.clone().val($addInput.val()));
            $('.input-wrapper').append($container);

            $tag.on('click', () => {
                $container.remove();
            });

            $addInput.val('');
        });

        $(document).click(function() {
            closeSuggests();
        });

        $addInput.closest('form').on('submit', () => {
            $addInput.remove();
        });
    });
})(jQuery);
