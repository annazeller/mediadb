<form id="new-file-form" action="#" method="#" @submit.prevent="submitForm">
    <div class="row mb-6">
        <div class="col-10">
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <input type="text" class="form-control" aria-label="Dateiname" placeholder="Gewünschter Dateiname hier eintragen" v-model="fileName">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group">
                        <div class="custom-file">
                            {{--<picture-input ref="pictureInput" @change="addFile()" ref="file" name="file" class="custom-file-input german" id="fileUploadLabel" aria-describedby="fileUpload"></picture-input>--}}
                            <input type="file" ref="file" name="file" class="custom-file-input german" id="fileUploadLabel" aria-describedby="fileUpload" @change="addFile()">
                            <label class="custom-file-label" for="fileUploadLabel"><span v-if="!attachment.name"><i class="fa fa-upload"></i> &emsp; Neue Datei hinzufügen</span><span class="file-name" v-if="attachment.name" v-html="attachment.name"></span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2">
            <button class="btn btn-primary w-100" type="submit" id="fileUpload">Hochladen</button>
        </div>
    </div>
</form>
