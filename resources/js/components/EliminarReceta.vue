<template>
    <input
        type="submit"
        class="btn btn-danger d-block w-100 mb-2"
        v-on:click="eliminarReceta"
        value="Eliminar"
    />
</template>

<script>
export default {
    props: ["RecetaId"],
    mounted() {
        console.log("Receta  Actual ", this.RecetaId);
    },
    methods: {
        eliminarReceta() {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    const params = {
                        id: this.RecetaId
                    };
                    axios
                        .post(`/recetas/${this.RecetaId}`, {
                            params,
                            _method: "delete"
                        })
                        .then(respuesta => {
                            console.log(respuesta);
                             this.$swal(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                        })
                        .catch(error => {

                            console.log(error);
                        });
                }
            });
        }
    }
};
</script>
