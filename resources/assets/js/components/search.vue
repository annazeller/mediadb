<template>
    <div class="col-3 mb-4 p-0">
        <form class="navbar-form" role="search">
            <div class="input-group add-on">
                <input class="form-control" v-model="keywords" placeholder="Suche" name="srch-term" id="srch-term" type="text">
                <div class="input-group-btn">
                    <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <div v-if="results.length > 0" >
            <div v-for="result in results" :key="result.id" class="card-body">
                <h5 class="card-title">
                    {{ result.name + '.' + result.extension}}
                </h5>
                Hochgeladen am:<br>
                <time datetime="1.1.2019">{{ result.created_at }}</time>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                keywords: "",
                results: []
            };
        },

        mounted:function(){
            this.fetch()
        },

        watch: {
            keywords(after, before) {
                this.fetch();
            }
        },

        methods: {
            fetch() {
                axios.get('/search', { params: { keywords: this.keywords } })
                    .then(response => this.results = response.data)
                    .catch(error => {});
            },

        }
    }
</script>