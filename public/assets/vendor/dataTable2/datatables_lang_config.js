const languageConfig = {
    search: "Recherche:",
    lengthMenu: "Afficher _MENU_ entrées",
    info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
    infoEmpty: "Affichage de 0 à 0 sur 0 entrée",
    paginate: {
        previous: "Précédent",
        next: "Suivant"
    },
    zeroRecords: "Aucune donnée trouvée",
    emptyTable: "Aucune donnée disponible dans le tableau",
    loadingRecords: "Chargement..."
};

const dataTableConfig = {
    //autoWidth: true,
    //scrollX: true,
    paging: true,
    language: languageConfig,
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, 'All']
    ],
};
