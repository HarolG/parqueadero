var trace1 = {
  x: ["6:30", "7:00", "7:30", "8:00", "8:30", "9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00"],
  y: [5, 10, 40, 30, 25, 25],
  mode: 'markers+lines',
  name: 'Carros',
  marker: {
    color: 'rgb(164, 194, 244)',
    size: 12,
    line: {
      color: 'white',
      width: 0.5
    }
  },
  type: 'scatter'
};

var trace2 = {
  x: ["6:30", "7:00", "7:30", "8:00", "8:30", "9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00"],
  y: [10, 20, 30, 40, 27, 19, 49, 44, 38],
  mode: 'markers+lines',
  name: 'Motos',
  marker: {
    color: 'rgb(255, 217, 102)',
    size: 12
  },
  type: 'scatter'
};

var data = [trace1, trace2];

var layout = {
  title: 'Actividad de Entradas al Parqueadero',
  xaxis: {
    title: 'Hora de entrada',
    showgrid: false,
    zeroline: false
  },
  yaxis: {
    title: 'Cantidad',
    showline: false
  }
};

Plotly.newPlot('graficaHistoria', data, layout);

  