$(document).ready(function () {

  inicio()

  function inicio() {

    let idZona = 1;

    $.post("php/graficas.php", {
        idZona
      },
      function (response) {
        const tasks = JSON.parse(response);
        let template = '';

        tasks.forEach(element => {
          let ocupados = element.cupos - element.cupos_live

          // Aquí se empieza a crear la gráfica
          var data = [{
            values: [element.cupos_live, ocupados],
            labels: ['Disponible', 'Ocupado'],
            type: 'pie'
          }];

          var layout = {
            title: `Porcentaje de Cupos Disponibles Zona ${element.id_zona}`,
            width: 500
          };

          Plotly.newPlot('graficaHistoria', data, layout);

          template += `
          <p>Tipo de zona: ${element.nom_tip_zona}</p>
          <p>Estado: ${element.nom_estado}</p>
          <p>Cupos Libres: ${element.cupos_live}</p>
          <p>Total Cupos: ${element.cupos}</p>
          `
        });

        $('#informacion_zona').html(template);

      }
    );
  }

  $('#formZonas').submit(function (e) {
    e.preventDefault();

    let idZona = $('#zona').val()

    $.post("php/graficas.php", {
        idZona
      },
      function (response) {
        const tasks = JSON.parse(response);
        let template = '';

        tasks.forEach(element => {

          let ocupados = element.cupos - element.cupos_live

          var data = [{
            values: [element.cupos_live, ocupados],
            labels: ['Disponible', 'Ocupado'],
            type: 'pie'
          }];

          var layout = {
            title: `Porcentaje de Cupos Disponibles Zona ${element.id_zona}`,
            width: 500
          };

          Plotly.newPlot('graficaHistoria', data, layout);

          template += `
          <p>Tipo de zona: ${element.nom_tip_zona}</p>
          <p>Estado: ${element.nom_estado}</p>
          <p>Cupos Libres: ${element.cupos_live}</p>
          <p>Total Cupos: ${element.cupos}</p>
          `
        });

        $('#informacion_zona').html(template);

      }
    );

  });
});