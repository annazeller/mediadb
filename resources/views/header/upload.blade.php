<div class="sub-navbar">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-4">
                <div class="filter-bar">
                    @if(Auth::check())
                        @include('layouts.filter')
                    @endif
                </div>
            </div>
            <form class="col-8 h-100" id="new-file-form" action="#" method="#" @submit.prevent="submitForm">
                <div class="row">
                    <div class="col-6">
                        <div class="h-100 upload-form">
                            <input type="text" aria-label="Dateiname" placeholder="Gewünschten Dateinamen hier eintragen" v-model="fileName">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="h-100 upload-form">
                            <div class="custom-file">
                                <input type="file" ref="file" name="file" class="custom-file-input german" id="fileUploadLabel" aria-describedby="fileUpload" @change="addFile()">
                                <label class="custom-file-label" for="fileUploadLabel"><span v-if="!attachment.name"><i data-feather="upload" class="mr-3" ></i>Neue Datei hinzufügen</span><span class="file-name" v-if="attachment.name" v-html="attachment.name"></span></label>
                            </div>
                            <button type="submit" id="fileUpload">Hochladen</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>