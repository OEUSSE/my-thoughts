<template>
    <div class="card card-default">
        <div class="card-header date-section">
            <p>Publicado en: <span class="date">{{ thought.created_at }}</span></p> 
            <p>Última actualización: <span>{{ thought.updated_at }}</span></p>
        </div>
        <div class="card-body">
            <p v-if="!editMode">
                {{ thought.description }}
            </p>
            <input v-else type="text" name="thought" class="form-control" v-model="thought.description">
        </div>
        <div class="card-footer">
            <button v-if="editMode" class="btn btn-success" v-on:click="onClickSave">Guardar</button>
            <button v-else class="btn btn-default" v-on:click="onClickEdit">Editar</button>

            <button v-if="!editMode" class="btn btn-danger" v-on:click="onClickDelete">Eliminar</button>
            <button v-else class="btn btn-danger" v-on:click="onClickCancel">Cancelar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['thought'],
        mounted() {
            console.log('Componente pensamiento montado.')
        },
        data() {
            return {
                editMode: false
            }
        },
        methods: {
            onClickSave() {
                const params = {
                    description: this.thought.description
                }

                axios
                    .put(`/thoughts/${this.thought.id}`, params)
                    .then(response => {
                        this.editMode = false
                        const thought = response.data
                        this.$emit('update', thought)
                    })
                    .catch(err => console.error(err))
            },
            onClickEdit() {
                this.editMode = true
            },
            onClickDelete() {
                axios
                    .delete(`/thoughts/${this.thought.id}`)
                    .then(_ => {
                        this.$emit('delete')
                    })
                    .catch(err => console.log(err))
            },
            onClickCancel() {
                this.editMode = false
            }
        }
    }
</script>
