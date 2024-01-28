import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap

import Alpine from 'alpinejs'

window.Alpine = Alpine;

Alpine.start();


window.onload = async () => {
    console.log()
    document.querySelector('#submitBalanceForm').addEventListener('onclick', async (e) => {
        e.preventDefault()
        console.log("ola")
        const balanceValue = document.querySelector('#balanceValue').value
        const updateBalance = await fetch('http://localhost:8080/api/balance/1', {method: 'PUT', body: JSON.stringify({'balance': balanceValue})})

    })
}
