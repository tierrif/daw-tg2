import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap

import Alpine from 'alpinejs'

window.Alpine = Alpine;

Alpine.start();


window.onload = async () => {
    const balanceModal = document.getElementById('balanceModal')
    const balanceBtn = document.getElementById('plusBalance')

    balanceModal.addEventListener('shown.bs.modal', () => {
        balanceBtn.focus()
    })
}
