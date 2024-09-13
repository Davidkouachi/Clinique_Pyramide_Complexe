document.getElementById("btn_rech_num_dossier").addEventListener("click", function(event) {
    event.preventDefault(); // Empêcher le rechargement de la page si nécessaire

    // Créer l'élément de préchargement
    var preloader_ch = `
        <div id="preloader_ch">
            <div class="spinner_preloader_ch"></div>
        </div>
    `;

    // Ajouter le préchargeur au body
    document.body.insertAdjacentHTML('beforeend', preloader_ch);

    // Simuler une requête ou un délai (ajuste selon tes besoins)
    setTimeout(function() {
        // Retirer le préchargeur après 2 secondes (ou lorsque le processus est terminé)
        var preloader = document.getElementById('preloader_ch');
        if (preloader) {
            preloader.remove();
            document.getElementById('btn_rech_num_dossier').style.display = 'none';
            addGroup();
            document.getElementById('div_info_consul').style.display = 'block';
        }
    }, 2000); // Remplace 2000 par la durée de ton processus réel
});


function addGroup() {

        var groupe = document.createElement("div");
        groupe.className = "row gx-3 justify-content-center align-items-center";
        groupe.innerHTML = `
                                    <div class="col-12">
                                        <div class="card-header">
                                            <h5 class="card-title">Information du patient</h5>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input name="email" required type="email" class="form-control" id="email" placeholder="Email de l'assurance">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="tel">Contact</label>
                                            <input name="tel" required type="tel" class="form-control" id="tel" placeholder="Contact de l'assurance" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="tel2">Contact 2</label>
                                            <input name="tel2" required type="tel" class="form-control" id="tel2" placeholder="Contact de l'assurance" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="adresse">Adresse</label>
                                            <input required name="adresse" type="text" class="form-control" id="adresse" placeholder="Adresse de l'assurance">
                                        </div>
                                    </div>    
                `;

        document.getElementById("div_info_patient").appendChild(groupe);
    }