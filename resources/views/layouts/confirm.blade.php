<div class="modal-custom" id="confirmModal" v-if="showConfirm" v-cloak aria-labelledby="confirmModalLabel" @click="cancelDeleting()">
    <div class="modal-background" @click="cancelDeleting()"></div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="confirmModalLabel">Bist du dir sicher?</h4>
                <button type="button" class="close" @click="cancelDeleting()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Diese Entscheidung lässt sich nicht widerrufen.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" @click="deleteFile()">
                    Ja, löschen
                </button>
                <button type="button" class="btn btn-danger" @click="cancelDeleting()">
                    Nein, behalten
                </button>
            </div>
        </div>
    </div>
</div>