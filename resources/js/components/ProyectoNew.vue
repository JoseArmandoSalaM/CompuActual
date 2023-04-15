<template>
    <div class="row text-center">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h1>Módulo de Recepción</h1>
        </div>
        <div class="col-md-0"></div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Módulo de Recepción</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="card">
                                <div class="card-header">Selecciona el cliente que solicita el servicio </div>
                                <div class="card-body">
                                    <form class="form">
                                        <div class="row">
                                            <div class="form-group col-md-2"></div>
                                            <div class="form-group col-md-6">
                                                <input class="form-control  mr-sm-2" type="search"
                                                    placeholder="Buscar cliente" aria-label="Buscar" v-model="clienteBuscar"
                                                    v-on:keyup="onKeyUp">
                                            </div>


                                            <div class="form-group col-md-4">
                                                <button class="btn btn-outline-success my-4 my-sm-0"
                                                    type="submit">Buscar</button>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped table-sm text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Selecciona</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="clientes !== null" v-for="(item, index) in clientes" :key="index">
                                        <td>{{ item.name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm "
                                                @click='clickBoton(item.id, item.name)'>
                                                Seleccionar</button>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="2" class="table-danger text-center">Sin resultados</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <form @submit.prevent="agregar()">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Folio</label>
                                <input type="text" class="form-control" id="folio" name="folio" :disabled="true"
                                    :value="proyecto.folio">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Cliente</label>
                                <input type="text" class="form-control" id="cliente" name="cliente" :value="cliente.name"
                                    :disabled="true" required>
                                <input type="hidden" name="id" :value="cliente.id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nombre del equipo</label>
                                <input type="text" class="form-control" id="equipo" name="equipo" v-model="proyecto.equipo"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Modelo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" v-model="proyecto.modelo"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Características posibles del equipo</label>
                            <textarea class="form-control" id="exampleTextarea" rows="8" v-model="proyecto.caractPosibles"
                                required></textarea>

                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Descripción del problema</label>
                            <textarea class="form-control" id="exampleTextarea" rows="8" v-model="proyecto.decripcion"
                                required></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputState">Tipo de servicio</label>
                                <select id="inputState" class="form-control" v-model="proyecto.tipoServicio">
                                    <option value="Hardware" selected>Hardware</option>
                                    <option value="Software">Software</option>
                                    <option value="Ambos">Ambos</option>
                                </select>

                            </div>

                            <div class="form-group col-md-6 text-center">
                                <label for="inputCity">Require respaldo</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="respaldo"
                                        v-model="proyecto.requiereRespado" value="si">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Si &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="respaldo" value="no"
                                        v-model="proyecto.requiereRespado">
                                    <label class="form-check-label" for="exampleRadios1">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <transition name="fade">
                            <div class="form-group" v-show="proyecto.requiereRespado === 'si'">
                                <label for="inputAddress2">Rutas de las carpetas a respaldar </label>
                                <textarea class="form-control" id="exampleTextarea" rows="4"
                                    v-model="proyecto.rutas"></textarea>
                            </div>
                        </transition>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Costo aproximado</label>
                                <input type="number" class="form-control" id="costoAprox" name="costoAprox"
                                    v-model="proyecto.costoAprox" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Dinero acuenta</label>
                                <input type="number" class="form-control" id="acuenta" name="acuanta"
                                    v-model="proyecto.dineroAcuenta" required>
                            </div>
                        </div>
                        <div class="row m-4">
                            <div class="form-group col-md-2"></div>
                            <div class="form-group col-md-8 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Capturar</button>
                            </div>
                            <div class="form-group col-md-2"></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            clientes: [],
            folio: "",
            requiereRespado: 'si',
            cliente: { id: '', name: '' },
            proyecto: {
                folio: '',
                idCliente: '',
                equipo: '',
                modelo: '',
                decripcion: '',
                caractPosibles: '',
                tipoServicio: 'Hardware',
                requiereRespado: 'si',
                rutas: '',
                costoAprox: 0,
                dineroAcuenta: 0,
            },
            clienteBuscar: '',
        }
    },
    created() {
        this.cargar()
    },


    methods: {
        cargar() {
            axios.get('/cliente/listado').then(res => {
                this.clientes = res.data;
            })

            axios.get('/proyecto/folio')
                .then(res => {
                    this.proyecto.folio = res.data;
                })
        },
        agregar() {
            const proyecoNuevo = this.proyecto;
            axios.post('/proyecto', proyecoNuevo)
                .then((res) => {
                    //console.log(res.data);
                    this.cargar()
                })
        },

        onKeyUp() {
            axios.get(`/cliente/listado/{${this.clienteBuscar}}`).then(res => {
                this.clientes = res.data;
            })
        },
        clickBoton(id, nombre) {
            this.cliente.name = nombre
            this.cliente.id = id
            this.proyecto.idCliente = id
        }
    }


}
</script>
<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>