<template>
    <div>
      <div v-if="mostrar" style="display: flex; justify-content: center; align-items: center;">
        <div v-if="valor === 1" class="card" style="display: flex; justify-content: center; align-items: center;">
          <img src="../img/check.png" width="100" height="100" style="margin: 30px;">
        <h1 style="margin: 20px">!El cliente ha autorizado!</h1>
        </div>
        <div v-else-if="valor === 2" class="card" style="display: flex; justify-content: center; align-items: center;">
          <img src="../img/warning.png" width="100" height="100" style="margin: 30px;">
        <h1 style="margin: 20px">Lo sentimos el cliente no ha autorizado</h1>
        
        </div>
        <div v-else class="card" style="display: flex; justify-content: center; align-items: center;">
          <div class="loader"></div>
        <h1 style="margin: 20px">Autorizacion en progreso........</h1>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
  props: {
    valor: String
  },
  data() {
    return {
      mostrar: true
    }
  }
}
  </script>

<style>
.loader {
  margin: 30px;
  border: 40px solid #f3f3f3; /* Ancho y color del borde */
  border-top: 40px solid #3498db; /* Ancho y color del borde superior */
  border-radius: 50%; /* Radio del borde */
  width: 150px; /* Ancho del elemento */
  height: 150px; /* Altura del elemento */
  animation: spin 2s linear infinite; /* Nombre de la animación, duración, interpolación y número de repeticiones */
}

@keyframes spin {
  0% { transform: rotate(0deg); } /* Angulo de rotación inicial */
  100% { transform: rotate(360deg); } /* Angulo de rotación final */
}
</style>