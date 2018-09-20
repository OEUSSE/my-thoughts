<template>
    <div class="card">
        <div class="card-header">¿En qué estás pensando ahora?</div>

        <div class="card-body">
            <form v-on:submit.prevent="onSubmit">
                <div class="form-group">
                    <label for="thought">Ahora estoy pensando en:</label>
                    <input type="text" name="thought" class="form-control" v-model="description">
                </div>
                <button type="submit" class="btn btn-primary">Enviar pensamiento</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Componente formulario montado.')
    },
    data() {
        return {
            description: ''
        }
    },
    methods: {
        onSubmit(e) {
            const params = {
                description: this.description
            }
            axios
                .post('/thoughts', params)
                .then(response => {
                    const thought = response.data
                    this.$emit('new', thought)
                    this.description = ''
                })
                .catch(err => console.error(err))
        }
    }
}
</script>
/