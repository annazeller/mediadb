<div class="modal-custom hidden" :class="{'visible' : modalActive}" >
    <div class="modal-background" @click="closeModal()"></div>
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <button type="button" class="close-modal" title="Schließen" @click="closeModal()">
            <span aria-hidden="true"><i data-feather="x"></i></span>
        </button>
        <div class="modal-content">
            <div class="modal-body">
                <img class="img-fluid modal-image" ref="imageExif" v-if="Object.keys(file).length !== 0" :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" :alt="file.name">
                <div class="my-3 d-flex align-items-center justify-content-between">
                    <button class="btn btn-primary" @click="modalExif()">Bilddetails anzeigen</button>
                    <button type="button" ref="editButton" class="edit-button" :class="{'hidden': editHidden }" @click="buttonEditExif()" title="Bilddetails Bearbeiten">
                        <span aria-hidden="true"><i data-feather="edit-2"></i></span>
                    </button>
                </div>
                <table class="table table-striped">
                    <tbody class="modal-exif">
                    </tbody>
                </table>
                <div>
                    <form id="editWithJimp" action="#" method="#" @submit.prevent="editWithJimp(file)">
                        <div class="input-group">
                            <label for="imageWidth">Breite</label>
                            <input type="text" class="form-control" id="imageWidth" v-model="imageWidth" aria-describedby="widthHelp" placeholder="Breite aus File-Element ziehen?">
                            <div class="input-group-append">
                                <span class="input-group-text">px</span>
                            </div>
                            <small id="widthHelp" class="form-text text-muted">Bitte gib die gewünschte Bildbreite an.</small>
                        </div>
                        <div class="input-group">
                            <label for="imageheight">Höhe</label>
                            <input type="text" class="form-control" id="imageHeight" v-model="imageHeight" aria-describedby="heightHelp" placeholder="Höhe aus File-Element ziehen?">
                            <div class="input-group-append">
                                <span class="input-group-text">px</span>
                            </div>
                            <small id="heightHelp" class="form-text text-muted">Bitte gib die gewünschte Bildhöhe an.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
