<template>
    <div>
        <div class="row">
            <div class="card col-md-6">
                <div class="card-body">
                    <h5 class="card-title">لیست کدها</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">کد</th>
                                <th scope="col">تعداد باقیمانده</th>
                                <th scope="col">وضعیت </th>
                                <th scope="col">عملیات </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="code in codes" :key="code.id">
                                <td>{{code.code}}</td>
                                <td>{{code.remaining}}</td>
                                <td>{{code.is_active ? 'فعال' : 'غیرفعال'}}</td>
                                <td>
                                    <router-link :to="{name: 'code-update', params: {id: code.id}}" class="btn btn-sm btn-primary">ویرایش</router-link>
                                    <router-link :to="{name: 'winner-index', query: {code: code.code}}" class="btn btn-sm btn-primary">لیست برنده‌ها</router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :meta="meta" @pagination:switched="getCodes"></pagination>
                </div>
            </div>
            <div class="col-md-6">
                <code-store @codes:created="getCodes"></code-store>
            </div>
        </div>
    </div>
</template>
<script>
import CodeStore from './CodeStore'
import Pagination from './Partials/Pagination'
export default {
    components: {
        CodeStore,
        Pagination
    },
    name: "codes-index",
    data() {
        return {
            codes: {},
            meta: {}
        }
    },
    methods: {
        getCodes(page = this.$route.query.page){
            axios.get('/api/codes', {params: {page}}).then((response) => {
                this.codes = response.data.data
                this.meta = response.data.meta
            }).catch(error => {
                this.errors.record(error.response.data.errors)
                if (this.errors.hasMessage()){
                    Notify.error(this.errors.getMessage())
                }
            })
        }
    },
    mounted(){
        this.getCodes()
    }
}
</script>
