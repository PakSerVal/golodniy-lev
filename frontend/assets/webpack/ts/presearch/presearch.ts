import {PresearchItem} from './contracts/presearch-item';

/**
 * Пресёч.
 *
 * @author Pak Sergey
 */
export default class Presearch {

    private searchWrapper: HTMLElement;

    private presearchItems: HTMLElement[] = [];

    private selectedIndex = null;

    /**
     * @inheritDoc
     *
     * @param {HTMLInputElement} input
     * @param {string}           presearchUrl
     *
     * @author Pak Sergey
     */
    constructor(private input: HTMLInputElement, private presearchUrl: string) {}

    /**
     * Инициализация.
     *
     * @author Pak Sergey
     */
    public init() {
        this.searchWrapper = this.input.form.querySelector('[data-search-wrapper]');

        this.searchWrapper.style.display = 'none';

        this.input.addEventListener('keyup', this.keyDownHandler.bind(this));

        document.addEventListener('click', () => {
            this.searchWrapper.innerHTML     = '';
            this.searchWrapper.style.display = 'none';
        });

        document.querySelector('[data-search-icon]').addEventListener('click', () => {
            this.input.form.submit();
        });
    }

    /**
     * Обработчик ввода текста в инпуте.
     *
     * @author Pak Sergey
     */
    private keyDownHandler(e) {
        if (this.presearchItems.length !== 0 && (e.key === 'ArrowUp' || e.key === 'ArrowDown')) {
            if (e.key === 'ArrowUp') {
                if (null === this.selectedIndex || this.selectedIndex === 0) {
                    this.selectedIndex = this.presearchItems.length - 1;
                }
                else {
                    this.selectedIndex = this.selectedIndex - 1;
                }
            }
            else {
                if (e.key === 'ArrowDown') {
                    if (null === this.selectedIndex || this.presearchItems.length - 1 === this.selectedIndex) {
                        this.selectedIndex = 0;
                    }
                    else {
                        this.selectedIndex = this.selectedIndex + 1;
                    }
                }
            }

            for (let i = 0; i < this.presearchItems.length; i++) {
                this.presearchItems[i].classList.remove('active');

                if (i === this.selectedIndex) {
                    this.presearchItems[i].classList.add('active');
                    this.input.value = this.presearchItems[i].textContent;
                }
            }

            return;
        }

        const q = e.target.value;

        if (q.length < 2) {
            return;
        }

        this.sendRequest(q)
            .then((items: PresearchItem[]) => {
                this.searchWrapper.innerHTML     = '';
                this.presearchItems              = [];
                this.selectedIndex               = null;

                if (0 !== items.length) {
                    this.searchWrapper.style.display = 'block';
                    this.searchWrapper.style.width   = document.querySelector('.presearch-input-wrapper').clientWidth.toString() + 'px';
                }

                items.forEach((item: PresearchItem) => {
                    const link = document.createElement('a');
                    link.classList.add('presearch__item');

                    link.href        = item.url;
                    link.textContent = item.title;

                    this.searchWrapper.append(link);
                    this.presearchItems.push(link);
                });
            })
        ;
    }


    /**
     * Отправка запроса.
     *
     * @param {string} q
     *
     * @author Pak Sergey
     */
    private sendRequest(q: string): Promise<any> {
        const headers = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-Token':     document.querySelector('meta[name=csrf-token]').getAttribute('content'),
        };

        return fetch(this.presearchUrl + '?q=' + q, {
            cache:       'no-cache',
            credentials: 'same-origin',
            headers,
            method:      'GET',
            mode:        'cors',
            redirect:    'follow',
            referrer:    'no-referrer',
        })
            .then((response) => {
                return response.json();
            })
        ;
    }
}
