<div class="modal-custom hidden" :class="{'visible' : modalActive}" >
    <div class="modal-background" @click="closeModal()"></div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <button type="button" class="close-modal" title="Schließen" @click="closeModal()">
            <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
        <div class="modal-content">
            <div class="modal-body">
                <img class="img-fluid" ref="imageExif" v-if="Object.keys(file).length !== 0" :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" :alt="file.name">
                <button class="btn btn-primary" @click="modalExif()">Exif Daten anzeigen</button>
                {{--<div class="image-data" ref="imageData" v-if="imageData.length" v-html="imageData"></div>
                <div class="exif-data" ref="exifData" v-if="imageExif.length" v-html="imageExif"></div>--}}
            </div>
        </div>
    </div>
</div>
