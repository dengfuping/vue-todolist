<template>
    <div id="app" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome to My TodoList</div>
                    <div class="panel-body">
                        <router-view :todos="todos"></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Todos from './components/Todos'

    export default {
        name: 'app',
        components: {
            Todos
        },
        data(){
            return {
                todos: []
            }
        },
        mounted() {
            this.axios.get('http://localhost:8000/api/todos').then((response) => {
                this.todos = response.data;
            })
        },
        computed: {
            todoCount(){
                return this.todos.length;
            }
        }
    }
</script>

<style>

</style>
