<div class="modal-custom hidden" :class="{'visible' : modalActive}" >
    <div class="modal-background" @click="closeModal()"></div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <button type="button" class="close-modal" title="Schließen" @click="closeModal()">
            <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
        <div class="modal-content">
            <div class="modal-body">
                <img class="img-fluid modal-image" ref="imageExif" v-if="Object.keys(file).length !== 0" :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" :alt="file.name">
                <div class="my-3 d-flex align-items-center justify-content-between">
                    <button class="btn btn-primary" @click="modalExif()">Bilddetails anzeigen</button>
                    <button type="button" ref="editButton" class="edit-button" :class="{'hidden': editHidden }" @click="buttonEditExif()" title="Bilddetails Bearbeiten">
                        <span aria-hidden="true"><i class="fas fa-pen"></i></span>
                    </button>
                </div>
                <table class="table table-striped">
                    <tbody class="modal-exif">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
