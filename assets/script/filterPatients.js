search.addEventListener("input",function(){
    let value = this.value
    //On instancie l'objet XMLHttpRequest pour faire de l'AJAX
    let xhr = new XMLHttpRequest()
    //On ouvre une connexion en post vers le controller
    xhr.open("POST", "controllers/controllerListPatient.php", true)
    //On oublie pas ça sinon le controller ne recevera rien
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    //On spécifie les données à envoyer
    xhr.send("search="  + value) // $_POST['search'] = value
    //On attend une réponse du controller
    xhr.onreadystatechange = function () {
        //Si on a reçu une réponse et qu'elle est positive
        if (xhr.readyState == 4 && xhr.status == 200) {
            //On récupère un json
            const jsonPatient = xhr.responseText
            //On le parse pour pouvoir le parcourir
            const jsonPatientArray = JSON.parse(jsonPatient)
            //On vide la liste déroulante            
            patientList.innerText = ""
            //On parcours le JSON
            jsonPatientArray.map((patientSelect)=>{
                //On selectionne la liste déroulante
                patientList = document.getElementById("patientList")
                //On crée une balise option virtuel
                let div = document.createElement("div")
                let ul = document.createElement("ul")
                let li1 = document.createElement("li")
                let li2 = document.createElement("li")
                let a = document.createElement("a")
                let li3 = document.createElement("li")
                let form = document.createElement("form")
                let input1 = document.createElement("input")
                let input2 = document.createElement("input")
                let option = document.createElement("option")
                //On lui donne un nom
                li1.innerText = patientSelect.name
                a.innerText = "Afficher le profil complet du patient"
                a.href= "profilPatients.php?id=" + patientSelect.value
                form.method = "POST"
                input1.type = "hidden"
                input2.type = "submit"
                input1.name = "patientId"
                input2.name = "deletePatient"
                input1.value = patientSelect.value
                input2.value = "Supprimer le client"

                //On l'attache à la liste déroulante
                form.append(input1, input2)
                li3.append(form)
                li2.append(a)
                ul.append(li1, li2, li3)
                div.append(ul)
                patientList.append(div)

            })
        }
    };
})
