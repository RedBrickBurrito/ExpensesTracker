<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h4>Add Expense</h4></div>
                <div class="card-body">
                    <form @submit.prevent="add">
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
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const tokenJSON = localStorage.getItem("user");
const token = JSON.parse(tokenJSON).access_token;

export default {
    name:"create-expense",
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
    methods:{
        async add(){
            await this.axios.post('/api/expense',this.expense,{headers: {'Authorization' : 'Bearer ' + token}}).then(response=>{
                this.$router.push({name:"showExpenses"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>