import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap

import Alpine from 'alpinejs'

window.Alpine = Alpine;

Alpine.start();

const dropdown = document.querySelector('.nav-item.dropdown')
if (dropdown) {
    const dropdownMenu = new bootstrap.Dropdown(dropdown)
    dropdown.querySelector('.dropdown-toggle').addEventListener('click', () => dropdownMenu.toggle())
}
