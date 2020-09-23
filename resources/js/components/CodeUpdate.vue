<template>
    <div v-if="code" class="row">
        <div class="card col-md-6">
            <div class="card-body">
                <h5 class="card-title">
                    ویرایش کد
                </h5>
                <form>
                    <div class="form-group">
                        <label for="code">کد</label>
                        <input v-model="code.code" type="text" class="form-control" id="code"  placeholder="کد را وارد نمایید ... ">
                        <div class="invalid-feedback">
                            {{errors.get('code')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remaining">محدودیت</label>
                        <input type="number" v-model="code.remaining" class="form-control" id="remaining"  placeholder="تعداد کد را وارد نمایید ... ">
                        <div class="invalid-feedback">
                            {{errors.get('remaining')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_active">وضعیت</label>
                        <select id="is_active" class='form-control' v-model="code.is_active" >
                            <option :value="true">فعال</option>
                            <option :value="false">غیر فعال</option>
                        </select>
                        <div class="invalid-feedback">
                            {{errors.get('is_active')}}
                        </div>
                    </div>
                    <button @click.prevent="submit" type="submit" class="btn btn-primary">ارسال</button>
                    <button class="btn-danger btn" @click.prevent="back">بازگشت</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Errors from '../services/Errors'
import Notify from '../services/Notify'
export default {
    name: "code-update",
    data() {
        return {
            code: {},
            errors: new Errors
        }
    },
    methods: {
        getCode(){
            axios.get('/api/codes/' + this.$route.params.id).then((response) => {
                this.code = response.data
            }).catch(error => {
                this.errors.record(error.response.data.errors)
                if (this.errors.hasMessage()){
                    Notify.error(this.errors.getMessage())
                }
            })
        },
        submit(){
            axios.put('/api/codes/' + this.$route.params.id, this.code).then((response) => {
                Notify.success(response.data.message)
            }).catch(error => {
                this.errors.record(error.response.data.errors)
                if (this.errors.hasMessage()){
                    Notify.error(this.errors.getMessage())
                }
            })

        },
        back(){
            window.history.go(-1)
        }
    },
    mounted(){
        this.getCode()
    },

}
</script>
