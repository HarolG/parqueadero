$(document).ready(function () {

  inicio('primeraCarga')

  $('#formZonas').submit(function (e) {
    e.preventDefault();

    inicio('otrasCargas')

  });

  function inicio(activador) {

    if(activador == 'primeraCarga') {
      var idZona = 1;
    } else {
      var idZona = $('#zona').val()
    }

    $.post("php/graficas.php", {
        idZona
      },
      function (response) {
        const tasks = JSON.parse(response);
        let template = '';

        tasks.forEach(element => {

          var data = [{
            values: [element.cupos_disponibles, element.cupos_ocupados],
            labels: ['Disponible', 'Ocupado'],
            type: 'pie'
          }];

          var layout = {
            title: `Porcentaje de Cupos Disponibles Zona ${element.id_zona}`,
          };

          Plotly.newPlot('graficaHistoria', data, layout);

          template += `
          <p>Tipo de zona: ${element.nom_tip_zona}</p>
          <p>Estado: ${element.nom_estado}</p>
          <p>Cupos Libres: ${element.cupos_disponibles}</p>
          <p>Total Cupos: ${element.cupos_totales}</p>
          `
        });

        $('#informacion_zona').html(template);
      }
    );
  }

});