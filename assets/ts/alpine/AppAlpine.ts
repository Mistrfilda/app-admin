//ALPINE
//@ts-ignore
import Alpine from 'alpinejs';

Alpine.data('frontMenu', () => ({
    show: false,
    click() {
        console.log(this.show);
        this.show = !this.show
    },
    isOpen() {
        return this.show;
    }
}));

Alpine.data('dropdown', () => ({
    open: false,

    toggle() {
        this.open = !this.open
    }
}));

Alpine.data('flashMessage', () => ({
    open: true,

    close() {
        this.open = false;
    }
}));

window.Alpine = Alpine;
Alpine.start();