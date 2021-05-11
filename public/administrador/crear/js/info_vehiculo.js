const formSearchVehiculo = document.getElementById("form_info_vehiculo")

formSearchVehiculo.addEventListener("submit", e => {
    e.preventDefault()

    let placaVehiculo = document.getElementById("search_vehiculo").value
    ajaxVehiculo(placaVehiculo)
})

function ajaxVehiculo(placa) {

    eliminarNodo("table_container")

    const url = "php/info_vehiculo.php";
    const placaVehiculo = placa

    const http = new XMLHttpRequest();

    http.open("POST", url)
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {

            const respuesta = JSON.parse(this.responseText)
            let template = '';
            
            respuesta.forEach(element => {
                template += `
                                <table>
                                    <thead>
                                        <th class="th_start">Placa</th>
                                        <th>Modelo</th>
                                        <th>Marca</th>
                                        <th>Tipo de Vehiculo</th>
                                        <th>Documento</th>
                                        <th>Color</th>
                                        <th class="th_end">Acciones</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>${element.placa}</td>
                                            <td>${element.modelo}</td>
                                            <td>${element.marca}</td>
                                            <td>${element.tipo_vehiculo}</td>
                                            <td class="documento">
                                                <a href="#">${element.documento}</a>
                                            </td>
                                            <td>${element.color}</td>
                                            <td>
                                                <a href="#" class="edit">Editar</a>
                                                <a href="#" class="delete">Eliminar</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="container_another_info">
                                    <div class="container_another_info-title">
                                    <p>OTRA INFORMACIÓN</p>
                                    </div>
                                    <div class="column_container_anotherInfo">
                                        <div class="column_anotherInfo">
                                            <img src="../../../img/moto.png" alt="Foto del vehiculo">
                                            <button>Cambiar Imagen</button>
                                        </div>
                                        <div class="column_anotherInfo">
                                            <div class="grupo_anotherInfo">
                                                <p>Soat</p>
                                                <a href="${element.soat}">Ver Soat</a> 
                                                <a href="#">Actualizar</a>
                                            </div>
                                            <div class="grupo_anotherInfo">
                                                <p>Tecnomecánica:</p>
                                                <a href="${element.tecnomecanica}">Ver Tecnomecánica</a>
                                                <a href="#">Actualizar</a> 
                                            </div>
                                            <div class="grupo_anotherInfo">
                                                <p>Anotaciones:</p>
                                                <p class="texto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni officiis sint, possimus sit harum hic dolores dignissimos perspiciatis itaque quo. Perspiciatis animi necessitatibus praesentium laborum deleniti aspernatur commodi voluptatum tenetur!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `
            });

            var elemento = document.createElement("div")
            elemento.innerHTML = template
            document.getElementById("table_container").appendChild(elemento)

        }
    }
    http.send(`placa=${placaVehiculo}`)

}

function eliminarNodo(id){
    //Si existe la caja o el div...
    var div = document.getElementById(id)
    if(div !== null){
        while (div.hasChildNodes()){
            div.removeChild(div.lastChild);
        }
    }else{
        alert ("No existe la caja previamente creada.");
    }
}