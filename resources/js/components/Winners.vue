<template>
    <div>
        <div class="card mb-5">
            <div class="card-body">
                <h5 class="card-title">
                    جستجو
                </h5>
                <form>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="code" @change="sanitizeText($event)" v-model="searchForm.code" class="form-control" placeholder="کد را وارد نمایید ... "> </div>
                        <div class="col">
                            <input type="text" name="mobile" @change="sanitizeText($event)" v-model="searchForm.mobile" class="form-control" placeholder="شماره تلفن را وارد نمایید ... ">
                        </div>
                        <div class="col">
                            <button @click.prevent="search" class="btn btn-info">جستجو</button>
                            <button @click.prevent="clearSearch" class="btn btn-danger">پاک کردن فیلتر</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    لیست برنده‌ها
                </h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">موبایل</th>
                            <th scope="col">تاریخ</th>
                            <th scope="col">کد</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="winner in winners" :key="winner.id">
                            <td>{{winner.mobile}}</td>
                            <td>{{winner.jalali_created_at}}</td>
                            <td>{{winner.code}}</td>
                        </tr>
                    </tbody>
                </table>
                <pagination :meta='meta' @pagination:switched='getWinners'></pagination>
            </div>
        </div>
    </div>
</template>
<script>
import Pagination from './Partials/Pagination'
export default {
    components: {
        Pagination
    },
    name: "winners-list",
    data() {
        return {
            winners: {},
            meta: {},
            searchForm: {
                code: this.$route.query.code,
                mobile: this.$route.query.mobile
            }
        }
    },
    methods: {
        getWinners(params = this.$route.query){
            axios.get('/api/winners', {params: params}).then((response) => {
                this.winners = response.data.data
                this.meta = response.data.meta
            }).catch(error => {
                this.errors.record(error.response.data.errors)
                if (this.errors.hasMessage()){
                    Notify.error(this.errors.getMessage())
                }
            })
        },
        back(){
            window.history.go(-1)
        },
        search(){
            this.$router.push({ query: Object.assign({...this.$route.query}, this.searchForm) })
            this.getWinners()
        },
        clearSearch(){
            this.searchForm = {}
            this.$router.push({ query: {} })
            this.getWinners()
        },
        sanitizeText(event){
            if (event.target.value == 0){
                this.searchForm[event.target.name] = undefined
            }
        }
    },
    mounted(){
        this.getWinners()
    },
}
</script>
