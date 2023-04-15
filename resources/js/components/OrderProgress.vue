<template>
    <div>
      <div class="progress">
        <div class="step" :class="{ 'active': current >= 1 }">
          <div class="step-number">1</div>
          <div class="step-label">Paso 1</div>
        </div>
        <div class="step" :class="{ 'active': current >= 2 }">
          <div class="step-number">2</div>
          <div class="step-label">Paso 2</div>
        </div>
        <div class="step" :class="{ 'active': current >= 3 }">
          <div class="step-number">3</div>
          <div class="step-label">Paso 3</div>
        </div>
        <div class="step" :class="{ 'active': current >= 4 }">
          <div class="step-number">4</div>
          <div class="step-label">Paso 4</div>
        </div>
        <div class="step" :class="{ 'active': current >= 5 }">
          <div class="step-number">5</div>
          <div class="step-label">Paso 5</div>
        </div>
        <!-- Agregar más pasos según sea necesario -->
        <div class="progress-bar" :style="{ width: progress + '%' }" variant="success" striped :animated="animate"></div>
       
        
      </div>
    </div>
</template>
<script>
  export default {
    props: {
      current: {
        type: Number,
      },
      progress: {
        type: Number,
      }
    },
  }
</script>
<style>
.progress {
  position: relative;
  margin-left: 100px;
  width: 1074px;
  height: 30px;
  background-color: white;
  border-radius: 100px;
  padding: 0px;
}


.step {
  position: relative;
  top: 0;
  bottom: 0;
  width: 33.33%;
  text-align: center;
  z-index: 3;
}

.step-number {
  display: flexbox;
  width: 30px;
  height: 30px;
  line-height: 30px;
  border-radius: 60%;
  background-color: #ccc;
  color: #fff;
  font-size: 14px;
  margin-bottom: 5px;
}

.step-label {
  font-size: 120px;
}

.step.active .step-number {
  background-color: #0894f1;
}

.progress-bar {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  background-color: #00ccff;
  border-radius: 25px;
}
/* .progress::before {
display: flex;
content: 1;
width: 20px;
height: 20px;
background-color: black;
margin: 0 auto 5px;
border-radius: 3px;
justify-content: center;
align-items: center;
position: relative;
z-index: 2;
}
.progress::after {
display: block;
content: '';
width: 100%;
height: 5px;
background-color: black;
position: absolute;
top: 13px;
left: 0;
z-index: 1;
} */

</style>