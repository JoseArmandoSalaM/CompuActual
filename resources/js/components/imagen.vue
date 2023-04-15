<template>
  <div class="card card-default">
    <div class="card-header">
      <span class="card-title">Reparación</span>
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
            <div class="wrapper">
              <div class="row">
                <div class="col-md-6" v-for="img in imagenesBD" :key="i">
                  <img  :src="getImage(img.image)" class="img-thumbnail m-2 "
                    alt="reparacion">
                </div>
              </div>


            </div>
          </div>

        </div>
        <br>
        <div style="display: flex; justify-content: center; align-items: center;">
          <button class="btn btn-primary" @click="uploadImages" variant="primary" outlined>Subir imagenes</button>

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
      idProyecto: 0,
      images: [],
      imagenesBD: []
    };
  },
  created() {
    this.idProyecto = this.proyecto_id//
    //console.log( document.getElementById('myId'));
    this.cargarImg()


  },
  methods: {
    cargarImg() {
      axios.get('/api/reparacion/' + this.idProyecto)
        .then(res => {
          this.imagenesBD = res.data
          //console.log(res.data);
          //console.log(res.data.hallazgo);
        })
    },
    getImage(fileName) {
      return '/api/reparacion/image/' + fileName;
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
    }
  }
}
</script>

<style>
.wrapper {
  max-height: 300px;
  height: 480px;
  overflow-y: scroll;
}
</style>