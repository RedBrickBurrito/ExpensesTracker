<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Edit Expense</h4></div>
                    <div class="card-body">
                        <form @submit.prevent="update">
                            <div class="row">
                                <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                                    <label>Expense Date</label>
                                    <input type="date" id="expensedate" name="expense date" class="form-control" v-model="expense.expense_date">
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" v-model="expense.amount">
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label>Payment Method</label>
                                        <input type="text" class="form-control" v-model="expense.payment_method">
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" v-model="expense.description">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>                        
                        </form>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"edit-expense",
    data(){
        return {
            expense:{
                expense_date:"",
                amount:0,
                payment_method:"",
                description:"",
            }
        }
    },
    mounted(){
        this.showExpense()
    },
    methods:{
        async showExpense(){
            await this.axios.get(`/api/expense/${this.$route.params.id}`).then(response=>{
                const { expense_date, amount, payment_method, description } = response.data
                this.expense.expense_date = expense_date
                this.expense.amount = amount
                this.expense.payment_method = payment_method
                this.expense.description = description
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            console.log("ACTUALIZAR EXPENSE");
            console.log(this.expense);
            console.log(this.$route.params.id);
            await this.axios.put(`/api/expense/${this.$route.params.id}`,this.expense).then(response=>{
                console.log(response);
                this.$router.push({name:"showExpenses"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>