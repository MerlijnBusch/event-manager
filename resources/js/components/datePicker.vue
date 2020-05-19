<template>
    <div class="datePicker">
        <p>{{date.current}}</p>
        <button @click="isOpen = !isOpen"><span v-if="!!value && value.length">{{value}}</span><span
                v-else>Pick a date</span></button>
        <div v-if="isOpen" class="datePicker-window">
            <div>
                <button @click="previous">previous</button>
                <span>{{months[date.current.month]}} {{date.current.year}}</span>
                <button @click="next">next</button>
            </div>
            <table class="table table-bordered table-responsive-sm" id="calendar">
                <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
                </thead>

                <tbody id="calendar-body">
                <tr v-for="row in table.rows">
                    <td v-for="column in row">
                        <button :class="{'selected' : parseInt(date.current.day) === parseInt(column)}" v-if="column"
                                @click="pushDate(column)">
                            {{column}}
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>

            <div>
                <div>Jump to</div>
                <select @change="yearMonthIntUpdate" v-model="date.current.year">
                    <option v-if="date.today" v-for="n in 11" :value="n + date.today.getFullYear() - 1">{{n +
                        date.today.getFullYear() - 1}}
                    </option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['value'],
        data() {
            return {
                isOpen: !false,
                selectedDate: {
                    start: '',
                    end: ''
                },
                table: {
                    rows: [],
                },
                date: {
                    today: null,
                    current: {
                        day: null,
                        month: null,
                        year: null,
                    }
                },
                months: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            }
        },
        mounted() {
            this.date.today = new Date();
            if (this.value && this.value.length) {
                let chosenDate = new Date(this.value);
                this.date.current.day = chosenDate.getDate();
                this.date.current.month = chosenDate.getMonth();
                this.date.current.year = chosenDate.getFullYear();
            } else {
                this.date.current.day = this.date.today.getDate();
                this.date.current.month = this.date.today.getMonth();
                this.date.current.year = this.date.today.getFullYear();
            }
            this.updateCalender();
        },
        methods: {
            next() {
                this.date.current.year = (this.date.current.month === 11) ? this.date.current.year + 1 : this.date.current.year;
                this.date.current.month = (this.date.current.month + 1) % 12;
                this.updateCalender();
            },
            previous() {
                this.date.current.year = (this.date.current.month === 0) ? this.date.current.year - 1 : this.date.current.year;
                this.date.current.month = (this.date.current.month === 0) ? 11 : this.date.current.month - 1;
                this.updateCalender();
            },
            yearMonthIntUpdate() {
                this.date.current.year = parseInt(this.date.current.year);
                this.date.current.month = parseInt(this.date.current.month);
                this.updateCalender();
            },
            updateCalender() {

                let firstDay = (new Date(this.date.current.year, this.date.current.month)).getDay();
                let daysInMonth = 32 - new Date(this.date.current.year, this.date.current.month, 32).getDate();


                // clearing all previous cells
                this.table.rows = [];

                // creating all cells
                let date = 1;
                for (let i = 0; i < 6; i++) {
                    // creates a table row
                    let row = [];

                    //creating individual cells, filing them up with data.
                    for (let j = 0; j < 7; j++) {
                        if (i === 0 && j < firstDay) {
                            let column = "";
                            row.push(column)
                        } else if (date > daysInMonth) {
                            break;
                        } else {
                            let column = "" + date;
                            row.push(column);
                            date++;
                        }


                    }
                    this.table.rows.push(row);
                }

            },
            pushDate(day) {
                this.date.current.day = day;
            }
        }
    }
</script>
<!--TODO: Give some actual good styling and not in the .VUE file-->
<style lang="scss">
    .datePicker-window {
        padding: 24px;
        width: max-content;
        background: #eee;
    }

    .selected {
        background: #639;
        color: white;
    }
</style>