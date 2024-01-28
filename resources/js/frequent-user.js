import * as bootstrap from 'bootstrap'

window.bootstrap = bootstrap


window.onload = () => {
    const toast = bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast'))

    document.getElementById('submitBalanceForm')
        .addEventListener('click', async (e) => {
            e.preventDefault()
            const balanceValue = document.querySelector('#balanceValue').value
            if (parseFloat(balanceValue) <= 0 || balanceValue === ''){
                document.querySelector('#closeModal').click()
                document.querySelector('#toastText').innerText = 'Inseriu um montante invalido!'
                toast.show()
                document.querySelector('#balanceValue').value = 0
                return
            }
            const updateBalance =
                await fetch(`http://127.0.0.1:8000/api/balance/${document.getElementById('userId').value}`,
                    {
                        method: 'PUT', body: JSON.stringify({'balance': parseFloat(balanceValue)}),
                        headers: {"Content-type": "application/json; charset=UTF-8"}
                    })
            if (updateBalance.ok) {
                let finalBalance = parseFloat(document.querySelector('#balanceInitialValue').value)
                    + parseFloat(balanceValue)
                document.querySelector('#balanceInitialValue').value = finalBalance
                document.querySelector('#balanceText').innerHTML = "Saldo: " + finalBalance + " €"
                document.querySelector('#closeModal').click()
                document.querySelector('#toastText').innerText = 'O saldo foi atualizado com sucesso.'
                toast.show()
                document.querySelector('#balanceValue').value = 0
            } else {
                document.querySelector('#closeModal').click()
                document.querySelector('#toastText').innerText = 'Ocorreu um erro!'
                toast.show()
                document.querySelector('#balanceValue').value = 0
            }
        })

    document.querySelector('#stationAddBtn').addEventListener('click', async (e) => {
        e.preventDefault()
        let station = document.querySelector('#stationDataList').value
        let userId = document.getElementById('userId').value
        let allStations = await (await fetch('http://127.0.0.1:8000/api/station')).json()
        let stationId
        try {
            stationId = allStations.filter((s) => {
                return s.displayName === station
            })[0].id
        }catch (e) {
            document.querySelector('#closeModalStation').click()
            document.querySelector('#toastText').innerText = 'Inseriu uma estação não existente!'
            toast.show()
            return
        }
        const response = await fetch(`http://127.0.0.1:8000/api/frequentstations/`,
            {
                method: 'POST', body: JSON.stringify({'userId': userId, 'stationId': stationId}),
                headers: {"Content-type": "application/json; charset=UTF-8"}
            })

        if (response.ok) {
            document.querySelector('#closeModalStation').click()
            document.querySelector('#toastText').innerText = 'A estação foi adicionado com sucesso.'
            toast.show()
        } else {
            document.querySelector('#closeModalStation').click()
            document.querySelector('#toastText').innerText = 'Ocorreu um erro!'
            toast.show()
        }
    })


}
