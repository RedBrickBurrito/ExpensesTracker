<template>
    <div class="row">
        <div class="col-12 mb-2">
            <!-- llamamos al componente para Crear   -->
            <router-link :to='{name:"createExpense"}' class="btn btn-success"><i class="fas fa-plus-circle"></i></router-link>
        </div>
        <div class="col-12">             
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="expense in expenses.data" :key="expense.id">
                                    <td>{{ expense.id }}</td>
                                    <td>{{ expense.expense_date }}</td>
                                    <td>{{ expense.amount }}</td>
                                    <td>{{ expense.payment_method }}</td>
                                    <td>{{ expense.description }}</td>
                                    <td>
                                        <!-- llamamos al componente para Editar     -->
                                        <router-link :to='{name:"editExpense",params:{id:expense.id}}' class="btn btn-info"><i class="fas fa-edit"></i></router-link>
                                        <a type="button" @click="removeExpense(expense.id)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>                          
        </div>
    </div>
</template>

<script>

const tokenJSON = localStorage.getItem("user");
const token = JSON.parse(tokenJSON).access_token;

export default {
    name:"expenses",
    data(){
        return {
            expenses:[],
        }
    },
    mounted(){
        this.showExpenses()
    },
    methods:{
        async showExpenses(){
            await this.axios.get('/api/expense', {
                headers: {
                    'Authorization' : 'Bearer ' + token
                }
            })
            .then(response=>{
                this.expenses = response.data;
                console.log(response.data)
            }).catch(error=>{
                console.log(error)
                this.expenses = []
            })
        },
        removeExpense(id){
            if(confirm("Are you sure you want to remove the expense?")){
                this.axios.delete(`/api/expense/${id}`, {
                    headers: {
                        'Authorization' : 'Bearer ' + token
                    }
                })
                .then(response=>{
                    this.showExpenses()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>