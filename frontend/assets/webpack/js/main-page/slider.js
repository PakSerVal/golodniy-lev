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
        interval:           4000,
        transitionDuration: 700,
        effect:             'slide',
    });
    slider.addCaptions();
    slider.start();
});
