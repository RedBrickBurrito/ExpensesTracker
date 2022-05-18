<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <h1>Budget Calculator</h1>
                <h3>Leftover Budget</h3>
                <span
                    class="fs-2"
                    :class="{
                        greenText: leftoverBudget >= 0,
                        redText: leftoverBudget < 0,
                    }"
                    >{{ leftoverBudget }}</span
                >
            </div>
        </div>
        <div class="row">
            <div class="col-4 mb-2">
                <h3>Monthly Income</h3>
                <input
                    type="number"
                    name="monthly-income"
                    id="monthly-income"
                    class="form-control"
                    v-model="monthlyIncome"
                    @change="handleChange"
                />
            </div>
        </div>
        <br />
        <h3>Expenses</h3>
        <div class="row">
            <div class="col-4 mb-2">
                <h4>Water</h4>
                <input
                    type="number"
                    name="water"
                    id="water"
                    class="form-control"
                    v-model="expenses[0]"
                    @change="handleChange"
                />
                <h4>Light Service</h4>
                <input
                    type="number"
                    name="light"
                    id="light"
                    class="form-control"
                    v-model="expenses[1]"
                    @change="handleChange"
                />
                <h4>Gas Service</h4>
                <input
                    type="number"
                    name="gas"
                    id="gas"
                    class="form-control"
                    v-model="expenses[2]"
                    @change="handleChange"
                />
                <h4>Other</h4>
                <input
                    type="number"
                    name="other"
                    id="other"
                    class="form-control"
                    v-model="expenses[6]"
                    @change="handleChange"
                />
            </div>
            <div class="col-2"></div>
            <div class="col-4 mb-2">
                <h4>Phone</h4>
                <input
                    type="number"
                    name="phone"
                    id="phone"
                    class="form-control"
                    v-model="expenses[3]"
                    @change="handleChange"
                />
                <h4>Outings</h4>
                <input
                    type="number"
                    name="outs"
                    id="outs"
                    class="form-control"
                    v-model="expenses[4]"
                    @change="handleChange"
                />
                <h4>Car Fuel</h4>
                <input
                    type="number"
                    name="fuel"
                    id="fuel"
                    class="form-control"
                    v-model="expenses[5]"
                    @change="handleChange"
                />
            </div>
        </div>

        <div class="progress" style="height: 25px">
            <div
                class="progress-bar"
                :class="{
                    'bg-warning': expensesPctg > 75,
                    'bg-danger': expensesPctg > 90,
                }"
                role="progressbar"
                style="width: 100%"
                aria-valuenow="100"
                aria-valuemin="0"
                aria-valuemax="100"
            >
                {{ expensesPctg }}%
            </div>
        </div>
    </div>
</template>

<style>
.greenText {
    color: green;
}

.redText {
    color: red;
}
</style>

<script>
export default {
    name: "calculator",
    data() {
        return {
            leftoverBudget: 0,
            monthlyIncome: 0,
            expenses: [0, 0, 0, 0, 0, 0, 0],
            expensesPctg: 100,
        };
    },
    methods: {
        handleChange() {
            const totalExpenses = this.expenses.reduce(
                (prevVal, currVal) => parseInt(prevVal) + parseInt(currVal),
                0
            );
            const percentage = parseInt(
                (totalExpenses / this.monthlyIncome) * 100
            );
            this.leftoverBudget = this.monthlyIncome - totalExpenses;

            const progressBar = document.querySelector(".progress-bar");
            progressBar.style.width = `${percentage}%`;
            this.expensesPctg = percentage;
        },
    },
};
</script>
