import './bootstrap';
// import axios from 'axios';
// window.axios = axios;

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// // import Alpine from 'alpinejs';
// import { Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
// // import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
window.addEventListener('livewire:initialized', () => {
    const Alpine = window.Alpine;
    Alpine.store('buttonStore', {
        buttons: [],
        addButton(label) {
            this.buttons.push(label);
        },
        removeButton(index) {
            this.buttons.splice(index, 1);
        },
        removeAll() {
            this.buttons = [];
        }
    });
    Alpine.data('mainState', () => {
        let lastScrollTop = 0
        const init = function() {
            window.addEventListener('scroll', () => {
                let st =
                    window.pageYOffset || document.documentElement.scrollTop
                if (st > lastScrollTop) {
                    // downscroll
                    this.scrollingDown = true
                    this.scrollingUp = false
                } else {
                    // upscroll
                    this.scrollingDown = false
                    this.scrollingUp = true
                    if (st == 0) {
                        //  reset
                        this.scrollingDown = false
                        this.scrollingUp = false
                    }
                }
                lastScrollTop = st <= 0 ? 0 : st // For Mobile or negative scrolling
            })
        }

        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }
            return (
                !!window.matchMedia &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            )
        }
        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }
        return {
            init,
            isDarkMode: getTheme(),
            toggleTheme() {
                this.isDarkMode = !this.isDarkMode
                setTheme(this.isDarkMode)
            },
            isSidebarOpen: window.innerWidth > 1024,
            isSidebarHovered: false,
            handleSidebarHover(value) {
                if (window.innerWidth < 1024) {
                    return
                }
                this.isSidebarHovered = value
            },
            handleWindowResize() {
                if (window.innerWidth <= 1024) {
                    this.isSidebarOpen = false
                } else {
                    this.isSidebarOpen = true
                }
            },
            scrollingDown: false,
            scrollingUp: false,
            windowWidth: window.innerWidth,
        }
    });
    Alpine.plugin(collapse);

    Alpine.initTree(document.body);
});
// window.Alpine = Alpine;
// window.deferLoadingAlpine = function(callback) {
//     window.addEventListener('livewire:initialized', function() {
//         callback();
//     });
// };
