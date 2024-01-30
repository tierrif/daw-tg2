window.onload = async () => {
    // Add visit analytics
    let url = window.location.pathname.split('/')
    url = url[url.length - 1]
    if (url === '') {
        url = 'homepage'
    }

    await fetch('http://localhost:8000/api/websitevisitors', {
        method: 'POST',
        body: JSON.stringify({ url_visited: url, userAgent: window.navigator.userAgent }),
        headers: { 'Content-type': 'application/json; charset=UTF-8' }
    })
}
