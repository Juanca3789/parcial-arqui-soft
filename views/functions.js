const form = document.getElementById("inscripcion");
form.onsubmit = (e) => {
    e.preventDefault()
    test()
    sendformquery()
}

async function sendformquery(){
    try {
        const data = new FormData(form)
        let resp = await fetch(
            "http://localhost/parcial-arq-software/controllers/enviarInscripcion.php",
            {
                method: "POST",
                mode: "cors",
                cache: "no-cache",
                body: data,
            }
        )
        json = await resp.json()
        if (json.success) {
            window.alert("✅ Éxito:", json.success);
            window.location.reload();
        } else if (json.error) {
            window.alert("❌ Error:", json.error, "\nRevisa la información y vuelve a intentarlo");
        } else {
            window.alert("⚠ Respuesta inesperada:", json);
        }
    } catch (error) {
        console.log(error)
    }
}

function test() {
    var verificar = new FormData(document.querySelector('form'));
    var ya1 = 0;
    var ya2 = 0;
    var ya3 = 0;
    if ($('#practica1').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica2').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica3').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica4').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica5').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica6').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica7').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica8').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica9').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica10').prop('checked')) {
        ya1 = 1;
    }
    if ($('#practica11').prop('checked')) {
        ya1 = 1;
    }

    if ($('#tipo_actividad1').prop('checked')) {
        ya2 = 1;
    }
    if ($('#tipo_actividad2').prop('checked')) {
        ya2 = 1;
    }
    if ($('#tipo_actividad3').prop('checked')) {
        ya2 = 1;
    }
    if ($('#tipo_actividad4').prop('checked')) {
        ya2 = 1;
    }
    if (ya1 == 0) {
        $('#practica_error').show();
        $('#practica1').focus();
    } else {
        $('#practica_error').hide();
        ya3 = 1;
    }
    if (ya2 == 0) {
        $('#tip_error').show();
        $('#tipo_actividad1').focus();
    } else {
        $('#tip_error').hide();
        ya3 += 1;
    }
    if (ya3 == 2) {
        $('#boton_enviar').click();
    }
    return false;
}

function countChars(obj) {
    document.getElementById("cuantos_va").innerHTML = 'Van ' + obj.value.length + ' de 600 máximo';
}

