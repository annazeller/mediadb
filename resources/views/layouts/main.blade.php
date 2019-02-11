@extends('app')
@section('content')
    <div class="row">
        <div class="col-12 empty-dir" v-if="pagination.total == 0" v-cloak>
            <div>
                <i data-feather="folder"></i>
                Dieser Ordner ist leer!
            </div>
        </div>
        <div class="loading col-12" v-if="loading">
            <i data-feather="loader"></i>
            <span class="sr-only">Lädt...</span>
        </div>
        <div class="file-wrapper" :class="isVideo ? 'col-6'  : 'col-4'" v-for="file in files" :key="file.id">
            <div class="card" >
                <a class="download-file" href="" :href="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" target="_blank">
                    <span aria-hidden="true"><i data-feather="download"></i></span>
                </a>
                <button type="button" class="delete-file" title="Löschen" @click="prepareToDelete(file)">
                    <span aria-hidden="true"><i data-feather="trash"></i></span>
                </button>
                <div class="card-image-top">
                    <div class="file-header-wrapper" v-if="file.type == 'image'" @click="showModal(file)">
                        <img id="imageSource" v-if="file === editingFile" src=""  :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + savedFile.type + '/' + savedFile.name + '.' + savedFile.extension" :alt="file.name">
                        <img id="imageSource" v-if="file !== editingFile" src=""  :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" :alt="file.name">
                    </div>
                    <div v-if="file.type == 'audio'">
                        <div class="file-header-wrapper">
                            <img class="img-fluid" src="{{ asset('images/music.png') }}" alt="Audio image" id="audio_image">
                        </div>
                        <audio controls>
                            <source src="" :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" :type="'audio/' + file.extension">
                            Dein Browser unterstützt leider keine Audiodateien.
                        </audio>
                    </div>
                    <div class="video-header-wrapper" v-if="file.type == 'video'">
                        <video controls>
                            <source src="" :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/' + file.type + '/' + file.name + '.' + file.extension" :type="'video/' + file.extension">
                            Dein Browser unterstützt leider keine Videodateien.
                        </video>
                    </div>
                    <div v-if="file.type == 'document'" class="document-header-wrapper">
                        <div class="card-image-top">
                            <img class="img-fluid" src="{{ asset('images/document.png') }}" alt="Document image" id="document_image">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title" v-if="file !== editingFile" @dblclick="editFile(file)" :title="'Doppelklick um Dateinamen anzupassen.'">
                        @{{ file.name + '.' + file.extension}}
                    </h5>
                    <input class="form-control" v-if="file === editingFile" v-autofocus @keyup.enter="endEditing(file)" @blur="endEditing(file)" type="text" :placeholder="file.name" v-model="file.name">
                    <div>
                        Hochgeladen am:<br>
                        <time datetime="1-1-2019">@{{ file.created_at }}</time><br>
                        <button @click="buttonEditExif()" class="mt-3 btn btn-primary">
                            <i data-feather="edit-2"></i>
                            &nbsp; Bearbeiten
                        </button>
                        <form id="imageSourceForm" method="post" action="/postimage">
                            <input type="hidden" id="imageInput" name="imageSource">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center align-items-center">
            <nav aria-label="Pagination" v-if="pagination.last_page > 1" v-cloak>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" @click.prevent="changePage(1)" :disabled="pagination.current_page <= 1" href="#">Erste Seite</a></li>
                    <li class="page-item"><a class="page-link" @click.prevent="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1" href="#">Vorherige Seite</a></li>
                    <li class="page-item" :class="isCurrentPage(page) ? 'active' : ''" @click.prevent="changePage(page)" v-for="page in pages">
                        <a class="page-link">
                            @{{ page }}
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" @click.prevent="changePage(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page" href="#">Nächste Seite</a></li>
                    <li class="page-item"><a class="page-link" @click.prevent="changePage(pagination.last_page)" :disabled="pagination.current_page >= pagination.last_page" href="#">Letzte Seite</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
