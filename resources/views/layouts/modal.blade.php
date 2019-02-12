<div class="modal-custom hidden" :class="{'visible' : modalActive}" >
    <div class="modal-background" @click="closeModal()"></div>
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <button type="button" class="close-modal" title="Schließen" @click="closeModal()">
            <span aria-hidden="true"><i data-feather="x"></i></span>
        </button>
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <img id="imageSource" class="img-fluid modal-image" ref="imageExif" v-if="Object.keys(file).length !== 0" :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" :alt="file.name">
                        <a class="mt-3 btn btn-primary" @click="buttonEditExif(file)" href="/iptc/' + file.id'">
                            <i data-feather="edit-2"></i>
                            &nbsp; Bearbeiten
                        </a>
                       {{-- <form id="imageSourceForm" method="post" action="/postimage">
                            <input type="hidden" id="imageInput" name="imageSource">
                            <input type="hidden" id="imageName" name="imageName">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>--}}
                    </div>
                    <div class="col-md-4">
                            <form id="exportieren" action="#" method="#" @submit.prevent="exportieren(file)">
                                <div><h2>Exportieren</h2>
                                </div>
                                <div class="form-group">
                                    <label for="imageWidth">Breite </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="imageWidth" v-model="imageWidth" aria-describedby="widthHelp" placeholder="Breite aus File-Element ziehen?">
                                        <div class="input-group-append">
                                            <span class="input-group-text">px</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="imageheight">Höhe </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="imageHeight" v-model="imageHeight" aria-describedby="heightHelp" placeholder="Höhe aus File-Element ziehen?">
                                        <div class="input-group-append">
                                            <span class="input-group-text">px</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="format">Format </label>
                                    <select class="form-control" id="format" v-model="format">
                                      <option>jpg</option>
                                      <option>png</option>
                                      <option>gif</option>
                                      <option>tif</option>
                                      <option>bmp</option>
                                      <option>ico</option>
                                      <option>psd</option>
                                      <option>pdf</option>
                                    </select>
                                  </div>
                                <div class="form-group">
                                    <label for="colorspace">Farbraum </label>
                                    <select class="form-control" id="colorspace" v-model="colorspace">
                                      <option>RGB</option>
                                      <option>SRGB</option>
                                      <option>CMYK</option>
                                      <option>GRAY</option>
                                      <option>YUV</option>
                                      <option>HSL</option>
                                      <option>LAB</option>
                                    </select>
                                  </div>
                                <button type="submit" class="btn btn-primary">Exportieren</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
