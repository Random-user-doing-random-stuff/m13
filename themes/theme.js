document.addEventListener('DOMContentLoaded', () => {
    const checkbox = document.getElementById('checkbox');
    const currentTheme = localStorage.getItem('theme');

    // Verifica se há um tema atualmente definido no armazenamento local
    if (currentTheme) {
        document.body.classList.add(currentTheme);
        // Se o tema atual for 'dark-mode', marca a caixa de seleção como marcada
        if (currentTheme === 'dark-mode') {
            checkbox.checked = true;
        }
    }

    // Adiciona um ouvinte de evento para a mudança da caixa de seleção
    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            // Remove a classe 'light-mode' do corpo e adiciona a classe 'dark-mode'
            document.body.classList.remove('light-mode');
            document.body.classList.add('dark-mode');
            // Armazena o tema 'dark-mode' no armazenamento local
            localStorage.setItem('theme', 'dark-mode');
        } else {
            // Remove a classe 'dark-mode' do corpo e adiciona a classe 'light-mode'
            document.body.classList.remove('dark-mode');
            document.body.classList.add('light-mode');
            // Armazena o tema 'light-mode' no armazenamento local
            localStorage.setItem('theme', 'light-mode');
        }
    });
});
