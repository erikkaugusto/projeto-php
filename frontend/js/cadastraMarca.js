const API = 'http://177.44.248.85/ahlert/projeto/backend/marcas';
const form = document.getElementById('form');
const nomeInput = document.getElementById('nome');
const anoInput = document.getElementById('anofundacao');
const paisInput = document.getElementById('pais');
const ativoInput = document.getElementById('ativo');

form.addEventListener('submit', async e => {
    // pausa o envio do submit para controlarmos manualmente
    e.preventDefault();

    const payload = {
        nome: nomeInput.value,
        anofundacao: anoInput.value,
        pais: paisInput.value,
        ativo: ativoInput.value
    };

    try {
        const res = await fetch(API, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        if (res.ok) {
            window.location.href = '../telas/pesquisaMarca.html';
        } else {
            throw new Error(res.statusText);
        }
    } catch (err) {
        alert('Erro ao cadastrar: ' + err);
    }
});