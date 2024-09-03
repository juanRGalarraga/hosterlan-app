import DOM from './dom';
import Button from './button';

const MAX_LENGTH = 300;

export default class CollapseText {

    isExpanded = false
    showMoreButton
    textContent
    textSlice

    constructor(textContent){
        this.textContent = DOM.captureElement(textContent)
        this.showMoreButton = Button.create('Ver más', {class: 'bg-none hidden'});
        this.textContent.insertAdjacentElement('afterend', showMore);
        this.textContent.insertAdjacentElement('afterend', this.showMoreButton);
        this.slice();
    }

    createExpandableText() {
        let text = this.textContent.innerText;
        let segmentSize = MAX_LENGTH;
        let currentSegment = 0;

        function updateTextDisplay() {
            const start = currentSegment * segmentSize;
            const end = Math.min(start + segmentSize, text.length);
            this.textContent.innerText = text.slice(0, end) + (end < text.length ? '...' : '');

            if (end >= text.length) {
                showMore.style.display = 'none';
            } else {
                showMore.style.display = 'inline';
                showMore.innerText = 'Ver más';
            }
        }

        this.showMoreButton.addEventListener('click', function() {
            currentSegment += 1;
            updateTextDisplay();
        });

        updateTextDisplay();
    }

}