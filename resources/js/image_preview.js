document.getElementById('image_url').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('image-preview');
    const uploadUi = document.getElementById('upload-ui');

    if (file) {
        // Generate temporary local URL
        previewImage.src = URL.createObjectURL(file);
        
        // Show preview layout, hide empty placeholder layout
        previewContainer.classList.remove('hidden');
        uploadUi.classList.add('hidden');
    } else {
        // Revert layout if cleared
        previewImage.src = '#';
        previewContainer.classList.add('hidden');
        uploadUi.classList.remove('hidden');
    }
});
