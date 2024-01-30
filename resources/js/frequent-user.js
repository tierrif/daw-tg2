import * as bootstrap from 'bootstrap'

window.bootstrap = bootstrap

const DEFAULT_TRIP_VALUE = 1.80

window.onload = async () => {
    //Add visit analytics
    let url = window.location.pathname.split('/')
    url = url[url.length - 1]
    if (url === '') {
        url = 'homepage'
    }

    await fetch('http://localhost:8000/api/websitevisitors', {
        method: 'POST',
        body: JSON.stringify({ 'url_visited': url, 'userAgent': window.navigator.userAgent }),
        headers: { 'Content-type': 'application/json; charset=UTF-8' }
    })

    const toast = bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast'))

    // Get frequent stations.
    const stations = JSON.parse(document.querySelector('#frequent-stations-data').value)

    // Add line states to all lines.
    const lines = Object.fromEntries(Object.entries(
        (await (await fetch('http://localhost:8000/api/line')).json()).resposta).splice(0, 4))

    for (const stationEl of document.querySelectorAll('#frequent-stations .card')) {
        const stationLines = JSON.parse(stationEl.getAttribute('data-lines'))

        let isOk = true
        for (const stationLine of stationLines) {
            if (lines[stationLine] !== ' Ok') {
                isOk = false
                break
            }
        }

        const h5 = document.createElement('h5')
        h5.classList.add(isOk ? 'station-ok' : 'station-not-ok')
        h5.innerText = isOk ? 'Operacional' : 'Com Interrupções'

        stationEl.querySelector('.station-info').append(h5)
        stationEl.addEventListener('click', async (e) => {
            const station = stations.find((s) => s.stringId === e.currentTarget.getAttribute('data-station'))
            document.querySelector('#station-name').innerText = station.displayName

            // Show the result.
            const stationInfo = document.querySelector('#stationInfoModalBody')

            const text = stationInfo.querySelector('.text')
            text.innerHTML = 'Por favor, aguarde...'

            const modal = new bootstrap.Modal(document.querySelector('#stationInfoModal'))
            modal.show()

            const stops = []
            for (const line of station.lines) {
                const stationResults = await Promise.all((await (await fetch(`http://localhost:8000/api/station/${line.stringId}`)).json())
                    .resposta.map((result) => ({ ...result, line }))
                    .map(async (result) => ({
                        ...result, destinationInfo: (await ((await fetch(`http://localhost:8000/api/destination/${result.destino}`)).json()))
                    })))

                stops.push(...stationResults.filter((result) => result.stop_id === station.stringId))
            }

            text.innerHTML = ''

            let previousLine
            let previousLineCol
            for (const stop of stops) {
                // Display the line if it's different.
                if (previousLine !== stop.line.id) {
                    previousLine = stop.line.id
                    previousLineCol = document.createElement('div')
                    previousLineCol.classList.add('col')

                    const lineIndicatorWrapper = document.createElement('h5')
                    lineIndicatorWrapper.classList.add('line', stop.line.stringId)

                    const lineIndicator = document.createElement('span')
                    lineIndicator.classList.add('line-box', 'line-box-sm')
                    lineIndicator.innerText = stop.line.displayName

                    lineIndicatorWrapper.append(document.createTextNode('Linha: '))
                    lineIndicatorWrapper.append(lineIndicator)

                    previousLineCol.append(lineIndicatorWrapper)

                    text.append(previousLineCol)

                    const p = document.createElement('p')
                    if (lines[stop.line.stringId] !== ' Ok') {
                        p.innerHTML = '<b>Interrupções na linha: </b>' + lines[stop.line.stringId]
                    } else {
                        p.innerHTML = '<b>Linha operacional.</b>'
                    }
                    text.append(p)
                }

                // Display stop info.
                const info = document.createElement('p')
                info.innerHTML += `Sentido <b>${stop.destinationInfo.displayName}</b><br>`
                const minutes = stop.tempoChegada1 / 60
                info.innerHTML += `Tempo de chegada: <b>${Math.floor(minutes)}</b> min e <b>${Math.floor((minutes % 1) * 60)}</b> seg<br>`
                info.innerHTML += `Comboio: <b>${stop.comboio}</b>`

                previousLineCol.append(info)
            }
        })
    }

    document.getElementById('submitBalanceForm').addEventListener('click', async (e) => await addBalance(e))

    document.querySelector('#stationAddBtn').addEventListener('click', async (e) => {
        e.preventDefault()

        const station = document.querySelector('#stationDataList').value
        const userId = document.getElementById('userId').value
        const allStations = await (await fetch('http://127.0.0.1:8000/api/station')).json()

        let stationId
        try {
            stationId = allStations.find((s) => s.displayName === station).id
        } catch (e) {
            document.querySelector('#closeModalStation').click()
            document.querySelector('#toastText').innerText = 'Inseriu uma estação não existente.'

            return toast.show()
        }

        console.log(document.querySelector('#token').value)

        const response = await fetch(`http://127.0.0.1:8000/api/frequentstations/`, {
            method: 'POST', body: JSON.stringify({ userId, stationId }),
            headers: { 'Content-type': 'application/json; charset=UTF-8',
                'Authorization': 'Bearer ' + document.querySelector('#token').value }
        })

        if (!response.ok) {
            document.querySelector('#closeModalStation').click()
            document.querySelector('#toastText').innerText = 'Ocorreu um erro.'

            return toast.show()
        }

        window.location.reload()
    })

    document.querySelector('#registTrip').addEventListener('click', async (e) => {
        let res = await addBalance(e, DEFAULT_TRIP_VALUE)
        //Registry trip analytics
        if (res) {
            const userId = document.getElementById('userId').value
            await fetch('http://localhost:8000/api/registeredtrips', {
                method: 'POST',
                body: JSON.stringify({ userId, userAgent: window.navigator.userAgent }),
                headers: { 'Content-type': 'application/json; charset=UTF-8' }
            })
        }
    })

    async function addBalance(e, tripBalance = null) {
        e.preventDefault()
        const balanceValue = !tripBalance ? document.querySelector('#balanceValue').value : tripBalance
        if (parseFloat(balanceValue) <= 0 || balanceValue === '') {
            document.querySelector('#closeModal').click()
            document.querySelector('#toastText').innerText = 'Inseriu um montante inválido.'

            toast.show()

            document.querySelector('#balanceValue').value = 0
            return
        }

        const finalBalance = parseFloat(document.querySelector('#balanceInitialValue').value)
            + parseFloat(tripBalance ? -balanceValue : balanceValue)

        if (tripBalance && finalBalance < 0) {
            document.querySelector('#toastText').innerText =
                'Não tem saldo suficiente. Carregue o seu cartão e adicione saldo no canto superior direito.'

            return toast.show()
        }

        const updateBalance =
            await fetch(`http://127.0.0.1:8000/api/balance/${document.getElementById('userId').value}`, {
                method: 'PUT', body: JSON.stringify({ 'balance': parseFloat(tripBalance ? -balanceValue : balanceValue) }),
                headers: { 'Content-type': 'application/json; charset=UTF-8', Authorization: 'Bearer ' + document.querySelector('#token').value }
            })

        if (updateBalance.ok) {
            document.querySelector('#balanceInitialValue').value = finalBalance.toFixed(2)
            document.querySelector('#balanceText').innerHTML = 'Saldo: ' + finalBalance.toFixed(2) + ' €'
            document.querySelector('#closeModal').click()
            document.querySelector('#toastText').innerText = !tripBalance ?
                'O saldo foi atualizado com sucesso.' : 'A viagem foi registada com sucesso.'

            toast.show()

            document.querySelector('#balanceValue').value = 0
            return 1; // Success
        } else {
            document.querySelector('#closeModal').click()
            document.querySelector('#toastText').innerText = 'Ocorreu um erro.'

            toast.show()

            document.querySelector('#balanceValue').value = 0
            return 0; // Failure
        }
    }
}
