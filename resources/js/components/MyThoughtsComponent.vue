<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form-component 
                @new="addThought"></form-component>
            <thought-component 
                :key="thought.id" 
                v-for="(thought, index) in thoughts"
                :thought="thought"
                @update="updateThought(index, ...arguments)"
                @delete="deleteThought(index)"></thought-component>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Componente principal montado.')

        axios
            .get('/thoughts')
            .then(response => {
                let resParsed = response.data.map(thought => {
                    thought.created_at = moment(thought.created_at).format('ll')
                    thought.updated_at = moment(thought.updated_at).format('ll')
                    return thought
                })
                this.thoughts = resParsed
            })
            .catch(err => console.error(err))
    },
    data() {
        return {
            thoughts: []
        }
    },
    methods: {
        addThought(thought) {
            this.thoughts.push(thought)
        },
        updateThought(index, thought) {
            this.thoughts[index] = thought
        },
        deleteThought(index) {
            this.thoughts.splice(index, 1)
        }
    }
}
</script>

