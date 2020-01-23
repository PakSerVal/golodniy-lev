/**
 * Main page slider.
 *
 * @author Pak Sergey
 */
document.addEventListener('DOMContentLoaded', () => {
    if (null === document.getElementById('slider')) {
        return;
    }

    const slider = new IdealImageSlider.Slider({
        selector:           '#slider',
        height:             'auto',
        initialHeight:      400,
        minHeight:          null,
        interval:           6000,
        transitionDuration: 700,
        effect:             'fade',
    });
    slider.addCaptions();
    slider.start();
});
