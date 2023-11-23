//alert('delete-functions.js wurde geladen');
//document.addEventListener('DOMContentLoaded', function () {
    

    function deleteList(id) {
        // event.stopPropagation();
        alert('zuerst bestätigen');
        var bestaetigung = confirm("Sind Sie sicher, dass Sie diesen Post unwiderruflich löschen möchten?");

        // Überprüfen, ob der Benutzer auf "OK" geklickt hat
        if (bestaetigung) {  
            axios.post('/list_delete_function/'+id)
            .then(function(response){
            location.reload();
        })
            console.log("Post wurde gelöscht.");
        } else {
            console.log("Löschvorgang abgebrochen.");
        }

        // event.preventDefault();
        return false;
    }
//});
