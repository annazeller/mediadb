<div class="row">
    <div class="col-12" v-show="notification" id="message">
        <div class="alert alert-success" role="alert" v-cloak v-if="!anyError()">
            @{{ message }}
        </div>
        <div class="alert alert-danger" v-cloak v-if="anyError()">
            <h4>
                @{{ message }}
            </h4>
            <div class="content">
                <ul v-for="error in errors">
                    <li v-for="error_item in error">
                        @{{ error_item }}
                    </li>
                </ul>
            </div>
            <button type="button" class="close" @click="notification=false">
                <span aria-hidden="false">&times;</span>
            </button>
        </div>
    </div>
</div>

