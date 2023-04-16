<template>
  <div class="row">
    <div class="col-md-6">
      <div class="card ">
        <div class="card-header">
          <h5>
            Reparaciones autorizadas: {{ list_item ? list_item.length : 0 }}
          </h5>

        </div>
        <div class="card-body" 
        style="height: 410px;"
        >
          <div class="wrapper ">
            <h5 class="card-title text-dark text-center ">
              El costo de la reparación es de : {{ costo_final }}
            </h5>
            <div class="row">
              <div class="col-md-12" v-for="(item, index) in list_item" :key="index">
                <div class="row p-2 m-2  bg-white border rounded  ">
                  <div class="col-md-3 mt-1">
                    <img class="img-fluid img-responsive rounded product-image" :src="getImage(item.foto_pieza, 2)">
                  </div>
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
                      <p class="text-success text-ceneter">
                        <span>Costo: ${{ item.costo }}</span>
                      </p>
                    </div>

                    <div class="d-flex flex-column mt-4">

                    </div>
                  </div>
                </div>

              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Card-->
    <div class="col-md-6">

      <div class="card ">
        <div class="card-header">
          <h5>
            <span class="card-title">Reparación</span>
          </h5>

        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <input type="file" ref="fileInput" @change="addImage">

              </div>
              <div class="col-md-4">
                <table class="table">
                  <thead class="table-light">
                    <tr>
                      <th scope="col">Imagen</th>
                      <th scope="col">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="image in images" :key="image.id">
                      <td>{{ image.name }}</td>
                      <td><button class="btn btn-danger" @click="eliminarImagen(image.id)">Eliminar</button> </td>
                    </tr>
                  </tbody>
                </table>

              </div>
              <div class="col-md-4">
                <div style="display: flex; justify-content: center; align-items: center;">
                  <button class="btn btn-primary" @click="uploadImages" variant="primary" outlined>Subir imagenes</button>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="wrapper">
                  <div class="row">
                    <div class="col-md-3 mt-1" v-for="img in imagenesBD" :key="i">
                      <img :src="getImage(img.image)" class="img-thumbnail m-2  " alt="reparacion">
                    </div>
                  </div>


                </div>
              </div>
            </div>
            <br>

          </div>
        </div>


      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    proyecto_id: {
      type: Number,
    },
  },
  data() {
    return {
      list_item: null,
      costo_final: 0,

      idProyecto: 0,
      images: [],
      imagenesBD: []
    };
  },
  created() {
    this.idProyecto = this.proyecto_id//
    //console.log( document.getElementById('myId'));
    this.cargarImg()
    this.cargarItem()


  },
  methods: {
    cargarItem() {
      axios.get('/api/autorizacion/' + this.idProyecto)
        .then(res => {
          console.log(res.data);
          this.list_item = res.data.diagnosticos
          this.costo_final = Number(res.data.total).toLocaleString("en", {
            style: "currency",
            currency: "MXN"
          })
        })
    },
    cargarImg() {
      axios.get('/api/reparacion/' + this.idProyecto)
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
    addImage() {
      const file = this.$refs.fileInput.files[0];
      this.images.push(file);
    },
    eliminarImagen(id) {
      this.images.splice(id, 1);
    },
    uploadImages() {
      const formData = new FormData();

      formData.append(`valor`, this.idProyecto);

      this.images.forEach((image, index) => {
        formData.append(`image_${index}`, image);
      });

      axios.post('/agregar/imagen', formData)
        .then(response => {
          //console.log(response.data);
          this.cargarImg()
        })
        .catch(error => {
          console.log(error);
        });
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
  overflow-y: scroll;
}

.wrapper {
  max-height: 300px;
  height: 480px;
  overflow-y: scroll;
}
</style>