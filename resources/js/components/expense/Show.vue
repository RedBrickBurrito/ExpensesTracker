<header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
</header>


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
                                <tr v-for="expense in expenses" :key="expense.id">
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
        <div class="col-12 mb-2">
            <a type="button" @click="exportPDF" class="btn btn-success">PDF</a>
            <a type="button" @click="sendPDF" class="btn btn-success">Send via email</a>
        </div>
    </div>
</template>

<script>
import jsPDF from 'jspdf'
import 'jspdf-autotable'

export default {
    name:"expenses",
    data(){
        return {
            expenses:[],
            file: null
        }
    },
    mounted(){
        this.showExpenses()
    },
    methods:{
        async showExpenses(){
            await this.axios.get('/api/expense').then(response=>{
                this.expenses = response.data
                console.log("DATA")
                console.log(response.data);
            }).catch(error=>{
                console.log(error)
                this.expenses = []
            })
        },
        removeExpense(id){
            if(confirm("Are you sure you want to remove the expense?")){
                this.axios.delete(`/api/expense/${id}`).then(response=>{
                    this.showExpenses()
                }).catch(error=>{
                    console.log(error)
                })
            }
        },
        createPDFFile() {
            var doc = new jsPDF('p', 'pt');
            doc.text(" " ,40, 40);

            var rows = [];
            this.expenses.map(function (el){
                var temp = [
                    el.id,
                    el.expense_date,
                    el.amount,
                    el.payment_method,
                    el.description,
                ];
                rows.push(temp);
            });
            doc.autoTable({
                head: [["ID", "DATE", "AMOUNT", "PAYMENT METHOD", "DESCRIPTION"]],
                body : rows,
            });
            this.file = doc;
        },
        exportPDF(){
            this.createPDFFile();
            this.file.save('expenses.pdf');
        },
        sendPDF() {
            this.createPDFFile();
            var today = new Date().toLocaleDateString('es-MX', { month: 'numeric', year: 'numeric'});
            var blobPDF = new Blob([ this.file.output('blob') ], { type: 'application/pdf' });
            var formData = new FormData();
            formData.append('to', 'test@mail.com');
            formData.append('blobPdf', blobPDF, `${today} expenses.pdf`);
            
            this.axios.post('/api/email', formData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then((response) => console.log('response', response))
                .catch((err) => console.log(err.message))
        }
    }
}
</script>