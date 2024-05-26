// Função para filtrar itens
function filterItems() {
  const query = document.getElementById('query').value.toLowerCase();
  const cards = document.querySelectorAll('.card');

  cards.forEach(card => {
    const nome = card.getAttribute('data-name').toLowerCase();
    if (nome.includes(query)) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
}

// Obter os elementos do botão e popover
const popoverBtn = document.getElementById('popoverBtn');
const popover = document.getElementById('popover');
const confirmBtn = document.getElementById('confirmBtn');
const cancelBtn = document.getElementById('cancelBtn');

// Mostrar popover quando o botão é clicado
popoverBtn.addEventListener('click', () => {
  popover.style.display = 'block';
});

// Ocultar popover quando o botão de cancelar é clicado
cancelBtn.addEventListener('click', () => {
  popover.style.display = 'none';
});

// Lidar com o envio do formulário quando o botão de confirmação é clicado
confirmBtn.addEventListener('click', () => {

  // Fechar popover
  popover.style.display = 'none';
});

function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function (e) {
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
