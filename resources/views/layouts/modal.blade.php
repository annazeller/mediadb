<div class="modal-custom hidden" :class="{'visible' : modalActive}" >
    <div class="modal-background" @click="closeModal()"></div>
    <div class="modal-dialog modal-xl" role="document">
        <button type="button" class="close-modal" title="Schließen" @click="closeModal()">
            <span aria-hidden="true"><i data-feather="x"></i></span>
        </button>
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <img id="imageSource" class="img-fluid modal-image" ref="imageExif" 
                        
                        v-if="Object.keys(file).length !== 0 && file.extension == 'psd'"
                          :src="'{{ asset('storage/thumbnails')}}' + '/' + file.name + '_' + '{{ Auth::user()->name . '_' . Auth::id() }}' + '.jpg'"
                          :alt="file.extension"
                        style="max-height: 80vh;">
                        <img class="img-fluid modal-image" ref="imageExif" 
                        v-else-if="Object.keys(file).length !== 0" 
                          :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" 
                          :alt="file.extension" 

                        style="max-height: 80vh;">
                    </div>
                    <div class="col-md-5">
                      <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-bild" role="tab" aria-controls="nav-home" aria-selected="true">Bild</a>
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-pdf" role="tab" aria-controls="nav-profile" aria-selected="false">PDF</a>
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-meta" role="tab" aria-controls="nav-profile" aria-selected="false">Metadaten</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-bild" role="tabpanel" aria-labelledby="nav-home-tab">
                          <form id="exportieren" action="#" method="#" @submit.prevent="exportieren(file)">
                            <div>
                              <br />
                              <h3>Bild exportieren</h3>
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
                            <img src="/images/spinner.jpg" id="spinner" width="20px" style="visibility:hidden;" />
                          </form>
                        </div>
                        <div class="tab-pane fade" id="nav-pdf" role="tabpanel" aria-labelledby="nav-profile-tab">
                          <form id="pdfExportieren" action="#" method="#" @submit.prevent="pdfExportieren(file)">
                            <div>
                              <br />
                              <h3>PDF exportieren</h3>
                            </div>
                            <div class="form-group">
                              <label for="pdfImageWidth">Breite </label>
                              <div class="input-group">
                                <input type="text" class="form-control" id="pdfImageWidth" v-model="pdfImageWidth" aria-describedby="widthHelp" placeholder="Breite aus File-Element ziehen?">
                                <div class="input-group-append">
                                  <span class="input-group-text">mm</span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="pdfImageHeight">Höhe </label>
                              <div class="input-group">
                                <input type="text" class="form-control" id="pdfImageHeight" v-model="pdfImageHeight" aria-describedby="heightHelp"  placeholder="Höhe aus File-Element ziehen?">
                                <div class="input-group-append">
                                    <span class="input-group-text">mm</span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="icc">Farbprofil </label>
                              <select class="form-control" id="icc" v-model="icc">
                                <option>sRGB_IEC61966-2-1.icc</option>
                                <option>ISOcoated_v2_300_eci</option>
                                <option>ISOcoated_v2_eci</option>
                                <option>ISOuncoatedyellowish</option>
                                <option>USWebCoatedSWOP</option>
                                <option>AdobeRGB1998</option>
                                <option>eciRGB_v2</option>
                              </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Exportieren</button>
                            <img src="/images/spinner.jpg" id="spinner1" width="20px" style="visibility:hidden;" />
                          </form>
                        </div>
                        <div class="tab-pane fade" id="nav-meta" role="tabpanel" aria-labelledby="nav-profile-tab">
                          <div>
                            <br />
                            <h3>Metadaten</h3>
                          </div>
                          <a class="mt-3 btn btn-primary" @click="buttonEditExif(file)" :href="'/iptc/' + file.id">
                            <i data-feather="edit-2"></i>
                            &nbsp; Bearbeiten
                          </a>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




