<script>
import api from "../config/axios.js";
import {PhCheckSquare, PhListPlus, PhNotePencil, PhTrash, PhXSquare} from "@phosphor-icons/vue";
import Swal from "sweetalert2";

export default {
    components: {PhXSquare, PhNotePencil, PhTrash, PhCheckSquare, PhListPlus},
    data () {
        return {
            tasks: [],
            task:''
        }
    },
    methods: {
        getTasks() {
            api.get('/').then(({data})=>{
                this.tasks = data.data
            }).catch((error)=>{
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Não foi possível localizazr as tarefas!',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        },
        addTask() {
            api.post('/task',{
                'description': this.task
            }).then(({data})=>{
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tarefa cadastrada com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.task = ''
                this.getTasks()
            }).catch((error)=>{
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Não foi cadastrar nova tarefa!',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        },
        deleteTask(id){
            Swal.fire({
                title: 'Deseja excluir a tarefa?',
                text: "Você tem certeza que deseja exluir essa tarefa?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    api.delete('/task/'+id).then(()=>{
                        Swal.fire(
                            'Deletado com Sucesso!',
                            'Tarefa deletada com sucesso.',
                            'success'
                        ).finally(
                            this.getTasks()
                        )
                    }).catch((error)=>{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Não foi possível deletar a tarefa!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.getTasks()
                    })
                }
            })
        },
        editTask(task){
            Swal.fire({
                title: task.description,
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Atualizar',
                showLoaderOnConfirm: true,
                preConfirm: (texto) => {
                    return api.put('/task/'+task.id,{
                        'description': texto
                    })
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Tarefa Atualizada com Sucesso!',
                        showConfirmButton: false,
                        timer: 1500
                    }).finally(this.getTasks())
                }
            }).catch((error)=>{
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Não foi possível atualizar a tarefa!',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.getTasks()
            })
        },
        changeTask(task){
            api.put('/task/'+task.id,{
                'id': task.id,
                'description': task.description,
                'completed': !task.completed
            }).then((data)=>{
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tarefa atualizada com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                }).finally(this.getTasks())

            }).catch((error)=>{
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Não foi possível concluir a tarefa!',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.getTasks()
            })

        },
        getStatus(status) {
            switch (status) {
                case 0:
                    return "Não Concluído";
                    break;
                case 1:
                    return "Concluído";
                    break;
            }
        },
        completed(status) {
            if (status === 1)
                return "text-center items-center bg-green-500 text-white text-xs inline-block py-2 px-2 leading-none text-center whitespace-nowrap align-baseline font-bold rounded mr-2";
            else {
                return "text-center items-center bg-red-500 text-xs text-white inline-block py-2 px-2 leading-none text-center whitespace-nowrap align-baseline font-bold rounded mr-2";
            }
        },
        formatDate(date) {
            const data = new Date(date)
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            }
           return new Intl.DateTimeFormat('pt-BR', options).format(data);
        },
    },
    mounted() {
        this.getTasks();
    }
}
</script>

<template>
        <form class="flex flex-row justify-between" @submit.prevent="addTask">
                <div class="relative h-12 w-full">
                        <input
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-sky-500 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " v-model="task" required
                        />
                        <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-sky-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-sky-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-sky-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Digite aqui sua tarefa...
                        </label>
                </div>
            <div>
                <button type="submit" class="bg-green-600 h-12 p-2 rounded-[7px] text-white ml-4 hover:bg-green-700 flex items-center gap-2"><ph-list-plus :size="20" color="white" weight="fill" /> Adicionar</button>
            </div>
        </form>
        <div v-if="tasks.length > 0" class="mx-auto mt-4">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="items-center grid grid-cols-12 bg-[#0079bc] text-white font-bold text-center py-3 text-base">
                    <div class="col-span-2">Ações</div>
                    <div class="col-span-5">Tarefas</div>
                    <div class="col-span-2">Status</div>
                    <div class="col-span-3">Criada em:</div>
                </div>
                <div class="items-center grid grid-cols-12 bg-white border-t-2 border-b-2 py-2" v-for="(task,index) in tasks">
                    <div class="col-span-2 text-center">
                        <button class="bg-blue-500 hover:bg-blue-700 p-1 rounded" @click="editTask(task)" title="Editar"><ph-note-pencil :size="26" color="white" /></button>&nbsp
                        <button class="bg-red-500 hover:bg-red-700 p-1 rounded" @click="deleteTask(task.id)" title="Deletar"><ph-trash :size="26" color="white"/></button>&nbsp
                        <button v-if="!task.completed" class="bg-green-500 hover:bg-green-700 p-1 rounded" @click="changeTask(task)"><ph-check-square :size="26" color="white"/></button>&nbsp
                        <button v-else class="bg-orange-500 hover:bg-orange-700 p-1 rounded" @click="changeTask(task)"><ph-x-square :size="26" color="white" /></button>&nbsp
                    </div>
                    <div class="col-span-5">{{task.description}}</div>
                    <div class="col-span-2 text-center"><span :class="completed(task.completed)">{{getStatus(task.completed)}}</span></div>
                    <div class="col-span-3 text-center">{{formatDate(task.created_at)}}</div>
                </div>
            </div>
        </div>
        <div v-else class="col-12 justify-items-center alert alert-danger text-center mt-5">
            <div class="flex items-center justify-center">
                <img class="mt-6 justify-items-center" src="https://inbraep.com.br/wp-content/uploads/2017/10/logov2-3-1.png" alt="INBRAEP">
            </div>
            <div class="mt-4">
                <span>Sem tarefas cadastradas!</span>
            </div>
        </div>
</template>
