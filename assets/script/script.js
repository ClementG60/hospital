function updateInfo() {
    infoPatient.className = "hide"
    updateInfoPatient.classList.remove("hide")
    updateInfoPatient.className = "display"
}

function closeUpdateInfo() {
    infoPatient.classList.remove("hide")
    infoPatient.className = "display"
    updateInfoPatient.classList.remove("display")
    updateInfoPatient.className = "hide"
}
