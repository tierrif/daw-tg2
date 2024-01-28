window.onload = async () => {
    const balanceModal = document.getElementById('balanceModal')
    const balanceBtn = document.getElementById('plusBalance')

    balanceModal.addEventListener('shown.bs.modal', () => {
        balanceBtn.focus()
    })
}
