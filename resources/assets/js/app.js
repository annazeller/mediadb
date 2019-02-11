window.Vue = require('vue');
window.axios = require('axios');
// window.piexif = require('piexifjs');
// window.Jimp = require('jimp');
// window.EXIF = require('exif-js');

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] =
        token.content;
} else {
    console.error('CSRF token nicht gefunden: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

const app = new Vue({
    el: '#app',

    directives: {
        'autofocus': {
            inserted(el) {
                el.focus();
            }
        }
    },

    data: {
        keywords: "",
        files: [],
        file: [],

        pagination: {},
        offset: 5,

        activeTab: 'image',
        isVideo: false,
        loading: false,

        formData: {},
        fileName: '',
        attachment: '',
        editHidden: true,

        editingFile: {},
        deletingFile: {},
        savedFile: {
            type: '',
            name: '',
            extension: ''
        },

        imageWidth: '',
        imageHeight: '',
        //format: '',
        //colorspace: '',

        notification: false,
        showConfirm: false,
        modalActive: false,
        message: '',
        errors: {}
    },

    methods: {
        isActive(tabItem) {
            return this.activeTab === tabItem;
        },

        setActive(tabItem) {
            this.activeTab = tabItem;
        },

        isCurrentPage(page) {
            return this.pagination.current_page === page;
        },

        fetchFile(type, page) {
            this.loading = true;
            axios.get('files/' + type + '?page=' + page).then(result => {
                this.loading = false;
                this.files = result.data.data.data;
                this.pagination = result.data.pagination;
            }).catch(error => {
                console.log(error);
                this.loading = false;
            });

        },

        fetch(type, id) {
            axios.get('/files/' + type + '/?id=' + id, { params: { keywords: this.keywords } })
                .then(result => {this.files = result.data.data.data;})
                .then(response => this.files = response.data)
                .catch(error => {});
        },


        getFiles(type) {
            this.setActive(type);
            this.fetchFile(type);

            if (this.activeTab === 'video') {
                this.isVideo = true;
            } else {
                this.isVideo = false;
            }
        },

        submitForm() {
            this.formData = new FormData();
            this.formData.append('name', this.fileName);
            this.formData.append('file', this.attachment);

            axios.post('files/add', this.formData, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(response => {
                    this.resetForm();
                    this.showNotification('Datei erfolgreich hochgeladen!', true);
                    this.fetchFile(this.activeTab);
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.showNotification(error.response.data.message, false);
                    this.fetchFile(this.activeTab);
                });
        },

        addFile() {
            this.attachment = this.$refs.file.files[0];
        },

        prepareToDelete(file) {
            this.deletingFile = file;
            this.showConfirm = true;
        },

        cancelDeleting() {
            this.deletingFile = {};
            this.showConfirm = false;
        },

        deleteFile() {
            axios.post('files/delete/' + this.deletingFile.id)
                .then(response => {
                    this.showNotification('Datei erfolgreich gelöscht.', true);
                    this.fetchFile(this.activeTab, this.pagination.current_page);
                })
                .catch(error => {
                    this.errors = error.response.data.errors();
                    this.showNotification('Es ist etwas schiefgelaufen. Bitte versuche es später noch einmal.', false);
                    this.fetchFile(this.activeTab, this.pagination.current_page);
                });

            this.cancelDeleting();
        },

        editFile(file) {
            this.editingFile = file;
            this.savedFile.type = file.type;
            this.savedFile.name = file.name;
            this.savedFile.extension = file.extension;
        },

        endEditing(file) {
            this.editingFile = {};

            let formData = new FormData();
            formData.append('name', file.name);
            formData.append('type', file.type);
            formData.append('extension', file.extension);

            axios.post('files/edit/' + file.id, formData)
                .then(response => {
                    if (response.data === true) {
                        this.showNotification('Dateinamen erfolgreich geändert.', true);
                        var src = document.querySelector('[alt="' + file.name +'"]').getAttribute("src");
                        document.querySelector('[alt="' + file.name +'"]').setAttribute('src', src);
                    }
                    this.fetchFile(this.activeTab, this.pagination.current_page);

                })
                .catch(error => {
                    console.log(error);
                    this.errors = error.response.data.errors;
                    this.showNotification(error.response.data.message, false);
                    this.fetchFile(this.activeTab, this.pagination.current_page);
                });
        },

        showNotification(text, success) {
            if (success === true) {
                this.clearErrors();
            }

            var application = this;
            application.message = text;
            application.notification = true;
            setTimeout(function() {
                application.notification = false;
            }, 15000);
        },

        showModal(file) {
            this.file = file;
            this.modalActive = true;
            let imageName = this.file.name;
            $('#imageName').val(imageName);

        },

        modalExif() {
            // PIEXIF
            /*this.showExif = this.$refs.imageExif.src;
            function toDataUrl(url, callback) {
                const xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    const reader = new FileReader();
                    reader.onloadend = function() {
                        callback(reader.result);
                    };
                    reader.readAsDataURL(xhr.response);
                };
                xhr.open('GET', url);
                xhr.responseType = 'blob';
                xhr.send();
            }
            toDataUrl(this.showExif, function(base64) {
                const exifObj = piexif.load(base64);
                for (let ifd in exifObj) {
                    if (ifd === "thumbnail") {
                        continue;
                    }
                    const exifInfo = $(".modal-exif");
                    exifInfo.append("<tr>" + "<th class='py-4 d-block'>" + ifd + "</th><th></th>" + "</tr>");
                    for (let tag in exifObj[ifd]) {
                        exifInfo.append("<tr>" + "<td>" + piexif.TAGS[ifd][tag]["name"] + ":</td><td class='long-line'>" + exifObj[ifd][tag] + "</td>" + "</tr>");
                    }
                }
            });*/

            // EXIF.js
            /*this.imageExif = this.$refs.imageExif;
            EXIF.getData(this.imageExif, function() {
                const   array = EXIF.pretty(this),
                    exifInfo = $(".modal-exif");
                exifInfo.html(array);
                exifInfo.html(function(i, oldHTML) {
                    return oldHTML.replace(/\n/g, '<br/>');
                });
            });*/

            this.editHidden = false;
        },

        buttonEditExif() {
            let image = $('#imageSource').attr('src');
            console.log(image);
            image = image.replace('http://192.168.10.10/storage/','app/public/');
            console.log(image);
            $('#imageInput').val(image);
            $('#imageSourceForm').submit();
        },

        closeModal() {
            const exifInfo = $(".modal-exif");
            exifInfo.html("");
            this.editHidden = true;
            this.modalActive = false;
            this.file = {};
        },

        changePage(page) {
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            this.pagination.current_page = page;
            this.fetchFile(this.activeTab, page);
        },

        resetForm() {
            this.formData = {};
            this.fileName = '';
            this.attachment = '';
        },

        anyError() {
            return Object.keys(this.errors).length > 0;
        },

        clearErrors() {
            this.errors = {};
        },

        export(file) {
            this.file = file;

            let formData = new FormData();
            formData.append('imageHeight', this.imageHeight);
            formData.append('imageWidth', this.imageWidth);
            //formData.append('format', this.format);
            //formData.append('colorspace', this.colorspace);


            axios.post('files/export/' + file.id, formData, {
                responseType: "blob"
            }).then(response => {
                console.log(response.data);
                
                 let blob = response.data,
                    downloadUrl = window.URL.createObjectURL(blob),
                    filename = "",
                    disposition = response.headers["content-disposition"];

                if (disposition && disposition.indexOf("attachment") !== -1) {
                    let filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/,
                        matches = filenameRegex.exec(disposition);

                    if (matches != null && matches[1]) {
                        filename = matches[1].replace(/['"]/g, "");
                    }
                }

                let a = document.createElement("a");
                if (typeof a.download === "undefined") {
                    window.location.href = downloadUrl;
                } else {
                    a.href = downloadUrl;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                }
                
            })
            .catch(error => {
                console.log(error);
                this.errors = error.response.data.errors;
                this.showNotification(error.response.data.message, false);
                this.fetchFile(this.activeTab, this.pagination.current_page);
            });
        }
    },

    mounted() {
        this.fetchFile(this.activeTab, this.pagination.current_page);
        this.fetch(this.activeTab);
        $('body').removeClass('not-loaded');
    },

    computed: {
        pages() {
            let pages = [];

            let from = this.pagination.current_page - Math.floor(this.offset / 2);

            if (from < 1) {
                from = 1;
            }

            let to = from + this.offset - 1;

            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            while (from <= to) {
                pages.push(from);
                from++;
            }

            return pages;
        }
    },

    watch: {
        keywords(after, before) {
            this.fetch(this.activeTab);
        }
    }
});