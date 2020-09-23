<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    ایجاد کد
                </h5>
                <form >
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
                        <select id="is_active" class='form-control' v-model="code.is_active">
                            <option value="1">فعال</option>
                            <option value="0">غیر فعال</option>
                        </select>
                        <div class="invalid-feedback">
                            {{errors.get('is_active')}}
                        </div>
                    </div>
                    <button @click.prevent="submit" type="submit" class="btn btn-primary">ارسال</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Errors from '../services/Errors'
import Notify from '../services/Notify'
export default {
    name: 'code-store',
    data() {
        return {
            code: {
                is_active: 0
            },
            errors: new Errors()
        }
    },
    methods: {
        submit(){
            axios.post('/api/codes', this.code).then((response) => {
                this.emptyForm()
                this.$emit('codes:created')
            }).catch(error => {
                this.errors.record(error.response.data.errors)
                if (this.errors.hasMessage()){
                    Notify.error(this.errors.getMessage())
                }
            })
        },
        emptyForm(){
            this.code = {}
            this.code.is_active = 0
            this.errors = new Errors
        }
    }
}
</script>
<style>
.invalid-feedback{
    display: block;
}
</style>
