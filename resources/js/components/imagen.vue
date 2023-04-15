<template>
   <div class="card card-default" >
              <div class="card-header">
                 <span class="card-title">Imagenes</span>
              </div>
   <div class="card-body" >
      <div class="container">
          <div class="row">
            <div class="col">
              <input type="file" ref="fileInput" @change="addImage">
              
            </div>
            <div class="col">
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
                
                <td><button @click="eliminarImagen(image.id)">Eliminar</button> </td>
           
              
              </tr>
              
           
          
            </tbody>
          
        </table>
          
      </div>
      
    </div>
    <br>
    <div style="display: flex; justify-content: center; align-items: center;">
    <button @click="uploadImages" variant="primary" outlined>Subir imagenes</button>
   
    </div>
  </div>
   </div>
    

  </div>

 

 
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      images: []
    };
  },     
  methods: {
    addImage() {
      const file = this.$refs.fileInput.files[0];
      this.images.push(file);
    },
    eliminarImagen(id) {
      this.images.splice(id, 1);
    },
    uploadImages() {
      const formData = new FormData();

      formData.append(`valor`, window.valor_recibido);

      this.images.forEach((image, index) => {
        formData.append(`image_${index}`, image);
      });

      axios.post('/agregar/imagen',formData)
        .then(response => {
          console.log(response.data);
        })
        .catch(error => {
          console.log(error);
        });
           }
         }
      }
</script>