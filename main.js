

// Function to filter items
function filterItems() {
    const query = document.getElementById('query').value.toLowerCase();
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        const nome = card.getAttribute('data-nome').toLowerCase();
        if (nome.includes(query)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

 // Get the button and popover elements
 const popoverBtn = document.getElementById('popoverBtn');
 const popover = document.getElementById('popover');
 const confirmBtn = document.getElementById('confirmBtn');
 const cancelBtn = document.getElementById('cancelBtn');
 
 // Show popover when button is clicked
 popoverBtn.addEventListener('click', () => {
   popover.style.display = 'block';
 });
 
 // Hide popover when cancel button is clicked
 cancelBtn.addEventListener('click', () => {
   popover.style.display = 'none';
 });
 
 // Handle form submission when confirm button is clicked
 confirmBtn.addEventListener('click', () => {
   const name = document.getElementById('name').value;

   // Handle form submission (e.g., send data to server)
   console.log('Name:', name);
/*    console.log('Image:', image);
 */   
   // Close popover
   popover.style.display = 'none';
 });

 function readURL(input) {
 if (input.files && input.files[0]) {

   var reader = new FileReader();

   reader.onload = function(e) {
     $('.image-upload-wrap').hide();

     $('.file-upload-image').attr('src', e.target.result);
     $('.file-upload-content').show();

     $('.image-title').html(input.files[0].name);
   };

   reader.readAsDataURL(input.files[0]);

 } else {
   removeUpload();
 }
}

function removeUpload() {
 $('.file-upload-input').replaceWith($('.file-upload-input').clone());
 $('.file-upload-content').hide();
 $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
       $('.image-upload-wrap').addClass('image-dropping');
   });
   $('.image-upload-wrap').bind('dragleave', function () {
       $('.image-upload-wrap').removeClass('image-dropping');
});

