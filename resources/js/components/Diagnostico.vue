<template>
    <!-- The Modal -->
    <div class="modal " :class="{ 'mostrar': modalShowMsg }">
        <div class="modal-dialog  modal-dialog-centered modal-sm">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">CompuActual dice: </h4>
                    <button type="button" class="close" @click="closeModalMsg">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    {{ modalMsg }}

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" @click="closeModalMsg">
                        Vale
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center  ">
        <div class="col-md-12">
            <div class="card text-center h-800 ">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a :class="{ 'nav-link active': card.caracteristicas, 'nav-link': 1 }"
                                @click="mostrar_div('C')">
                                Características</a>
                        </li>
                        <li class="nav-item">
                            <a :class="{ 'nav-link active': card.hallazgo, 'nav-link': 1 }"
                                @click="mostrar_div('H')">Hallazgos</a>
                        </li>
                        <li class="nav-item">
                            <a :class="{ 'nav-link active': card.diagnostico, 'nav-link': 1 }"
                                @click="mostrar_div('D')">Diagnósticos</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body" v-show="card.caracteristicas">
                    <div class="container">
                        <h3 class="card-title">Características reales de {{ equipo.nombre }} </h3>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-floating">
                                    
                                    <textarea class="form-control" style="height: 250px"
                                        v-model="equipo.caracteristicas"></textarea>

                                </div>
                            </div>
                            <br>


                        </div>

                        <div class=" row">
                            <div class="form-group col-md-2"></div>
                            <div class="form-group col-md-4 d-grid gap-2">
                                <button type="button" name="" id="" class="btn btn-success btn-block"
                                    @click="guardarCaracteristicas">Guardar
                                    características</button>
                            </div>
                            <div class="form-group col-md-4 d-grid gap-2">
                                <button type="submit" class="btn btn-primary  btn-block"
                                    @click="mostrar_div('H')">Siguiente</button>
                            </div>
                            <div class="form-group col-md-2"></div>
                        </div>
                    </div>

                </div>

                <div class="card-body" v-show="card.hallazgo">
                    <h3 class="card-title">Hallazgos</h3>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <h5 class="card-header" v-if="!modeEdit">Nuevo hallazgo</h5>
                                <h5 class="card-header" v-else>Editar hallazgo</h5>

                                <div class="card-body">
                                    <form @submit.prevent="guardarHallazgo()">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required
                                                    v-model="hallazgo.nombre">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputState">Tipo de servicio</label>
                                                <select id="inputState" class="form-control" v-model="hallazgo.tipo">
                                                    <option value="Hardware" selected>Hardware</option>
                                                    <option value="Software">Software</option>
                                                    <option value="Ambos">Ambos</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress2">Descripción del hallazgo</label>
                                            <textarea class="form-control" id="exampleTextarea" rows="5"
                                                v-model="hallazgo.descripcion"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4"></div>
                                            <div class="form-group col-md-4 mt-4">
                                                <button type="submit" class="btn btn-primary ">Guardar</button>
                                                &nbsp;
                                                <button class="btn btn-secondary" v-show="modeEdit"
                                                    @click="cancelarHallazgo()">Cancelar</button>
                                            </div>
                                            <div class="form-group col-md-4"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card">
                                <h5 class="card-header">Total de hallazgos: {{ hallazgos.length }} </h5>
                                <div class="card-body">
                                    <div class="table-wrapper">
                                        <table class="table table-striped table-sm ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Editar|Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(hallazgo, index) in hallazgos" :key="index">

                                                    <td>{{ hallazgo.nombre }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm "
                                                            @click="verHallazgo(hallazgo.id)">
                                                            Editar</button> &nbsp;
                                                        <button type="button" class="btn btn-danger btn-sm "
                                                            @click="eliminarHallazgo(hallazgo.id)">
                                                            Eliminar</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row mt-4">
                            <div class="form-group col-md-4"></div>
                            <div class="form-group col-md-4 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg btn-block"
                                    @click="mostrar_div('D')">Siguiente</button>
                            </div>
                            <div class="form-group col-md-4"></div>
                        </div>
                    </div>

                </div>

                <div class="card-body" v-show="card.diagnostico">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Hallazgos </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-wrapper">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Diagnósticos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(hallazgo, index) in hallazgos" :key="index">
                                                    <td>{{ index + 1 }} </td>
                                                    <td>{{ hallazgo.nombre }} </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm "
                                                            @click="cargarDiagnosticos(hallazgo.id)">
                                                            Mis diagnosticos</button> &nbsp;

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row" v-if="diagnosticos.length !== 0">
                                        <div class="col-md-9">
                                            <h5 class="card-title"><span class="dot"></span>Diagnósticos para : {{
                                                diagnosticos.nombre }} <span class="dot"></span>Total: {{
        diagnosticos.diagnosticos.length }} </h5>


                                        </div>
                                        <div class="col-md-3">

                                            <button type="button" class="btn btn-primary" @click="abrirModal"
                                                :disabled="diagnosticos.diagnosticos.length >= 3">
                                                Nuevo diagnóstico
                                            </button>
                                        </div>

                                    </div>
                                    <div class="row" v-else>
                                        <div class="col-md-12">
                                            <h5 class="card-title">Diagnósticos</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" v-if="diagnosticos.length !== 0">
                                    <div class="row table-wrapper">
                                        <div v-if="!(diagnosticos.diagnosticos.length === 0)">
                                            <div class="col-md-12" v-for="(item, index) in diagnosticos.diagnosticos"
                                                :key="index">
                                                <div class="row p-2 m-2  bg-white border rounded  ">
                                                    <div class="col-md-3 mt-1"><img
                                                            class="img-fluid img-responsive rounded product-image"
                                                            :src="getImage(item.foto_pieza)"></div>
                                                    <div class="col-md-6 mt-1 ">
                                                        <h5> {{ item.nombre }} </h5>

                                                        <div class="mt-1 mb-1 spec-1">
                                                            <span class="dot"></span>
                                                            <span>Recomendación: {{ recomendacion(item.ponderacion)
                                                            }}</span> <br>
                                                            <span class="dot"></span>
                                                            <span>Tiempo de instalación: {{ item.tiempo_instalacion
                                                            }}</span>
                                                        </div>

                                                        <p class="text-justify "> {{ item.descripcion.split(' '
                                                        ).slice(0, 13).join(' ') }}</p>

                                                    </div>
                                                    <div
                                                        class="align-items-center align-content-center col-md-3 border-left mt-1">
                                                        <div class=" align-items-center">
                                                            <h4 class="mr-1"> ${{ item.costo }}</h4>
                                                        </div>

                                                        <div class="d-flex flex-column mt-4">
                                                            <button class="btn btn-primary btn-sm" type="button"
                                                                @click="verDiagnostico(item.id)">Editar</button>
                                                            <button class="btn btn-outline-danger btn-sm mt-2" type="button"
                                                                @click="eliminarDiagnostico(item.id)">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12" v-else>
                                            <div class="alert alert-danger" role="alert">
                                                ¡Hallazgo sin diagnósticos!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" v-else>
                                    <div class="alert alert-danger" role="alert">
                                        ¡Selecciona un hallazgo!
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal" :class="{ 'mostrar': modalDiagnostico }">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ modalDiagnosticoTitle }}</h5>
                    <button type="button" class="close" @click="cerrarModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-wrapper">
                    <form @submit.prevent="guardarDiagnostico">


                        <div class="row">
                            <div class="row" v-if="modeEditDiag">
                                <div class="form-group col-md-6">
                                    <div class="col-md-12 text-center"><img
                                            class="img-fluid img-responsive rounded w-50 h-50"
                                            :src="getImage(diagnostico.foto)"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="F">Subir foto</label>
                                    <input type="file" class="form-control" id="foto" ref="foto" name="foto"
                                        accept="image/*" @change="cargarFoto">
                                </div>
                            </div>
                            <div class="form-group col-md-4" v-else>
                                <label for="F">Subir foto</label>
                                <input type="file" class="form-control" id="foto" ref="foto" name="foto" accept="image/*"
                                    required @change="cargarFoto">
                            </div>
                            <div :class="{ 'form-group col-md-6': modeEditDiag, 'form-group col-md-4': 1 }">
                                <label for="costo">Recomendación</label>

                                <select id="inputState" class="form-control" v-model="diagnostico.ponderacion">
                                    <option value="1" selected>Exelente</option>
                                    <option value="2">Bueno</option>
                                    <option value="3">Regular</option>
                                </select>
                            </div>
                            <div :class="{ 'form-group col-md-6': modeEditDiag, 'form-group col-md-4': 1 }">
                                <label for="costo">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" v-model="diagnostico.nombre"
                                    required>
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="costo">Costo</label>
                                <input type="number" class="form-control" id="costo" name="costo"
                                    v-model="diagnostico.costo" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Tiempo de instalación</label>
                                <input type="text" class="form-control" id="instalacion" name="instalacion"
                                    v-model="diagnostico.tiempo" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">Descripción del diagnóstico</label>
                            <textarea class="form-control" id="exampleTextarea" rows="4" v-model="diagnostico.descripcion"
                                required></textarea>
                        </div>

                        <div class="row text-center">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                &nbsp;
                                <button type="button" class="btn btn-danger" @click="cerrarModal">Cancelar</button>
                            </div>

                        </div>

                    </form>

                </div>
                <div class="modal-footer">


                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        proyecto_id: {
        type: Number,
      },
    },
    mounted() {
    },
    data() {
        return {
            //Variables para Modal
            modalMsg: "",
            modalShowMsg: 0,
            modalDiagnostico: false,
            modalDiagnosticoTitle: "Nuevo diagnóstico",

            //
            id_hallazgo: 0,
            foto: null,
            //Variables para las caracteristicas reales 
            modeEqipo: 0,
            equipo: {
                id: 0,
                nombre: "",
                caracteristicas: null
            },
            //Variables para el formulario de Diagnostico
            diagnosticos: [],
            diagnostico: {
                id: 0,
                nombre: "",
                ponderacion: 1,
                costo: 0,
                foto: null,
                tiempo: "",
                descripcion: "",
            },
            //Variables para el formulario de hallazgo
            hallazgos: [],
            modeEdit: false,
            modeEditDiag: false,
            hallazgo: {
                id: 0,
                idProyecto: 0,
                nombre: "",
                descripcion: "",
                tipo: 'Hardware'
            },
            card: {
                caracteristicas: true,
                hallazgo: false,
                diagnostico: false,
                calse_activo: 1,
            }

        }
    },

    created() {
        this.hallazgo.idProyecto = this.proyecto_id//
        //console.log( document.getElementById('myId'));

        this.cargarHallazgos();
        this.cargarCaracteristicas();
    },

    methods: {
        openModalMsg(msg) {
            this.modalShowMsg = 1
            this.modalMsg = msg
        },
        closeModalMsg() {
            this.modalShowMsg = 0
            this.modalMsg = ""
        },
        abrirModal() {
            this.modalDiagnostico = true
        },
        cerrarModal() {
            this.modalDiagnostico = false
            this.limpiarForm()
            this.modeEditDiag = 0
            this.modalDiagnosticoTitle = "Nuevo Diagnóstico"
        },
        mostrar_div(etapa) {
            switch (etapa) {
                case 'C':
                    this.card.caracteristicas = 1
                    this.card.hallazgo = 0
                    this.card.diagnostico = 0

                    break;

                case 'H':
                    this.card.caracteristicas = 0
                    this.card.hallazgo = 1
                    this.card.diagnostico = 0

                    break;
                case 'D':
                    this.card.caracteristicas = 0
                    this.card.hallazgo = 0
                    this.card.diagnostico = 1

                    break;

                default:
                    break;
            }
        },
        recomendacion(val) {
            let msg = ""
            switch (val) {

                case '1':
                    msg = "Exelente"
                    break;
                case '2':
                    msg = "Bueno"
                    break;
                case '3':
                    msg = "Regular"
                    break;

                default:
                    msg = "Error"
                    break;
            }
            return msg
        },
        cargarHallazgos() {
            axios.get('/api/hallazgos/' + this.hallazgo.idProyecto)
                .then(res => {
                    this.hallazgos = res.data
                })
        },
        //Cargar las caracteristicas reales
        cargarCaracteristicas() {
            axios.get('/api/equipo/' + this.hallazgo.idProyecto)
                .then(res => {
                    this.equipo.caracteristicas = res.data.caracteristicas_reales ? res.data.caracteristicas_reales : "Sin caracteristicas";
                    this.equipo.nombre = res.data.nombre;
                    this.equipo.id = res.data.id;

                    //console.log(res.data)
                })
        },
        guardarCaracteristicas() {

            axios.put('/api/equipo/' + this.equipo.id, this.equipo)
                .then(res => {
                    //console.log(res.data);
                    this.openModalMsg('Se guardaron correctamente las características del equipo  ' + res.data.nombre)
                    //this.cargarCaracteristicas();
                })

        },

        //Guardar Actualizar caracteristicas

        /**
         * 
         * /////////////////////////////////////////////////////////////////////////////////////////////////////////
         * 
         */
        /**
         * Guarda o actualiza el hallazgo
         */
        guardarHallazgo() {
            if (this.hallazgo.nombre !== "" && this.hallazgo.descripcion !== "") {
                const hallazgo = {
                    idProyecto: this.hallazgo.idProyecto,
                    nombre: this.hallazgo.nombre,
                    descripcion: this.hallazgo.descripcion,
                    tipo: this.hallazgo.tipo

                }
                if (!this.modeEdit) {
                    axios.post('/api/hallazgos/', hallazgo)
                        .then(res => {
                            this.cargarHallazgos()
                            this.limpiarCampos()
                            this.openModalMsg('Hallazgo guardado')
                        })
                } else {
                    axios.put('/api/hallazgos/' + this.hallazgo.id, hallazgo)
                        .then(res => {
                            this.cargarHallazgos()
                            this.limpiarCampos()
                            this.modeEdit = false
                            this.openModalMsg('El hallazgo ha sido modificado')
                        })
                }

            }
        },
        /**
         * Eliminar El hallazgo
         */
        eliminarHallazgo(id) {
            axios.delete('/api/hallazgos/' + id)
                .then(res => {
                    if (res.status === 200) {
                        this.cargarHallazgos();
                        this.openModalMsg('Se ha elimindo el hallazgo')
                    }
                })
        },
        /**Limpia los campos del objeto */
        limpiarCampos() {
            this.hallazgo.nombre = ""
            this.hallazgo.descripcion = ""
            this.hallazgo.id = 0
            this.hallazgo.tipo = "Hardware"

        },
        /**Carga el formulario el hallazgo seleccionado */
        verHallazgo(id) {
            axios.get(`/api/hallazgos/${id}/edit`)
                .then(res => {
                    this.hallazgo.nombre = res.data.nombre
                    this.hallazgo.id = res.data.id
                    this.hallazgo.descripcion = res.data.descripcion
                    this.hallazgo.tipo = res.data.tipo
                    this.hallazgo.idProyecto = res.data.proyecto_id
                    this.modeEdit = true
                })
        },
        cancelarHallazgo() {
            this.limpiarCampos()
            this.modeEdit = false
        },
        /** * /////////////////////////////////////////////////////////////////////////////////////////////////////////*/

        //Limpiar Formulario para diagnostico
        limpiarForm() {
            this.diagnostico.ponderacion = 1
            this.diagnostico.costo = 0
            this.diagnostico.foto = null
            this.diagnostico.tiempo = ""
            this.diagnostico.descripcion = ""
            this.foto = null
            this.$refs.foto.value = null
            this.diagnostico.nombre = ""
        },
        //Cargar la foto 
        cargarFoto(e) {
            this.foto = this.$refs.foto.files[0];
        },
        // Obtener la url de la imagen
        getImage(fileName) {
            return '/api/diagnostico/image/' + fileName;
        },

        guardarDiagnostico() {

            const formData = new FormData()

            formData.append('hallazgo_id', this.id_hallazgo)
            formData.append('costo', this.diagnostico.costo)
            formData.append('foto_pieza', this.$refs.foto.files[0])
            formData.append('descripcion', this.diagnostico.descripcion)
            formData.append('ponderacion', this.diagnostico.ponderacion)
            formData.append('tiempo_instalacion', this.diagnostico.tiempo)
            formData.append('nombre', this.diagnostico.nombre)

            if (!this.modeEditDiag) {
                //console.log(formData);
                axios.post('/api/diagnostico', formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                }).then(res => {
                    this.limpiarForm()
                    this.cargarDiagnosticos(this.id_hallazgo)
                    this.modalDiagnostico = false
                    this.openModalMsg('Diagnóstico guardado')

                });
            } else {

                //console.log(this.diagnostico.descripcion);
                axios.post('/api/diagnostico/' + this.diagnostico.id,
                    formData,
                )
                    .then(res => {
                        //console.log(res);
                        this.limpiarForm()
                        this.cargarDiagnosticos(this.id_hallazgo)
                        this.modalDiagnostico = false
                        this.modeEditDiag = 0
                        this.openModalMsg('El diagnóstico ha sido modificado')
                    })
            }

            // console.log(formData);
        },
        cargarDiagnosticos(id) {
            this.id_hallazgo = id;
            axios.get('/api/diagnostico/' + id)
                .then(res => {
                    this.diagnosticos = res.data.hallazgo
                    //console.log(res.data.hallazgo);
                })
        },
        eliminarDiagnostico(id) {
            axios.delete('/api/diagnostico/' + id)
                .then(res => {
                    //console.log(res);
                    this.cargarDiagnosticos(this.id_hallazgo)
                    this.openModalMsg('Se ha eliminado el diagnóstico')
                })
        },
        verDiagnostico(id) {
            axios.get(`/api/diagnostico/${id}/edit`)
                .then(res => {
                    //console.log(res.data);
                    const data = res.data;
                    this.modalDiagnosticoTitle = "Editar a: " + data.nombre
                    this.modeEditDiag = 1

                    this.abrirModal()
                    this.diagnostico.nombre = data.nombre
                    this.diagnostico.id = data.id
                    this.diagnostico.ponderacion = data.ponderacion
                    this.diagnostico.costo = data.costo
                    this.diagnostico.foto = data.foto_pieza
                    this.diagnostico.tiempo = data.tiempo_instalacion
                    this.diagnostico.descripcion = data.descripcion


                })
        },

    }
}
</script>


<style>
.table-wrapper {
    max-height: 323px;
    overflow-y: scroll;
}

.form-wrapper {
    max-height: 490px;
    overflow-y: scroll;
}

.fondo {
    background: #cdf8dd
}


.product-image {
    width: 100%
}

.dot {
    height: 7px;
    width: 7px;
    margin-left: 25px;
    margin-right: 6px;
    margin-top: 5px;
    background-color: blue;
    border-radius: 50%;
    display: inline-block
}

.spec-1 {
    color: hsl(0, 5%, 55%);
    font-size: 17px
}

h5 {
    font-weight: 400
}

.para {
    font-size: 16px
}

.mostrar {
    display: list-item;
    opacity: 1;
    background: rgba(44, 38, 75, 0.849);
}
</style>
