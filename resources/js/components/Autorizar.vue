<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a :class="{ 'nav-link active ': card.hallazgo, 'nav-link': 1 }" @click="mostrar_div('H')">
                                Hallazgos
                                <span class="badge bg-secondary">
                                    {{ hallazgos.length }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a :class="{ 'nav-link active': card.diagnostico, 'nav-link': 1 }"
                                @click="mostrar_div('D')">Diagnósticos</a>
                        </li>
                        <li class="nav-item">
                            <a :class="{ 'nav-link active': card.carrito, 'nav-link': 1 }"
                                @click="mostrar_div('C')">Autorizados
                                <span class="badge bg-secondary">
                                    {{ list_item ? list_item.length : 0 }}
                                </span></a>
                        </li>
                    </ul>
                </div>
                <!-- Card body hallazgos-->
                <div class="card-body" v-show="card.hallazgo">
                    <div class="wrapper">
                        <h5 class="card-title text-dark text-center ">
                            Total de Hallazgos : {{ hallazgos.length }}
                        </h5>
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            <div v-for="(hallazgo, i ) in hallazgos" :key="i">
                                <div class="card border-primary ">

                                    <button class="btn btn-primary btn-block" type="button" data-bs-toggle="collapse"
                                        v-bind:data-bs-target="'#hallazgo_' + hallazgo.id" aria-expanded="false"
                                        aria-controls="collapseExample">
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
                                            <p class="card-text text-justify"> {{ hallazgo.descripcion }}</p>
                                        </div>

                                        <button type="button" class="btn btn-success btn-sm m-2"
                                            @click="cargarDiagnosticos(hallazgo.id)">Ver diagnósticos</button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- Card body diagnosticos-->
                <div class="card-body" v-show="card.diagnostico" style="background-color: #eee;">
                    <div class="wrapper">
                        <h5 class="card-title text-dark text-center ">
                            {{ diagnosticos.length + " diagnosticos para " + (hallazgo_solo ? hallazgo_solo.nombre : " ") }}
                        </h5>

                        <div class="product-content product-wrap clearfix" v-for="(item, i) in diagnosticos" :key="i">
                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="product-image">
                                        <img :src="getImage(item.foto_pieza)" alt="diagnostico" style="width: 100%"
                                            class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="product-deatil">
                                        <h5 class="text-center">

                                            {{ item.nombre }}

                                        </h5>
                                        <h5 class="text-justify">

                                            Instalado en: {{ item.tiempo_instalacion }}

                                        </h5>
                                        <h5 class="text-justify ">

                                            Recomendación: <span :class="recomendacion(item.ponderacion).clase">{{
                                                recomendacion(item.ponderacion).msg }}</span>

                                        </h5>
                                        <p class="price-container">
                                            <span>${{ item.costo }}</span>
                                        </p>
                                        <span class="tag1"></span>
                                    </div>
                                    <div class=" texto text-justify lead m-3">
                                        <h5 class="card-title text-center">
                                            Descripción
                                        </h5>
                                        <p>{{ item.descripcion }} </p>
                                    </div>
                                    <div class="product-info text-center">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <button class="btn btn-success btn-block auth"
                                                :disabled="botonDeshabilitado"
                                                    @click="agregarCarrito(item.id)">Autorizar</button>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Fin de card body diagnosticos-->

                <!-- Card body Autorizar-->
                <div class="card-body" v-show="card.carrito">
                    <div class="wrapper">
                        <h5 class="card-title text-dark text-center ">
                            El costo de la reparación es de : {{ costo_final }}
                        </h5>
                        <div class="row">
                            <div class="col-md-6" v-for="(item, index) in list_item" :key="index">
                                <div class="row p-2 m-2  bg-white border rounded  ">
                                    <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                            :src="getImage(item.foto_pieza)"></div>
                                    <div class="col-md-6 mt-1 ">
                                        <h5 class="text-justify spec-1">

                                            Calidad: <span :class="recomendacion(item.ponderacion).clase">{{
                                                recomendacion(item.ponderacion).msg }}</span>

                                        </h5>
                                        <p class="text-justify text-primary lead"> {{ item.nombre }}</p>
                                        <p class="text-justify texto"> {{ item.descripcion }}</p>

                                    </div>
                                    <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                        <div class="align-items-center">
                                            <p class="text-success">

                                                <span>Costo: ${{ item.costo }}</span>
                                            </p>
                                        </div>

                                        <div class="d-flex flex-column mt-4">
                                            <button class="btn btn-outline-danger btn-sm mt-2 auth"
                                                :disabled="botonDeshabilitado" type="button"
                                                @click="eliminar(item.id)">Eliminar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success" type="button"
                                @click="autorizarReparacion"
                                :disabled="botonDeshabilitado"
                                >Autorizar la reparación</button>

                            </div>
                        </div>
                        <!--
                        <div class="col-md-6">
                            <div class="d-grid gap-2">
                                <button class="btn btn-danger" type="button">Cancelar</button>

                            </div>
                        </div>
                    -->
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
            botonDeshabilitado: 0,
            proyecto_id: 0,
            hallazgos: [],
            diagnosticos: [],
            hallazgo_solo: null,
            list_item: null,
            costo_final: 0,

            card: {
                hallazgo: 1,
                diagnostico: 0,
                carrito: 0,
            }
        }
    },
    created() {
        this.proyecto_id = this.proyecto_id_p //document.getElementById('myId').value;
        this.cargarHallazgos()
        this.cargarItem()
        this.cargarEtapa();
    },
    methods: {
        autorizarReparacion(){
            let id = this.proyecto_id;
            let add = { id }
            axios.post('/api/proyecto/cambiarEtapa/', add)
                .then(res => {
                    //this.cargarItem()
                    //console.log(res);
                    this.cargarEtapa();
                })

        },
        cargarEtapa() {
            axios.get('/api/proyecto/' + this.proyecto_id)
                .then(res => {
                    this.botonDeshabilitado = Number(res.data.etapa_id) >= 4 ? 1 : 0
                    console.log(res.data.etapa_id);
                })
        },
        cargarHallazgos() {
            axios.get('/api/hallazgos/' + this.proyecto_id)
                .then(res => {
                    this.hallazgos = res.data
                    //console.log(this.hallazgos);
                })
        },
        cargarDiagnosticos(id) {
            this.id_hallazgo = id;
            axios.get('/api/diagnostico/' + id)
                .then(res => {
                    this.diagnosticos = res.data.hallazgo.diagnosticos
                    this.hallazgo_solo = res.data.hallazgo
                    this.mostrar_div('D');
                })
        },
        cargarItem() {
            axios.get('/api/autorizacion/' + this.proyecto_id)
                .then(res => {
                    //console.log(res.data.total);
                    this.list_item = res.data.diagnosticos
                    this.costo_final = Number(res.data.total).toLocaleString("en", {
                        style: "currency",
                        currency: "MXN"
                    })
                })
        },

        // Autorizar
        agregarCarrito(diagnostico_id) {
            let proyecto_id = this.proyecto_id;
            let add = { proyecto_id, diagnostico_id }
            axios.post('/api/autorizacion/', add)
                .then(res => {
                    this.cargarItem()
                    console.log(res);
                })
        },
        eliminar(id) {
            axios.delete('/api/autorizacion/' + id)
                .then(res => {
                    this.cargarItem();
                    //console.log(res);
                })
        },



        getImage(fileName) {
            return '/api/diagnostico/image/' + fileName;
        },

        mostrar_div(etapa) {
            switch (etapa) {
                case 'H':
                    this.card.hallazgo = 1
                    this.card.diagnostico = 0
                    this.card.carrito = 0

                    break;

                case 'D':
                    this.card.hallazgo = 0
                    this.card.diagnostico = 1
                    this.card.carrito = 0

                    break;
                case 'C':
                    this.card.hallazgo = 0
                    this.card.diagnostico = 0
                    this.card.carrito = 1

                    break;

                default:
                    break;
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
.wrapper {
    max-height: 300px;
    height: 480px;
    overflow-y: scroll;
}

.texto {
    max-height: 150px;
    overflow-y: scroll;
}


.product-content {
    border: 2px solid #dfe5e9;
    margin-bottom: 20px;
    margin-top: 12px;
    background: #fff;
    padding: 4px;
    -webkit-box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.37);
    box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.37);
}

.product-content .carousel-control.left {
    margin-left: 0
}

.product-content .product-image {
    background-color: #fff;
    display: block;
    min-height: 238px;
    overflow: hidden;
    position: relative
}

.product-content .product-deatil {
    border-bottom: 1px solid #dfe5e9;
    padding-bottom: 17px;
    padding-left: 16px;
    padding-top: 16px;
    position: relative;
    background: #fff
}

.product-content .product-deatil h5 a {
    color: #2f383d;
    font-size: 15px;
    line-height: 19px;
    text-decoration: none;
    padding-left: 0;
    margin-left: 0
}

.product-content .product-deatil h5 a span {
    color: #9aa7af;
    display: block;
    font-size: 13px
}

.product-content .product-deatil span.tag1 {
    border-radius: 50%;
    color: #fff;
    font-size: 15px;
    height: 50px;
    padding: 13px 0;
    position: absolute;
    right: 10px;
    text-align: center;
    top: 10px;
    width: 50px
}

.product-content .product-deatil span.sale {
    background-color: #21c2f8
}

.product-content .product-deatil span.discount {
    background-color: #71e134
}

.product-content .product-deatil span.hot {
    background-color: #fa9442
}

.product-content .description {
    font-size: 16px;
    line-height: 20px;
    padding: 10px 14px 16px 19px;
    background: #fff
}

.product-content .product-info {
    padding: 11px 19px 10px 20px
}

.product-content .product-info a.add-to-cart {
    color: #2f383d;
    font-size: 13px;
    padding-left: 16px
}

.product-content name.a {
    padding: 5px 10px;
    margin-left: 16px
}

.product-info.smart-form .btn {
    padding: 6px 12px;
    margin-left: 12px;
    margin-top: -10px
}

.product-entry .product-deatil {
    border-bottom: 1px solid #dfe5e9;
    padding-bottom: 17px;
    padding-left: 16px;
    padding-top: 16px;
    position: relative
}

.product-entry .product-deatil h5 a {
    color: #2f383d;
    font-size: 15px;
    line-height: 19px;
    text-decoration: none
}

.product-entry .product-deatil h5 a span {
    color: #9aa7af;
    display: block;
    font-size: 13px
}

.load-more-btn {
    background-color: #21c2f8;
    border-bottom: 2px solid #037ca5;
    border-radius: 2px;
    border-top: 2px solid #0cf;
    margin-top: 20px;
    padding: 9px 0;
    width: 100%
}

.product-block .product-deatil p.price-container span,
.product-content .product-deatil p.price-container span,
.product-entry .product-deatil p.price-container span,
.shipping table tbody tr td p.price-container span,
.shopping-items table tbody tr td p.price-container span {
    color: #21c2f8;
    font-family: Lato, sans-serif;
    font-size: 24px;
    line-height: 20px
}

.product-info.smart-form .rating label {
    margin-top: 0
}

.product-wrap .product-image span.tag2 {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    padding: 10px 0;
    color: #fff;
    font-size: 11px;
    text-align: center
}

.product-wrap .product-image span.sale {
    background-color: #57889c
}

.product-wrap .product-image span.hot {
    background-color: #a90329
}

.shop-btn {
    position: relative
}

.shop-btn>span {
    background: #a90329;
    display: inline-block;
    font-size: 10px;
    box-shadow: inset 1px 1px 0 rgba(0, 0, 0, .1), inset 0 -1px 0 rgba(0, 0, 0, .07);
    font-weight: 700;
    border-radius: 50%;
    padding: 2px 4px 3px !important;
    text-align: center;
    line-height: normal;
    width: 19px;
    top: -7px;
    left: -7px
}

.description-tabs {
    padding: 30px 0 5px !important
}

.description-tabs .tab-content {
    padding: 10px 0
}

.product-deatil {
    padding: 30px 30px 50px
}

.product-deatil hr+.description-tabs {
    padding: 0 0 5px !important
}

.product-deatil .carousel-control.left,
.product-deatil .carousel-control.right {
    background: none !important
}

.product-deatil .glyphicon {
    color: #3276b1
}

.product-deatil .product-image {
    border-right: 0px solid #fff !important
}

.product-deatil .name {
    margin-top: 0;
    margin-bottom: 0
}

.product-deatil .name small {
    display: block
}

.product-deatil .name a {
    margin-left: 0
}

.product-deatil .price-container {
    font-size: 24px;
    margin: 0;
    font-weight: 300
}

.product-deatil .price-container small {
    font-size: 12px
}

.product-deatil .fa-2x {
    font-size: 16px !important
}

.product-deatil .fa-2x>h5 {
    font-size: 12px;
    margin: 0
}

.product-deatil .fa-2x+a,
.product-deatil .fa-2x+a+a {
    font-size: 13px
}

.product-deatil .certified {
    margin-top: 10px
}

.product-deatil .certified ul {
    padding-left: 0
}

.product-deatil .certified ul li:not(first-child) {
    margin-left: -3px
}

.product-deatil .certified ul li {
    display: inline-block;
    background-color: #f9f9f9;
    padding: 13px 19px
}

.product-deatil .certified ul li:first-child {
    border-right: none
}

.product-deatil .certified ul li a {
    text-align: left;
    font-size: 12px;
    color: #6d7a83;
    line-height: 16px;
    text-decoration: none
}

.product-deatil .certified ul li a span {
    display: block;
    color: #21c2f8;
    font-size: 13px;
    font-weight: 700;
    text-align: center
}

.product-deatil .message-text {
    width: calc(100% - 70px)
}

@media only screen and (min-width:1024px) {
    .product-content div[class*=col-md-4] {
        padding-right: 0
    }

    .product-content div[class*=col-md-8] {
        padding: 0 13px 0 0
    }

    .product-wrap div[class*=col-md-5] {
        padding-right: 0
    }

    .product-wrap div[class*=col-md-7] {
        padding: 0 13px 0 0
    }

    .product-content .product-image {
        border-right: 1px solid #dfe5e9
    }

    .product-content .product-info {
        position: relative
    }
}
</style>
