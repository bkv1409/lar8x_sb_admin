<template>
    <div class="row mt-2">
        <div class="col-xs-12 col-md-4">
            <form>
                <div class="mb-3">
                    <label for="todolist">Todolist</label>
                    <input type="text" class="form-control" id="todolist" ref="textbox" v-model="newtodolist" placeholder="Input todolist here...">
                </div>
                <button type="button" class="btn btn-primary" @click="addTodo"><span class="fa fa-plus"></span> Save</button>
            </form>
        </div>
        <div class="col-xs-12 col-md-8 pt-4">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between" v-for="(todolist,index) in todolists" :key="index">
                    {{todolist.text}}
                    <button type="button" class="btn btn-danger btn-sm" @click="removeTodo(index)">
                        <span class="fa fa-recycle"></span> Delete
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script type = "text/javascript" >

export default {
    name: "TodoList",
    props: ['todos'],
    data() {
        return {
            todolists :[
                {text : "Tutorial Todolist"},
                {text : "Tutorial Vue JS"},
                {text : "Tutorial Angular 5"},
            ],
            newtodolist : ""
        }
    },
    methods:{
        addTodo: function () {
            let value = this.newtodolist && this.newtodolist.trim();
            if (!value) {
                alert('Task Name is not empty!')
                return;
            }
            this.todolists.push({text: value});
            this.$refs.textbox.focus()
            this.newtodolist = ""
        },
        removeTodo: function (index) {
            console.log(index);
            this.todolists.splice(index, 1);
            console.log('delete');
        }
    }

}

</script>

<style scoped>

</style>
