const API = 'http://177.44.248.85/ahlert/projeto/backend/tipos';
// pega o ID através da URL
const queryString = new URLSearchParams(location.search);
const id = queryString.get('id');
const form = document.getElementById('form');
const idInput = document.getElementById('id');
const nomeInput = document.getElementById('nome');
const categoriaInput = document.getElementById('categoria');

async function carregaTipos() {
    try {
        const res = await fetch(`${API}/${id}`);
        if (res.ok) {
            const t = await res.json();
            idInput.value = t.id;
            nomeInput.value = t.nome;
            categoriaInput.value = t.categoria;
        } else {
            throw new Error('Tipo não encontrado');
        }
    } catch (err) {
        alert('Erro ao carregar: ' + err);
        location.href = '../index.html';
    }
}

form.addEventListener('submit', async e => {
    // pausa o envio do submit para controlarmos manualmente
    e.preventDefault();

    const payload = {
        nome: nomeInput.value,
        categoria: categoriaInput.value
    };

    console.log({ id, payload });

    try {
        const res = await fetch(`${API}/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        if (res.ok) {
            window.location.href = '../telas/pesquisaTipo.html';
        } else {
            throw new Error(res.statusText);
        }
    } catch (err) {
        alert('Erro ao atualizar: ' + err);
    }
});

carregaTipos();