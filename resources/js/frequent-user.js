import * as bootstrap from 'bootstrap'

window.bootstrap = bootstrap

const DAFAULT_TRIP_VALUE = 1.80

window.onload = async () => {
    //Add visit analytics
    let url = window.location.pathname.split('/')
    url = url[url.length - 1]
    if (url === ''){
        url = 'homepage'
    }
    let response = await fetch('http://localhost:8000/api/websitevisitors', {
        method: 'POST',
        body: JSON.stringify({'url_visited' : url, 'userAgent' : window.navigator.userAgent}),
        headers: {"Content-type": "application/json; charset=UTF-8"}
    })
    const toast = bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast'))

    document.getElementById('submitBalanceForm')
        .addEventListener('click', async (e) => await addBalance(e))

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

    // TODO: change the button layout PLEASE
    document.querySelector('#registTrip').addEventListener('click', async (e) => {
        let res = await addBalance(e, DAFAULT_TRIP_VALUE)
        //Registry trip analytics
        if (res){
            let userId = document.getElementById('userId').value
            let response = await fetch('http://localhost:8000/api/registedtrips', {
                method: 'POST',
                body: JSON.stringify({'userId' : userId, 'userAgent' : window.navigator.userAgent}),
                headers: {"Content-type": "application/json; charset=UTF-8"}
            })
        }
    })



    async function addBalance(e, tripBalance = null){
        e.preventDefault()
        const balanceValue = !tripBalance ? document.querySelector('#balanceValue').value : tripBalance
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
            document.querySelector('#toastText').innerText = !tripBalance ?
                'O saldo foi atualizado com sucesso.' : 'A viagem foi registada com sucesso'
            toast.show()
            document.querySelector('#balanceValue').value = 0
            return 1;//Done with success
        } else {
            document.querySelector('#closeModal').click()
            document.querySelector('#toastText').innerText = 'Ocorreu um erro!'
            toast.show()
            document.querySelector('#balanceValue').value = 0
            return 0;//Not done
        }
    }

}
