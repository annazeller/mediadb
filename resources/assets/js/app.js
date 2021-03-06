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
        filter: null,
        filterDefault: "Bitte auswählen",
        files: [],
        file: [],
        categories: [],

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
        format: '',
        colorspace: '',

        pdfImageWidth: '',
        pdfImageHeight: '',
        icc: '',

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
                this.categories = result.data.categories;
            }).catch(error => {
                console.log(error);
                this.loading = false;
            });

        },

        fetch(type, id) {
            axios.get('/files/' + type + '/?id=' + id, { params: { keywords: this.keywords, filter: this.filter} })
                .then(result => {this.files = result.data.data.data;})
                .then(response => this.files = response.data)
                .catch(error => {});
            console.log(this.filter);
        },

        getFiles(type) {
            this.setActive(type);
            this.fetchFile(type);
            this.keywords = '';


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

        formattedDate(d){
            let arr = d.split(/[- :]/);
            let date = new Date(Date.UTC(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]));
            return date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear() + " " + ('0' + (date.getHours())).slice(-2) + ":" + ('0' + (date.getMinutes())).slice(-2) + ":" + date.getSeconds()
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

        buttonEditExif(file) {
            this.file = file;
            axios.get('/detailseite/' + file.id);
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

        clearInput() {
            const closeButton = $('.clearInput');
            closeButton.css('display', 'flex');
            closeButton.click(function () {
                $(this).parent().find('.inputToClear').val('');
            });
        },

        async exportieren(file) {
            this.file = file;

            let formData = new FormData();
            formData.append('type', 'file');
            formData.append('imageHeight', this.imageHeight);
            formData.append('imageWidth', this.imageWidth);
            formData.append('format', this.format);
            formData.append('colorspace', this.colorspace);
            console.log(this.format);

            document.getElementById("spinner").style.visibility = "visible";
            let a = await axios.post('files/export/' + file.id, formData);
            console.log(a.status);

            if (a.status == 200) {
                document.getElementById("spinner").style.visibility = "hidden";
                if (!this.format) {
                    window.location = 'files/download/' + file.name + '/' + file.extension
                } else {
                    window.location = 'files/download/' + file.name + '/' + this.format
                }
            } else {
                document.getElementById("spinner1").style.visibility = "hidden";
            }
        },

        async pdfExportieren(file) {
            this.file = file;

            let formData = new FormData();
            formData.append('type', 'pdf');
            formData.append('pdfImageHeight', this.pdfImageHeight);
            formData.append('pdfImageWidth', this.pdfImageWidth);
            formData.append('icc', this.icc);
            console.log(this.pdfImageHeight + " " + this.pdfImageWidth + " " + this.icc);
            document.getElementById("spinner1").style.visibility = "visible";
            let a = await axios.post('files/export/' + file.id, formData);
            console.log(a.status);

            if (a.status == 200) {
                document.getElementById("spinner1").style.visibility = "hidden";
                window.location = 'files/download/' + file.name + '/pdf'
            } else {
                document.getElementById("spinner1").style.visibility = "hidden";
            }
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
        },
        filter(after, before) {
            this.fetch(this.activeTab);
        },
    }
});