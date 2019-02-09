<div class="modal-custom hidden" :class="{'visible' : modalActive}" >
    <div class="modal-background" @click="closeModal()"></div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <button type="button" class="close-modal" title="Schließen" @click="closeModal()">
            <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
        <div class="modal-content">
            <div class="modal-body">
                <img class="img-fluid modal-image" ref="imageExif" v-if="Object.keys(file).length !== 0" :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" :alt="file.name">
                <button class="btn btn-primary" @click="modalExif()">Exif Daten anzeigen</button>
                {{--<table class="table modal-exif">
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>--}}
                <div class="modal-exif"></div>
            </div>
        </div>
    </div>
</div>
