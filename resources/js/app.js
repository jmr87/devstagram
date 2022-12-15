import Dropzone from "dropzone";

// Configuramos la subida de imagenes. Para usar Dropzone previamente hay que instalarlo
// npm install --save dropzone.

Dropzone.autoDiscover = false;
 const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gift",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function()
    {
        if(document.querySelector('[name="imagen"]').value.trim())
        {
            const imagenPublicada ={};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this, imagenPublicada,`/uploads/${imagenPublicada.name}`
                );

            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
                );
        }
    },
 });

 // Eventos de dropzone.

//  dropzone.on('sending', function(file, xhr, fromData) {

//     console.log(file);
//  });

 dropzone.on('success', function(file, response){
    document.querySelector('[name="imagen"]').value = response.imagen;
 });

//  dropzone.on('error', function(file, message){
//     console.log(message);
//  });

 dropzone.on('removedfile', function(){
    console.log('Archivo eliminado');
 });