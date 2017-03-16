<template>
    <div id="todos">
        <h2>My Todos {{todoCount}}</h2>
        <ul class="list-group">
            <li class="list-group-item" v-for="(todo, index) in todos" :class="{'completed': todo.completed}">
                <router-link :to="{ name: 'todo', params: { id: todo.id }}">{{todo.title}}</router-link>
                <button style="margin-left: 20px" class="btn btn-warning btn-xs pull-right" @click="deleteTodo(todo, index)">
                    Delete
                </button>
                <button class="btn btn-info btn-xs pull-right" @click="toggleCompletion(todo)"
                        :class="[todo.completed ? 'btn-danger':'btn-info']">{{todo.completed ? 'Undo':'Done'}}
                </button>
            </li>
        </ul>
        <todo-form :todos="todos"></todo-form>
    </div>
</template>

<style>
    .completed {
        color: #4cae4c;
        text-decoration: line-through;
    }
</style>

<script>
    import TodoForm from './TodoForm'

    export default{
        name: 'todos',
        props: ['todos'],
        methods: {
            deleteTodo: function (todo, index) {
                this.axios.delete('http://localhost:8000/api/todo/' + todo.id + '/delete').then(response => {
                    console.log(response.data);
                    this.todos.splice(index, 1);
                });

            },
            toggleCompletion: function (todo) {
                this.axios.patch('http://localhost:8000/api/todo/' + todo.id + '/completed').then(response => {
                    console.log(response.data);
                    todo.completed = !todo.completed;
                });
            }
        },
        computed: {
            todoCount(){
                return this.todos.length;
            }
        },
        components: {
            TodoForm
        }
    }
</script>
