<template>
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card lead">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            Proyecto de {{ cliente }}
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"> Folio: {{ proyecto ? proyecto.folio : "" }}</div>
                    </div>
                </div>
                
                <div class="card-body ">
                    
                    <div class="row p-3">
                        <div class="col-md-12 ">
                            <div class="card">
                                <div class="card-header">
                                    Proyecto
                                </div>
                                <div class="card-body">
                                    <div class="row border-top border-dark">
                                        <div class="col-md-6 text-center">
                                            <p>Fecha que se recibió el equipo: <span class="text-primary">{{ proyecto ?
                                                proyecto.fecha_recibido : "" }}</span></p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <p>Fecha que se entregó el equipo: <span class="text-primary">{{

                                                proyecto ? (proyecto.fecha_entregado ? proyecto.fecha_entregado :
                                                    fecha) : "Hoy" }}</span></p>
                                        </div>

                                    </div>

                                    <div class="row border-top border-dark">
                                        <div class="col-md-6 text-center">
                                            <p>Costo que se estimo por la reparación: <span class="text-primary">{{ proyecto
                                                ? "$" + proyecto.costo_aprox : "" }}</span></p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <p>Costo final de la reparación: <span class="text-primary">{{ costoFin ?
                                                "$" + costoFin : "" }}</span></p>
                                        </div>

                                    </div>
                                    <div class="row border-top border-dark">
                                        <div class="col-md-2 text-center">

                                        </div>
                                        <div class="col-md-8 text-center">
                                            <h5>Descripción del problema:</h5>
                                            <p class="texto "> {{ proyecto ? proyecto.descripcion_problema : "" }}</p>
                                        </div>
                                        <div class="col-md-2 text-center">

                                        </div>

                                    </div>
                                    <div class="row border-top border-dark">
                                        <div class="col-md-6 text-center">
                                            <p>Tipo de servico: <span class="text-primary">{{ proyecto ?
                                                proyecto.tipo_servicio : "" }}</span></p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <p>Técnico: <span class="text-primary">{{ tecnico ? tecnico : "" }}</span></p>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Equipo-->
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    Equipo {{ equipo ? equipo.nombre : "" }}
                                </div>
                                <div class="card-body ">
                                    <div class="row border-top border-dark">
                                        <div class="col-md-6 text-center">
                                            <h5>Características posibles:</h5>
                                            <p class="texto "> {{ equipo ? equipo.caracteristicas_posibles : "" }}</p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <h5>Características reales:</h5>
                                            <p class="texto "> {{ equipo ? equipo.caracteristicas_reales : "" }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fin  Equipo-->
                    </div>

                    <div class="row p-3">
                        <!--hallazgos-->
                        <div class="col-md-12 ">
                            <div class="card">
                                <div class="card-header">
                                    Total de hallazgos: {{ hallazgos.length }}

                                </div>
                                <div class="card-body wrapper">
                                    <div class="">

                                        <div class="row row-cols-1 row-cols-md-2 g-4">
                                            <div v-for="(hallazgo, i ) in hallazgos" :key="i">
                                                <div class="card border-primary ">

                                                    <button class="btn btn-primary btn-block" type="button"
                                                        data-bs-toggle="collapse"
                                                        v-bind:data-bs-target="'#hallazgo_' + hallazgo.id"
                                                        aria-expanded="false" aria-controls="collapseExample">
                                                        {{ hallazgo.nombre }}
                                                    </button>

                                                    <div class="card-body  collapse" v-bind:id="'hallazgo_' + hallazgo.id">
                                                        <h5 class="card-title text-center ">
                                                            <span>
                                                                Tipo :
                                                            </span>
                                                            <span class="text-success">
                                                                {{ hallazgo.tipo }}
                                                            </span>
                                                        </h5>

                                                        <div class="texto lead text-center">
                                                            <h5 class="">Descripción del hallazgo</h5>
                                                            <p class="card-text text-justify"> {{ hallazgo.descripcion }}
                                                            </p>
                                                        </div>



                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fin hallazgos-->
                        <div class="col-md-12 mt-3 ">
                            <div class="card">
                                <div class="card-header">
                                    Diagnósticos autorizados: {{ diagnosticos.length }}
                                </div>
                                <div class="card-body wrapper">
                                    <div class="row">
                                        <div class="col-md-6" v-for="(item, index) in diagnosticos" :key="index">
                                            <div class="row p-2 m-2  bg-white border rounded  ">
                                                <div class="col-md-3 mt-1"><img
                                                        class="img-fluid img-responsive rounded product-image"
                                                        :src="getImage(item.foto_pieza, 2)"></div>
                                                <div class="col-md-6 mt-1 ">
                                                    <h5 class="text-justify spec-1">

                                                        Calidad: <span :class="recomendacion(item.ponderacion).clase">{{
                                                            recomendacion(item.ponderacion).msg }}</span>

                                                    </h5>
                                                    <p class="text-justify text-primary lead"> {{ item.nombre }}</p>
                                                    <p class="text-justify texto"> {{ item.descripcion }}</p>

                                                </div>
                                                <div
                                                    class="align-items-center align-content-center col-md-3 border-left mt-1">
                                                    <div class="align-items-center">
                                                        <p class="text-success">

                                                            <span>Costo: ${{ item.costo }}</span>
                                                        </p>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    Reparaciones
                                </div>
                                <div class="card-body">
                                    <div class="wrapper">
                                        <div class="row">
                                            <div class="col-md-3 mt-1" v-for="img in imagenesBD" :key="i">
                                                <img :src="getImage(img.image)" class="img-thumbnail m-2  "
                                                    alt="reparacion">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--fin hallazgos-->
                    <div class="row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        proyecto_id_p: {
            type: Number,
        },
    },
    mounted() {
    },
    data() {
        return {
            imagenesBD: [],
            proyecto_id: 0,
            diagnosticos: [],
            hallazgos: [],
            proyecto: null,
            costoFin: 0,
            equipo: null,
            cliente: "",
            tecnico: "",
            fecha: ""

        }
    },
    created() {
        this.proyecto_id = this.proyecto_id_p
        this.cargarProyecto()
        this.cargarImg()
    },

    methods: {
        cargarProyecto() {
            axios.get('/api/proyecto/fin/' + this.proyecto_id)
                .then(res => {
                    //console.log(res.data);
                    this.proyecto = res.data.proyecto
                    this.equipo = this.proyecto.equipo
                    this.hallazgos = this.proyecto.hallazgos
                    this.diagnosticos = this.proyecto.diagnosticos
                    this.cliente = res.data.cliente
                    this.tecnico = res.data.trabajador
                    this.costoFin = res.data.costo
                    this.fecha = res.data.fecha
                    console.log(this.diagnosticos);

                })
        },
        cargarImg() {
            axios.get('/api/reparacion/' + this.proyecto_id)
                .then(res => {
                    this.imagenesBD = res.data
                    //console.log(res.data);
                    //console.log(res.data.hallazgo);
                })
        },
        getImage(fileName, opc = 1) {
            if (opc == 1) {
                return '/api/reparacion/image/' + fileName;
            } else {
                return '/api/diagnostico/image/' + fileName;
            }

        },

        recomendacion(val) {
            let msg, clase = ""
            switch (val) {

                case '1':
                    msg = "Exelente"
                    clase = "text-success"
                    break;
                case '2':
                    msg = "Bueno"
                    clase = "text-warning"
                    break;
                case '3':
                    msg = "Regular"
                    clase = "text-secondary"
                    break;

                default:
                    msg = "Error"
                    break;
            }
            return { msg, clase }
        },

    }

}
</script>

<style>
.texto {
    max-height: 150px;
    height: 200px;
    overflow-y: scroll;
}

.wrapper {
    max-height: 300px;
    height: 480px;
    overflow-y: scroll;
}
</style>