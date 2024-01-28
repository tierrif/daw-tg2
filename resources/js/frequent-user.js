import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap


window.onload = () => {
    const toast = bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast'))

    document.getElementById('submitBalanceForm')
        .addEventListener('click', async (e) => {
            e.preventDefault()
            console.log("ola")
            const balanceValue = document.querySelector('#balanceValue').value
            const updateBalance =
                await fetch(`http://127.0.0.1:8000/api/balance/${document.getElementById('userId').value}`,
                {method: 'PUT', body: JSON.stringify({'balance': parseFloat(balanceValue)}),
                headers: {"Content-type": "application/json; charset=UTF-8"}})
            if (updateBalance.ok){
                let finalBalance = parseFloat(document.querySelector('#balanceInitialValue').value)
                    + parseFloat(balanceValue)
                document.querySelector('#balanceInitialValue').value = finalBalance
                document.querySelector('#balanceText').innerHTML = "Saldo: " + finalBalance + " €"
                document.querySelector('#closeModal').click()
                document.querySelector('#toastText').innerText = 'O saldo foi atualizado com sucesso'
                toast.show()
            }else{
                document.querySelector('#closeModal').click()
                document.querySelector('#toastText').innerText = 'Ocorreu um erro!'
                toast.show()
            }
        })



}
