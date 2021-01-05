<template>

    <div>
        <span class="like-btn" :class="{'like-active':this.like}" @click="likeReceta"></span>
        <p>{{cantidadLikes}} personas le gusto esta receta</p>
    </div>


</template>

<script>
export default {
    props:['recetaId','like','likes'],
    data: function(){
        return {
            totalLikes: this.likes
        }
    },
    methods:{

        likeReceta(){

            console.log('Diste megusta: ',this.recetaId);
            axios.post('/hola/'+this.recetaId)
                .then(respuesta=>{
                    if(respuesta.data.attached.length>0){
                        this.$data.totalLikes++;
                    }else{
                        this.$data.totalLikes--;
                    }
                    console.log(respuesta);
                })
                .catch(error=>{
                    console.log(error);
                    if(error.response.status === 401){
                        window.location ='/register';
                    }
                });
            }

    },
    computed:{
        cantidadLikes: function(){

            return this.totalLikes;

        }
    }

}
</script>
