<template>
    <div id="todo-form">
        <div class="form-group">
            <input type="text" v-model="newTodo.title" class="form-control" placeholder="enter your todo here"/>
        </div>
        <div class="form-group">
            <button class="btn btn-success" @click="addTodo()">Add Todo</button>
        </div>
    </div>
</template>

<style>

</style>

<script>
    export default{
        name: 'todo-form',
        props: ['todos'],
        data(){
            return {
                newTodo: {id: null, title: '', completed: false}
            }
        },
        methods: {
            addTodo() {
                this.axios.post('http://localhost:8000/api/todo/create', {title: this.newTodo.title}).then(response => {
                    console.log(response.data);
                    this.todos.push(response.data);

                });

                this.newTodo = {id: null, title: '', completed: false};
            },
        }
    }
</script>
