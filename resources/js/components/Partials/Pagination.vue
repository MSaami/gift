<template>
    <nav >
        <ul class="pagination">
            <li :class="[{disabled: meta.current_page === 1} ,'page-item']"><a class="page-link" @click.prevent="switched(meta.current_page - 1)">&laquo;</a></li>
            <template v-if="section > 1">
                <li class="page-item"><a class="page-link" href="#" @click.prevent="switched(1)">1</a></li>
                <li class="page-item"><a @click.prevent="" class="page-link" href="">...</a></li>
            </template>
            <li v-for="page in pages" class="page-item" :class="{'active': meta.current_page === page}">
                <a class="page-link" @click.prevent="switched(page)">{{page}}</a>
            </li>
            <template v-if="section < sections">
                <li class="page-item"><a @click.prevent="" class="page-link" href="">...</a></li>
                <li class="page-item"><a class="page-link" href="#" @click.prevent="switched(meta.last_page)">{{meta.last_page}}</a></li>
            </template>
            <li :class="[{disabled: meta.current_page === meta.last_page} ,'page-item']"><a class="page-link" @click.prevent="switched(meta.current_page + 1)">&raquo;</a></li>
        </ul>
    </nav>
</template>
<script>
export default {
    props: ['meta'],
    data(){
        return {
            numberPerSection: 5
        }
    },
    computed: {
        section(){
            return Math.ceil(this.meta.current_page / this.numberPerSection)
        },
        sections(){
            return Math.ceil(this.meta.last_page / this.numberPerSection)
        },
        lastPage(){
            let lastPage = ((this.section - 1) * this.numberPerSection) + this.numberPerSection
            if (this.section === this.sections ){
                lastPage = this.meta.last_page
            }

            return lastPage
        },
        pages(){
            return _.range(
                (this.section - 1) * this.numberPerSection + 1,
                this.lastPage + 1
            )
        }
    },

    methods: {
        switched(page){
            if(page <= 0 || page > this.meta.last_page){
                return;
            }
            this.$router.push({ query: Object.assign({...this.$route.query}, { page: page }) })
            this.$emit('pagination:switched')
        }
    }
}
</script>
<style scoped>
a{
    cursor: pointer;
}
</style>
