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
            //Esto es para el porcentaje
            values: [element.cupos_disponibles, element.cupos_ocupados],
            //Esto es para las categorias de la gráfica
            labels: ['Disponible', 'Ocupado'],
            //El tipo de gráfica
            type: 'pie'
          }];

          //El Titulo de la gráfica
          var layout = {
            title: `Porcentaje de Cupos Disponibles Zona ${element.id_zona}`,
          };

          //Aquí meto la gráfica en el div graficaHistoria
          Plotly.newPlot('graficaHistoria', data, layout);

          //Esto es lo que sale a la derecha de la gráfica, la otra información
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