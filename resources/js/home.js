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

    // Add line states to all lines.
    let { resposta: lines } = await (await fetch('http://localhost:8000/api/line')).json()
    console.log(lines)
    if (lines === 'Circulação encerrada') {
        lines = JSON.parse(document.querySelector('#lines').value).map((l) => ({ [l.stringId]: ' Circulação Encerrada' }))
            .reduce((a, b) => ({ ...a, ...b }))
    }
    console.log(lines)

    Object.entries(lines).splice(0, 4).forEach(([lineName, lineStatus]) => {
        const checkmark = document.querySelector(`.${lineName} .checkmark`)
        checkmark.setAttribute('data-bs-title', 'Estado:' + lineStatus)

        if (lineStatus !== ' Ok') {
            checkmark.querySelector('img').setAttribute('src', document.querySelector('#warning_url').value)
        }
    })

    // Initialize tooltips.
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    // Handle search.
    const button = document.querySelector('#search-btn')
    const selectedStation = document.querySelector('#stationDataList')

    button.addEventListener('click', async () => {
        button.setAttribute('disabled', null)

        // Find the station.
        const station = JSON.parse(document.querySelector('#stations').value)
            .find((station) => station.displayName === selectedStation.value)

        // Validate the input.
        if (!station) {
            selectedStation.classList.add('is-invalid')
            button.removeAttribute('disabled')
            return document.querySelector('#datalistError').classList.remove('hidden')
        }

        // Add to analytics
        const stationId = station.id
        await fetch('http://localhost:8000/api/stationsearch', {
            method: 'POST',
            body: JSON.stringify({ 'station_id': stationId, 'userAgent': window.navigator.userAgent }),
            headers: { 'Content-type': 'application/json; charset=UTF-8' }
        })

        const stops = []
        for (const line of station.lines) {
            const stationResults = await Promise.all((await (await fetch(`http://localhost:8000/api/station/${line.stringId}`)).json())
                .resposta.map((result) => ({ ...result, line }))
                .map(async (result) => ({
                    ...result, destinationInfo: (await ((await fetch(`http://localhost:8000/api/destination/${result.destino}`)).json()))
                })
                ))

            stops.push(...stationResults.filter((result) => result.stop_id === station.stringId))
        }

        // Show the result.
        const stationInfo = document.querySelector('#station-info')
        stationInfo.querySelector('.card-header').innerHTML = 'Informações para <b>' + station.displayName + '</b>'

        const cardText = stationInfo.querySelector('.card-text')
        cardText.innerHTML = ''

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
                cardText.append(previousLineCol)
            }

            // Display stop info.
            const info = document.createElement('p')
            info.innerHTML += `Sentido <b>${stop.destinationInfo.displayName}</b><br>`
            const minutes = stop.tempoChegada1 / 60
            info.innerHTML += `Tempo de chegada: <b>${Math.floor(minutes)}</b> min e <b>${Math.floor((minutes % 1) * 60)}</b> seg<br>`
            info.innerHTML += `Comboio: <b>${stop.comboio}</b>`

            previousLineCol.append(info)
        }

        stationInfo.classList.remove('hidden')

        button.removeAttribute('disabled')
    })

    selectedStation.addEventListener('input', () => {
        selectedStation.classList.remove('is-invalid')
        document.querySelector('#datalistError').classList.add('hidden')
    })

    selectedStation.addEventListener('keyup', (e) => {
        // Programmatically click the button.
        if (e.key === 'Enter') {
            button.click()
        }
    })
}
