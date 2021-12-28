<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <todo-list></todo-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import TodoList from "./TodoList";

    export default {
        name: "example-component",
        components: {
          TodoList,
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
