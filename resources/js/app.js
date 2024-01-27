import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap

import Alpine from 'alpinejs'

window.Alpine = Alpine;

Alpine.start();

window.onload = async () => {
    // Add line states to all lines.
    const { resposta: lines } = await (await fetch('http://localhost:8000/api/line')).json()
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

        const stops = []
        for (const line of station.lines) {
            const stationResults = await Promise.all((await (await fetch(`http://localhost:8000/api/station/${line.stringId}`)).json())
                .resposta.map((result) => ({ ...result, line }))
                .map(async (result) => ({
                    ...result, destinationName: (await ((await fetch(`http://localhost:8000/api/destination/${result.destination}`)).json()))
                })
            ))
            // TODO: add destination controller

            stops.push(...stationResults.filter((result) => result.stop_id === station.stringId))
        }

        console.log(stops)

        // Show the result.
        const stationInfo = document.querySelector('#station-info')
        stationInfo.querySelector('.card-header').innerHTML = 'Informações para <b>' + station.displayName + '</b>'

        const cardBody = stationInfo.querySelector('.card-body')
        stops.forEach((stop) => stop)

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
