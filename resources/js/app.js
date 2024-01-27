import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.onload = async () => {
    // Add line states to all lines.
    const { resposta } = await (await fetch('http://localhost:8000/api/line')).json()
    Object.entries(resposta).splice(0, 4).forEach(([lineName, lineStatus]) => {
        const checkmark = document.querySelector(`.${lineName} .checkmark`)
        checkmark.setAttribute('data-bs-title', 'Estado: ' + lineStatus)
    })

    // Initialize tooltips.
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
}
